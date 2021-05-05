####IMPORTS
import configparser
import csv
import datetime

import pyodbc
from alpha_vantage.timeseries import TimeSeries
import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
import mysql.connector


#################################################################################
#                                                                               #
#                              TO-DO                                            #
#                                                                               #
#
#
#
#################################################################################



####VARIABLES
from mysql.connector.cursor import MySQLCursorPrepared

API_key = 'GH1BFTXNR1TJHCBQ'


####FUNCTIONS
def main():
    getDailyAdjusted_AVtoSQL_Populator("IBM", "IBM", "USD")

def singularAPI_CALL(ticker):
    av = TimeSeries(key=API_key, output_format='csv')
    data, metadata = av.get_daily_adjusted(symbol=ticker)
    table = []
    for row in data:
        table.append(row)
    df = pd.DataFrame(table)
    return df


def getDailyAdjusted_AVtoSQL_Populator(ticker, company_name, currency): #interval is daily mm/dd/yyyy
    mydb = mysql.connector.connect(
        host="satoshi.cis.uncw.edu",
        user="srs8681",
        password="UiYZP14iY",
        database="CSC455SP21Finance"
    )
    mycursor = mydb.cursor()

    mycursor.execute("SELECT EXISTS (SELECT * FROM stock WHERE stockTicker = %s)", (ticker,))
    exists = mycursor.fetchone()[0]
    if not exists:

        mycursor.execute("INSERT INTO stock (stockTicker, currency, companyName) VALUES (%s, %s, %s)", (ticker, currency, company_name))

        results = singularAPI_CALL(ticker).to_numpy()
        mycursor.execute("SELECT MAX(priceID) FROM time")
        priceID = mycursor.fetchone()[0]

        for i in range(1, len(results), 1):
            stockTicker = ticker
            priceID += 1
            startTimeInterval = results[i][0]
            endTimeInterval = datetime.datetime.strptime(startTimeInterval, '%Y-%m-%d') + datetime.timedelta(days=1)
            startPrice = results[i][1]
            endPrice = results[i][2]
            volumeTraded = results[i][3]
            lowPrice = results[i][4]
            highPrice = results[i][5]


            mycursor.execute("INSERT INTO priceRecord (priceID, startPrice, endPrice, volumeTraded, lowPrice, highPrice) VALUES (%s, %s, %s, %s, %s, %s)",
                             (priceID, startPrice, endPrice, volumeTraded, lowPrice, highPrice))

            mycursor.execute("INSERT INTO time (timeIntervalStart, stockTicker, priceID, timeIntervalEnd) VALUES (%s, %s, %s, %s)",
                             (startTimeInterval, stockTicker, priceID, endTimeInterval))

    mydb.commit()

def intraday_populator(ticker, company_name, currency, interval):
    if interval not in ['1min', '5min', '15min', '30min', '60min']:
        raise ValueError("Invalid time interval")
    # setup stuff
    mydb = mysql.connector.connect(
        host="satoshi.cis.uncw.edu",
        user="srs8681",
        password="UiYZP14iY",
        database="CSC455SP21Finance"
    )
    ts = TimeSeries(key=API_key)
    cursor = mydb.cursor(cursor_class=MySQLCursorPrepared)
    num_minutes = interval[:-3]  # Grabbing number of minutes in string form

    # checking to see if ticker already exists
    cursor.execute("SELECT EXISTS (SELECT * FROM stock WHERE stockTicker = %s)", (ticker,))
    exists = cursor.fetchone()[0]
    if not exists:
        # inserts stock record if not found
        cursor.execute("INSERT INTO stock (stockTicker, currency, companyName) VALUES (%s, %s, %s)",
                       (ticker, currency, company_name))

    data, metadata = ts.get_intraday(ticker, interval=interval)
    # main loop for inserting into the table
    for time_date in data:
        # inserting new price record
        cursor.execute("INSERT INTO priceRecord (startPrice, endPrice, volumeTraded, lowPrice, highPrice)" +
                       " VALUES (%s, %s, %s, %s, %s)", (
                           data[time_date]['1. open'], data[time_date]['4. close'], data[time_date]['5. volume'],
                           data[time_date]['3. low'], data[time_date]['2. high']))
        last_price_id = cursor.lastrowid
        try:
            cursor.execute("INSERT INTO time (timeIntervalStart, stockTicker, priceId, timeIntervalEnd)" +
                           "VALUES (%s, %s, %s, ADDDATE(%s, INTERVAL %s MINUTE))",
                           (time_date, ticker, last_price_id, time_date, num_minutes))
        except mysql.connector.IntegrityError:
            # checking to see if time already exists and if it does deletes the new price record that was made before
            cursor.execute("DELETE FROM priceRecord WHERE priceId = %s", (last_price_id,))
    mydb.commit()
    mydb.close()


if __name__ == '__main__':
    main()








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

main()








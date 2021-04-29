####IMPORTS
import pyodbc
from alpha_vantage.timeseries import TimeSeries
import pandas as pd
import matplotlib.pyplot as plt
import mysql.connector


#################################################################################
#                                                                               #
#                              TO-DO                                            #
#                                                                               #
#                                                                               #
#                                                                               #
#                                                                               #
#################################################################################


####VARIABLES
API_key = 'GH1BFTXNR1TJHCBQ'
stockTicker = 'MSFT'



####FUNCTIONS
def main():
    connect()
    df = API_CALL()
    cnxn = pyodbc.connect(df)  #creates a connection for python SQL queries https://towardsdatascience.com/sql-server-with-python-679b8dba69fa
    valuelist = dataframe_to_list(df) #makes list for easy iterable variable allocation when we insert into database
    print(valuelist)

def connect():
    mydb = mysql.connector.connect(
        host="satoshi.cis.uncw.edu",
        user="aa3122",
        password="sDDOa4YpP",
        database="CSC455SP21Finance"
    )

def API_CALL():
    ts = TimeSeries(key=API_key, output_format='pandas')
    df, metadata = ts.get_daily_adjusted(symbol=stockTicker)
    return df

def setStockTicker(str):
    stockTicker = str

def dataframe_to_list(df):
    big_list = []
    for i in range(0,len(df)):
        small_list = []
        for j in range(0,8):
            small_list.append(df.iloc[i][j])
        big_list.append(small_list)
    return big_list

def formatDataEntry():
    #nothing yet
    return None


main()




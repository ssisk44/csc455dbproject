from pprint import pprint

from alpha_vantage.timeseries import TimeSeries
import pandas as pd
import matplotlib.pyplot as plt
import mysql.connector


#VARIABLES
API_key = 'GH1BFTXNR1TJHCBQ'


#FUNCTIONS
def main():
    connect()
    ts = TimeSeries(key = API_key,output_format='pandas')
    df, metadata = ts.get_daily_adjusted(symbol='MSFT')
    valuelist = retrieve_information(df)


def retrieve_information(df):
    big_list = []
    for i in range(0,len(df)):
        small_list = []
        for j in range(0,8):
            small_list.append(df.iloc[i][j])
        big_list.append(small_list)
    return big_list

def connect():
    mydb = mysql.connector.connect(
        host="satoshi.cis.uncw.edu",
        user="aa3122",
        password="sDDOa4YpP",
        database="CSC455SP21Finance"
    )

main()




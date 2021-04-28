from alpha_vantage.timeseries import TimeSeries
import pandas as pd
import mysql.connector


API_key = 'GH1BFTXNR1TJHCBQ'

ts = TimeSeries(key = API_key,output_format='pandas')

data = ts.get_daily_adjusted('MSFT')
print(data[0])

def connect():
    mydb = mysql.connector.connect(
        host="satoshi.cis.uncw.edu",
        user="aa3122",
        password="sDDOa4YpP",
        databse="CSC455SP21Finance"
    )
connect()

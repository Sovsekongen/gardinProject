from mysql.connector import (connection)
from mysql.connector import errorcode, Error
import mysql.connector
from datetime import timedelta
import datetime

def update_val(sensorname, tempVal, humVal):	
	query = """UPDATE sensorData SET tempVal = %s, humVal = %s WHERE location = %s"""
	
	data = (tempVal, humVal, sensorname)
	
	try:
		con = mysql.connector.connect(user="viktorpi", password="Preacher-123",
								  host='192.168.1.50', database="gardinProject")
		
		cursor = con.cursor()
		cursor.execute(query, data)
		
		con.commit()
		
	except Error as error:
		print(error)
	finally:
		print('Succes')
		cursor.close()
		con.close()

def update_stat(sensorval, name, sensorhum):
	query = """INSERT INTO tempRoom (rec, val, name, valH) VALUES (%s, %s, %s, %s);"""
	
	data = (datetime.datetime.now(), sensorval, name, sensorhum)
	
	try:
		con = mysql.connector.connect(user="viktorpi", password="Preacher-123",
								  host='192.168.1.50', database="gardinProject")
		
		cursor = con.cursor()
		cursor.execute(query, data)
		
		con.commit()
		
	except Error as error:
		print(error)
	finally:
		print('Succes')
		cursor.close()
		con.close()
		
def clean_stat():
	try:
		con = mysql.connector.connect(user="viktorpi", password="Preacher-123",
								  host='192.168.1.50', database="gardinProject")
		
		cursor = con.cursor(buffered = True)
		cursor.execute("SELECT rec FROM roomTemp;")
		
		row = cursor.fetchone()
		
		while row is not None:
			cursor.execute("DELETE FROM roomTemp WHERE rec < DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 2 DAY);")
			print(row)
			
			row = cursor.fetchone()
		con.commit()
	except Error as error:
		print(error)
	finally:
		print('Succes')
		cursor.close()
		con.close()
		

if __name__ == '__main__':
	update_stat(20, 'tempRoom')

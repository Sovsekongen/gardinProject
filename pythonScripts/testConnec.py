from mysql.connector import (connection)
from mysql.connector import errorcode

try:
	#con = connection.MySqlConnection(user="viktorpi", password="Preacher-123",
	#							  host='localhost', database="gardinProject")

	con = mysql.connector.connect(user="viktorpi", password="Preacher-123",
								  host='localhost', database="gardinProject")
except mysql.connector.Error as err:
	if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
		print("Pword or uname")
	elif err.errno == errorcode.ER_BAD_DB_ERROR:
		print("database not excist")
	else:
		print(err)	
else:
	print("connect succesful")
	con.close();

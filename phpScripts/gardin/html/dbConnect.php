<?php
define('DBUSER', 'viktorpi');
define('DBPWD', 'Preacher-123');
define('DBDATABASE', 'gardinProject');
define('DBSERVER', 'localhost');

$con = mysqli_connect(DBSERVER, DBUSER, DBPWD, DBDATABASE);

if(mysqli_connect_errno())
{
    echo "failted to connect to mysql: " . mysqli_connect_errno();
}


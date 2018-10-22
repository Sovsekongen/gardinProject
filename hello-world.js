const addon = require('./build/Release/addon');
const fs = require("fs");
const pShell = require("python-shell");
<<<<<<< HEAD
const php = require("php");
=======
const mysql = require('mysql');
const mariadb = require("mariadb");

require('console-stamp')(console, '[HH:MM:ss.l]');
>>>>>>> e135012604b18dbd9bcc7c5f36381d6183e59c6b

var express = require('express');
var app = express();

app.use(express.static('public'));

app.get('/', function (req, res) {
   res.sendFile('phpSQLC.html', {root: __dirname + "/public/templates/"});
});

app.get('/open', function (req, res) {
	//console.log(addon.open());
});

app.get('/close', function (req, res) {
	//console.log(addon.close());
});

app.get("/temp", function(req, res){
    var pyshell = new pShell('pythonScripts/checkTemp.py');
    pyshell.on('message', function(message){
       res.json({name: message});
    });
    pyshell.end();
});

var server = app.listen(8081, function () {
   var host = server.address().address;
   var port = server.address().port;

   console.log("Example app listening at http://%s:%s", host, port);
});

var con = mysql.createConnection(
{
  host: "192.168.1.67",
  port: "3306",
  user: "viktorpi",
  password: "Preacher-123",
  database: "gardinProject"
});

con.connect(function(err) 
{
  if (err) throw err;
  console.log("Connected!");
  con.query("SELECT value FROM sensor;", function (err, result, fiels) {
    if (err) throw err;
      console.log(result);
});
	
});


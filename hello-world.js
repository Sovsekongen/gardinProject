const addon = require('./build/Release/addon');
const fs = require("fs");
const pShell = require("python-shell");

var express = require('express');
var app = express();

app.use(express.static('public'));

app.get('/', function (req, res) {
   res.sendFile('index.html', {root: __dirname + "/public/templates/"});
});

app.get('/open', function (req, res) {
	console.log(addon.open());
});

app.get('/close', function (req, res) {
	console.log(addon.close());
});

app.get("/temp", function(req, res){
    var pyshell = new pShell('pythonScripts/getTemperature.py');
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
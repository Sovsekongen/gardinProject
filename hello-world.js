const addon = require('./build/Release/addon');
const http = require('http');
const jquery = require('jquery');

var express = require('express');
var app = express();

app.use(express.static('public'));

app.get('/', function (req, res) {
   res.sendFile('index.html', {root: __dirname + "/public/templates/"});
})

app.get('/open', function (req, res) {
	console.log(addon.open());
})

app.get('/close', function (req, res) {
	console.log(addon.close());
})

var server = app.listen(8081, function () {
   var host = server.address().address;
   var port = server.address().port;

   console.log("Example app listening at http://%s:%s", host, port);
})

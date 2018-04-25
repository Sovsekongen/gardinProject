const addon = require('./build/Release/addon');
require('./src/');
console.log(addon.hello());

const http = require('http');

const hostname = '127.0.0.1';
const port = 3000;

var fs = require('fs'), server, html;
fs.readFile('./templates/index.html', function(err, load)
{
	html = load;
});

server = http.createServer((req, res) => 
{
	res.writeHeader(200, {"Content-Type": "text/html"});
	res.write(html);
	res.end();
});

server.listen(port, hostname, () => 
{
	console.log(`Server running at http://${hostname}:${port}/`);
});










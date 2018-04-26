if (typeof jQuery === "undefined") {
    var script = document.createElement('script');
    script.src = 'http://code.jquery.com/jquery-latest.min.js';
    script.type = 'text/javascript';
    document.getElementsByTagName('head')[0].appendChild(script);
}

function changeColor(color, id) 
{
	var dir = document.getElementById(id);
	dir.style.backgroundColor = color;
}

function curtainControl(command)
{
	var dir = document.getElementById('openClose');
	if(command === 'open')
	{
		$.ajax({
		type: 'GET',
		url: 'http://localhost:8081/open'
		});
		dir.src="../images/curtainsOpen.png";
	}
	else if(command === 'close')
	{
		$.ajax({
		type: 'GET',
		url: 'http://localhost:8081/close'
		});
		dir.src="../images/curtainsClosed.png";
	}
}
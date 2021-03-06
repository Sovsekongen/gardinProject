const address = '192.168.1.67';

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
		url: 'http://' + address + ':8081/open'
		});
		dir.src="../images/curtainsOpen.png";
	}
	else if(command === 'close')
	{
		$.ajax({
		type: 'GET',
		url: 'http://' + address + ':8081/close'
		});
		dir.src="../images/curtainsClosed.png";
	}
}

function changeClassMenu(id, id2)
{
  var dir = document.getElementById(id);
  var dir2 = document.getElementById(id2);
  var p1 = document.getElementById("paragraphC3Weather");
  var p2 = document.getElementById("paragraphC3settings");

  if(dir.classList.contains('active'))
  {
    dir.classList.remove('active');
    dir2.classList.add('active');
    p1.style.display = "none";
    p2.style.display = "block";
  }
  else
  {
    dir.classList.add('active');
    dir2.classList.remove('active');
    p1.style.display = "block";
    p2.style.display = "none";
  }
}

function inputTemp()
{
    $.get( "/temp", function( data ) {
        var tempDisp = document.getElementById('tempDisp');
        var name;
        console.log(data.name);
        name = data.name;
        tempDisp.innerHTML = name;
    });
}

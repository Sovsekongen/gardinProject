function changeColor() 
{
	var dir = document.getElementById("test");
	if (dir.style.backgroundColor === "yellow") {
		dir.style.backgroundColor = "MediumSeaGreen";
	} else {
		dir.style.backgroundColor = "yellow";
	}
}


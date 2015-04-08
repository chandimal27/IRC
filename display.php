<?php
	class display{

		// Function to display errors
function error($message)
{
	if(isset($_GET['v']))
	{
		echo <<< OUT
<div>$message</div>
OUT;
	}
	else
	{
		echo <<< OUT
<div id="entry">
<img src='img/404.png'>
<h2>$message</h2>
<br/>
<br/>
</div>
OUT;
	}
}
// Function to display the top of the output html
function head($heading)
{
	if(isset($_GET['v']))
	{
		echo <<< OUT
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Bus Route Finder Mobile</title>
</head>
<body>
<div><strong>$heading</strong> (<a href="query.php?f=${_GET['t']}&t=${_GET['f']}&v=mobile">Flip Locations</a>)</div>
<br/>
<div>
OUT;
	}
	else
	{
		echo <<< OUT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Bus Route Finder</title>
<link href='http://fonts.googleapis.com/css?family=Cabin&v1' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="style.css" type="text/css" charset="utf-8" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="img/bus.ico" rel="icon" type="image/vnd.microsoft.icon"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script>
	!window.jQuery && document.write('<script src="jquery/jquery-1.4.3.min.js"><\/script>');
</script>
<script type="text/javascript" src="jquery/fancybox/jquery.fancybox-1.0.0.js"></script>
<link rel="stylesheet" type="text/css" href="jquery/fancybox/fancy.css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	$(".gmap").fancybox(); 
});
</script>
</head>
</head>
<body>
<div id="header">
<h1>$heading</h1>
(<a href="query.php?f=${_GET['t']}&t=${_GET['f']}">Flip Locations</a>)
</div>
<div id="cont">
OUT;
	}
}
// Function to display the bottom of the output
function tail()
{
	if(isset($_GET['v']))
	{
		echo <<< OUT
<br/>
<div><a href="mobile.php">Go Back</a></div>
<br/>
<div>Disclaimer: This service is still in the beta stage, so please use it at your own risk.</div>
</body>
</html>
OUT;
	}
	else
	{
		echo <<< OUT
</div>
<div id="footer">
<p><a href="index.php"><button type="button">Go Back</button></a></p>
<p>Disclaimer: This service is still in the beta stage, so please use it at your own risk.</p>
</div>
</body>
</html>
OUT;
	}
}
// Function to display a bus row
function display($busid, $from, $to, $nstops)
{
	$name1 = place($from);			//halt name from
	$name2 = place($to);			//halt name to
	
	if($to > 200 || $from > 200)		//approximate nstops for long distances
	{
		$nstops = 'More than '.$nstops;
	}
	if(($bus = busDet($busid)) != false)
	{
		$tgeo = geolocate($to);
		$fgeo = geolocate($from);
		if(isset($_GET['v']))
		{
			echo "Take the <strong>${bus[1]}</strong> (${bus[2]} - ${bus[3]}) bus. Get on at $name1 ($fgeo) and get off at $name2 ($tgeo).<br/>";
		}
		else
		{
		echo <<< OUT
<ul id="stops">	
	<li id="le"><div id="route">$bus[1]</div></li>
	<li id="le"><h3>Bus Start</h3><br/>$bus[2]</li>
	<li id="le">$fgeo<h3>Get on at</h3><br/>$name1</li>
	<li id="le">$tgeo<h3>Get off at</h3><br/>$name2</li>
	<li id="le"><h3>Bus End</h3><br/>$bus[3]</li>
	<li><h3>No. of halts</h3><br/>$nstops</li>
</ul>
OUT;
		}
	}
}

	}
?>
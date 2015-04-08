<?php

include 'level.php';
if(isset($_GET['t']) && isset($_GET['f']))
{
	$le = new level();
	$pat = "/[^0-9]/";
	
	$to = preg_replace($pat, "", $_GET['t']);
	$from = preg_replace($pat, "", $_GET['f']);
	if($to == $from)
	{
		//head("Error!");
		//error("You have set the same location as the source and destination.");
		//tail();
	}
	elseif(is_numeric($to) && is_numeric($from) && ($to + $from) < 999999)
	{
		//$name1 = place($from);			//halt name from
		//$name2 = place($to);			//halt name to
		//head("I want to go from $name1 to $name2");
		
		$return1 = $le->level1($from, $to);
		if($return1 != true)
		{
			$return2 = $le->level2($from, $to);
			$return3 = $le->level3($from, $to, $return2);
		
			if(($return3 != true) && ($return2 == 9999))
			{
				//error("We're extremely sorry, but your destination is unreachable using 3 buses or less. We suggest you take a trishaw or taxi to get to your destination.");
			}
		}
		//tail();		
	}
	else
	{
		//head("Error");
		//error("There is a problem with your input. Please use the dropdown menu to select locations.");
		//tail();
	}			
}
else
{
	/*
	head("Error");
	error("There is an issue with your query. Make sure that you have entered your starting location and your destination.");
	tail();*/
}
?>
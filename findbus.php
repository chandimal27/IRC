<?php
// 2015-04-08
/* This class is used to finding set of buses 
matching with starting position to destination.*/
include "dbconn.php";



class findbus{

	

	

// Function to find a bus link from location A to 
// location B (a bus that travels in the correct direction)

// ...using one bus
	
function find1Bus($from, $to)
{


	$dbconn	= new DBConn();
	$sql = <<<SQL
SELECT s1.`bid` as busid, (s2.`stopNo` - s1.`stopNo`) as dist
FROM `stop` AS s1 INNER JOIN `stop` AS s2
ON s1.`bid` = s2.`bid`
WHERE s1.`hid` = :from AND s2.`hid` = :to AND s2.`stopNo` > s1.`stopNo`
ORDER BY dist;
SQL;
	
	$res	= $dbconn->query($sql, array(':from' => $from, ':to' => $to));
	$return = false;

	if($res && ($row = $res->fetch()) != false)
	{
		$return = $row;
	}

	return $return;
}


// ... or two buses

function find2Bus($from, $to)
{
	$dbconn	= new DBConn();

	$sql = <<<SQL
SELECT s1.`bid` as busid1, s3.`bid` as busid2, ch1.`changeid` as changeid, 
(s2.`stopNo` - s1.`stopNo`) as dist1, (s4.`stopNo` - s3.`stopNo`) as dist2
FROM `buschange` AS ch1, `stop` AS s1 INNER JOIN `stop` AS s2
ON s1.`bid` = s2.`bid`
INNER JOIN `stop` AS s3
ON s2.`hid` = s3.`hid`
INNER JOIN `stop` AS s4
ON s3.`bid` = s4.`bid`  
WHERE s1.`hid` = :from AND s2.`hid` = ch1.`changeid` AND s4.`hid` = :to 
AND s2.`stopNo` > s1.`stopNo` AND s4.`stopNo` > s3.`stopNo`
ORDER BY (dist1 + dist2);
SQL;
	
	$res	= $dbconn->query($sql, array(':from' => $from, ':to' => $to));
	$return = false;

	if($res && ($row = $res->fetch()) != false)
	{
		$return = $row;
	}

	return $return;
}


// ... or three buses

function find3Bus($from, $to)
{

	$dbconn	= new DBConn();

	$sql = <<<SQL
SELECT s1.`bid` as busid1, s3.`bid` as busid2, s5.`bid` as busid3, 
ch1.`changeid` as changeid1, ch2.`changeid` as changeid2, 
(s2.`stopNo` - s1.`stopNo`) as dist1, 
(s4.`stopNo` - s3.`stopNo`) as dist2, 
(s6.`stopNo` - s5.`stopNo`) as dist3
FROM `buschange` AS ch1, `buschange` AS ch2, `stop` AS s1 INNER JOIN `stop` AS s2
ON s1.`bid` = s2.`bid`
INNER JOIN `stop` AS s3
ON s2.`hid` = s3.`hid`
INNER JOIN `stop` AS s4
ON s3.`bid` = s4.`bid`
INNER JOIN `stop` AS s5
ON s4.`hid` = s5.`hid`
INNER JOIN `stop` AS s6
ON s5.`bid` = s6.`bid`  
WHERE s1.`hid` = :from AND s2.`hid` = ch1.`changeid` AND s4.`hid` = ch2.`changeid` 
AND s6.`hid` = :to AND s2.`stopNo` > s1.`stopNo` AND s4.`stopNo` > s3.`stopNo` 
AND s6.`stopNo` > s5.`stopNo` ORDER BY (dist1 + dist2 + dist3);
SQL;

	$res	= $dbconn->query($sql, array(':from' => $from, ':to' => $to));
	$return = false;

	if($res && ($row = $res->fetch()) != false)
	{
		$return = $row;
	}

	return $return;
}
}


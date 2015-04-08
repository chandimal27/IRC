<?php
// 2015-04-08 
/* Level class contains three methods.
This class will be used to identify how
many buses are need to travel to the destination. */
include 'findbus.php';

class level{
	
	function __construct(){
		$this->bus_obj = new findbus();
	}
	 // Level 1 - Go from location A to B using one bus

	public function level1($from, $to)
	{
		if(($bus = $this->bus_obj->find1Bus($from, $to)) != false)
		{


			$busid = $bus[0];
			$nstops = $bus[1];

			//Output
			//echo '<div id="entry"><h2>Suggested Route - 1 bus, '.$nstops.' halts</h2>';
			//display($busid, $from, $to, $nstops);
			//echo '</div>';
			echo "From : ".$from." To :".$to."\n";
			echo "Bus : ".$busid." number of halts :".$nstops;
			return true;
		}
	}

	// Level 2 - Go from location A to B using two buses and 
	// select the bus combination with the minimum number of halts

	public function level2($from, $to)
	{
		if(($bus = $this->bus_obj->find2Bus($from, $to)) != false)
		{
			$busid1 = $bus[0];
			$busid2 = $bus[1];
			$change = $bus[2];
			$nstops1 = $bus[3];
			$nstops2 = $bus[4];

			//Output
			/*echo '<div id="entry"><h2>Suggested Route - 2 buses, '.($nstops1 + $nstops2).' halts</h2>';
			display($busid1, $from, $change, $nstops1);
			display($busid2, $change, $to, $nstops2);
			echo '</div>';*/

			echo "From : ".$from." To :".$change."\n";
			echo "Bus : ".$busid1." number of halts :".$nstops1;

			echo "From : ".$change." To :".$to."\n";
			echo "Bus : ".$busid2." number of halts :".$nstops2;

			return ($nstops1 + $nstops2);
		}
		else 
		{
			return 9999;
		}
	}

	// Level 3 - Go from location A to B using three buses and 
	// select the bus combination with the minimum number of halts

	public function level3($from, $to, $nstops)
	{

		if(($bus = $this->bus_obj->find3Bus($from, $to)) != false)
		{


			$busid1 = $bus[0];
			$busid2 = $bus[1];
			$busid3 = $bus[2];
			$change1 = $bus[3];
			$change2 = $bus[4];
			$nstops1 = $bus[5];
			$nstops2 = $bus[6];
			$nstops3 = $bus[7];

			if(($nstops1 + $nstops2 + $nstops3) < ($nstops - 5))
			{
				//Output

				if($nstops == 9999)
				{
					echo '<div id="entry"><h2>Suggested Route - 3 buses, '.($nstops1 + $nstops2 + $nstops3).' halts</h2>';
				}
				else
				{
					echo '<div id="entry"><h2>Alternative Route - 3 buses, '.($nstops1 + $nstops2 + $nstops3).' halts</h2>';
				}
				//display($busid1, $from, $change1, $nstops1);
				//display($busid2, $change1, $change2, $nstops2);
				//display($busid3, $change2, $to, $nstops3);
				echo '</div>';

				return true;
			}
		}

		return false;

	}
	}
	?>

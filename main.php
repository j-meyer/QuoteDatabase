<html> 
<head>
			
	
	<TITLE> Teh Quotes </TITLE>
</head>

<body>
<link rel="stylesheet" type="text/css" href="./main.css" />
	<?php 
	/*
		mysql> use Quotes;
		mysql> describe userQuotes;
	+-----------+-------------+------+-----+---------+----------------+
	| Field     | Type        | Null | Key | Default | Extra          |
	+-----------+-------------+------+-----+---------+----------------+
	| numberID  | smallint(6) | NO   | PRI | NULL    | auto_increment | 
	| rating    | smallint(6) | YES  |     | NULL    |                | 
	| quote     | text        | NO   |     | NULL    |                | 
	| timestamp | datetime    | YES  |     | NULL    |                | 
	| lastip    | int(11)     | NO   |     | NULL    | 		  |
	| person    | text        | YES  |     | NULL    |                |
	+-----------+-------------+------+-----+---------+----------------+
	*/
	?>
<div id="bread">

<div id="topbar">
	<a href="/main.php">Home</a>
   <a href="/submit.php">Add a Quote</a>
	<a href="/main.php?top">Top Rated</a>
	<a href="/main.php?random">Random</a>
	
	</div>


	<?php
		include("./info/config.php");
				


		$limit = 20;//Limit Decided Upon
		$tag = $_SERVER['QUERY_STRING'];
		
	
		//This Contains  The username, pw, and server info
		$connId = @mysql_pconnect($mysqlhost, $mysqluser, 
				$mysqlpassword);


		if($connId){
			//echo("Connected");
			//Connected Correctly
	
		mysql_select_db($dbname);
		//Go thru everything, also need to add a top 20 and bottom 20	
		if($tag == 'random'){
			$result = mysql_query("SELECT * FROM $tblname 
				ORDER BY rand() LIMIT $limit");
		}elseif($tag == 'top'){
			$result = mysql_query("SELECT * FROM $tblname
				ORDER BY percentage DESC LIMIT $limit");
		}
		elseif(is_numeric($tag)){
			$result = mysql_query("SELECT * FROM $tblname
				WHERE numberID=$tag");
			if(mysql_num_rows($result) == 0){
				echo "This Quote Doesn't Exist";
			}
		}
		else{
			
			$result = mysql_query("SELECT * FROM $tblname 
				ORDER BY numberID DESC LIMIT $limit");
		}
		$numRows = mysql_num_rows($result);
		$numColumns = mysql_num_fields($result);
		

		while($row = mysql_fetch_row($result)){
			
			echo "<br>";

			//Quote Number
		echo "<TABLE bgcolor=\"#C0C0C0\"><TR><TD><b>Number:</b>";
		//Used to Have Number: between the bold tags
				echo "&nbsp;";

			      echo"<a href=\"./main.php?$row[0]\">$row[0]</a>";	

				echo "&nbsp;";
			//Rating			
			echo "</TD><TD><b>Rating:</b>";

				echo "&nbsp;";
				//Add One Point to the Quote
				echo"<a href=\"./rate.php?-$row[0]\">[-]</a>";	
				echo $row[7];
				echo '%';
				//Remove One Point From the Quote
				echo"<a href=\"./rate.php?+$row[0]\">[+]</a>";
				echo "&nbsp;";
			//Date
			
			echo "</TD><TD><b>Date:</b>";
				echo "&nbsp;";
				echo ($row[3]);
//$row[3]
			//End Of Mini header
			echo "</TD></TR></TABLE>";

			//Actual Quote
			//echo"<Table><TR><TD>";
			echo"<div id=\"meat\">";
				echo $row[2];
			//echo"</TD></TR></Table>";
			echo"</div>";
		}
		}else{
			echo($error);
		}
	?>
	
</div>
</body>

</html>

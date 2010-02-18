<HEAD>
	<Title>Quote Submitted!</Title>
</HEAD>

<BODY>
<link rel="stylesheet" type="text/css" href="./main.css" />

<div id="bread">

	<div id="topbar">
	<a href="https://members.csh.rit.edu/~mclovin/main.php">Home</a>
   <a href="https://members.csh.rit.edu/~mclovin/submit.php">Add a Quote</a>
	<a href="https://members.csh.rit.edu/~mclovin/main.php?top">Top Rated</a>
	<a href="https://members.csh.rit.edu/~mclovin/main.php?random">Random</a>
	
	</div>
	
	<?php
		include("./info/config.php");

		//printHeader();
		$connId = @mysql_pconnect($mysqlhost, $mysqluser, 
				$mysqlpassword);
					
		if($connId){

			
		mysql_select_db($dbname);
		$currentip = $_SERVER['REMOTE_ADDR']; 
	
		//This sets all returns as /n and makes everything safe
		//for mysql input
		//$quote = htmlspecialchars($quote);
		$quote = nl2br($_POST['quotetext']);
		$quote = mysql_real_escape_string(($quote));
		$quote = strip_tags($quote, '<br>');

		

		$owner = mysql_real_escape_string(($_POST['owner']));
		$owner = strip_tags($owner);
		
		
		//The -18k sets the current time for EST rather than GMT

		$timedate = gmdate("Y-m-d H:i:s", time()-18000);
		$querydata = "INSERT INTO $tblname 
				(quote,timestamp,ownerip,person)
                                VALUES('$quote','$timedate','$currentip','$owner')";

		mysql_query($querydata);
		
		//Everything is all Submitted
		$result = mysql_query("SELECT * FROM $tblname ORDER BY 
				NumberID DESC LIMIT 1");
		$row = mysql_fetch_row($result);
		$idnum = $row[0];
		
		echo "Your quote was submitted at $timedate  <br>";
		echo "Your ID Number is 

			<a href=\"./main.php/?$idnum\">$idnum</a>";
		}else{
			echo($error);
		}
	?>
	</div>
</BODY>

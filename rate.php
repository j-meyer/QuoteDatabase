<head>

</head>
<body>
<link rel="stylesheet" type="text/css" href="./main.css" />
<div id="bread">

	<div id="topbar">
	<a href="/main.php">Home</a>
   <a href="/submit.php">Add a Quote</a>
	<a href="/main.php?top">Top Rated</a>
	<a href="/main.php?random">Random</a>
	</div>

	<div id="meat">
<?php
	include("./info/config.php");

	
    $tag = $_SERVER['QUERY_STRING'];

		//Parses tag
		if($tag[0] == '-'){
			$rating = -1;
		}elseif($tag[0] == '+'){
			$rating = 1;
		}else{
			$rating = 0;
		}
    //tag is now the id number of the quote
		$tag = substr($tag,1);

      
		if($rating != 0 && is_numeric($tag)){
	     $connId = @mysql_pconnect($mysqlhost, $mysqluser,
                 $mysqlpassword);
		
       if($connId){
          $alreadyvoted = false;
          $currentip = $_SERVER['REMOTE_ADDR']; 
			 		mysql_select_db($dbname);

			    $result = mysql_query("SELECT ipaddress FROM iplist 
				                WHERE numberID='$tag'");
			    while($iprow = mysql_fetch_array($result)){
			       if($iprow[0] == $currentip){
					     $alreadyvoted = true;
				     }
				  }

					$oldrating = mysql_query("SELECT rating FROM $tblname
                                 WHERE numberID=$tag");
			    $oldrating = mysql_fetch_row($oldrating);	
			
			    $number = mysql_query("SELECT numberofratings FROM
					                     $tblname WHERE numberID=$tag");
			    $number = mysql_fetch_row($number);
			
			    $number = $number[0] + 1;
				
			   if($alreadyvoted){
				    echo("You've already voted!");
			   }else{

      			 $newRating = $oldrating[0] + $rating;
			       $percentage = round(($newRating)/($number)*100);
			       $query = "UPDATE $tblname SET
				        rating = $newRating, 
				        numberofratings = $number,
				        percentage = $percentage
				        WHERE numberID = $tag";
				        
			   if(!(mysql_query($query))){
				  	echo "$error";
			   }

			   $query = "INSERT INTO iplist (numberID, ipaddress) 
			             VALUES('$tag','$currentip')";
			   $insert = mysql_query($query);
			   if(!($insert)){
				    echo $error;
				 }else{
			     echo"Quote <a href=\"https://members.csh.rit.edu/~mclovin/main.php?$tag\">#$tag</a> 
				   is now rated $percentage%";
				  }
				}
		}else{
				echo($error);
		}
	}else{
			echo "You Failed! Booooo";
	}
		
		

?>
</div>
</body>
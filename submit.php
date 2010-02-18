<head>
	<TITLE> Submit a Quote! </TITLE>		
</head>

<body>
<link rel="stylesheet" type="text/css" href="./main.css" />
<div id="bread">
<div id="topbar">
	<a href="https://members.csh.rit.edu/~mclovin/main.php">Home</a>
   <a href="https://members.csh.rit.edu/~mclovin/submit.php">Add a Quote</a>
	<a href="https://members.csh.rit.edu/~mclovin/main.php?top">Top Rated</a>
	<a href="https://members.csh.rit.edu/~mclovin/main.php?random">Random</a>
</div>


		<form name="addquote" 
			action="submittedquote.php" 
			method="POST">
		<div id ="meat">
		Quote:<br>
		Use in the format: <br>
		<i>Metal Dave: Ah fuck it exploded all over my face!</i> <br>
		
				
		<textarea cols="70%" rows="5" class="text" name="quotetext">
		</textarea>
		</div>
		<br>
		<div id="meat">
		Person Quoted:<br>
		<textarea cols="70%" rows="1" class="text" name="owner">
		</textarea>
		</div>
		<br><br>
		<input type="submit" value="Submit my Quote!">
		</form>
</div>
</body>

<?php
	include("util/config.php");
	include("util/session_mgr.php");
	
	if (session_id() == '') {
		session_start();
	}
	
	validateSession();
?>

<html>
	<head>
		<title><?php include("config.php"); echo $partyName . " Control"; ?></title>
	</head>
	<body>
		<b><?php
			mysql_connect($sqlserver, $sqluser, $sqlpass);
			mysql_select_db('Together');
			
			$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($_SESSION["User.username"]) . "' and session_token='" . mysql_real_escape_string($_SESSION["User.session_token"]) . "'";
			
			$result = mysql_query($sql);
			
			echo "Welcome " . mysql_result($result, 0, 3);
		?></b>
		
		<a href="objects/logout.php">Logout</a>
		
		<form action="objects/addpoll.php" method="post">
			<input name="question" type="text" size="20" placeholder="Poll Question">
			<input name="mode" type="text" size="20" placeholder="Button Based (0|1)">
			<input name="options" type="text" size="20" placeholder="Options (CSV)">
			<input type="submit" value="Add Poll">
		</form>
		
		<br>
		<br>
		<b>Poll Results</b>
		
		<?php
			mysql_connect($sqlserver, $sqluser, $sqlpass);
			mysql_select_db('Together');

			$polls = mysql_query("SELECT * FROM Polls");
			
			for ($i = 0; $i < mysql_num_rows($polls); $i++) {
				$results = array();
				$votes = mysql_query("SELECT * FROM Votes WHERE pollID='" . mysql_real_escape_string(mysql_result($polls, $i, 0)) . "'");
			}
		?>
	</body>
</html>
<!DOCTYPE HTML>
<html> 
	<head>
		<title>欢迎参加E志者在线考试！</title>
		<script type="text/javascript" src = /evaexam/timer.js></script>
	</head>
	<body>
		<h1>欢迎参加E志者协会精品课程在线考试</h1>
		<p>请注意考试是有时间限制的！</p>
		<p id="timer"></p>
		<?php  
			date_default_timezone_set("Asia/Shanghai");
			$timeNow = date("Y-m-d l h:i:sa");
			echo "<p>$_POST[name]同学你好，欢迎参加本次考试！</p>";
			$userDB = mysql_connect("localhost", "usr", "pwd");
			if (!$userDB) 
			{
				echo "error occurred when connecting user database";
			}
			$writeUser = "INSERT INTO students (name, number, startTime)
						VALUES ('$_POST[name]', '$_POST[number]', '$timeNow')";
			mysql_select_db("eva", $userDB);
			if (!mysql_query($writeUser, $userDB)) 
			{
				 echo "error occurred when writing database";
			}

		?>
		<br>
		<p>单选题：每题4分</p>

			<?php
				echo "<form id=\"form1\" action=\"/evaexam/judge.php?number=$_POST[number]\" method=\"post\">";
				$questionDB = mysql_connect("localhost", "usr", "pwd");
				if(!$questionDB)
				{
					echo "error: failed to connect the database";
				}
				mysql_select_db("eva", $questionDB);
				$result = mysql_query("select * from questions");
				while ($row = mysql_fetch_array($result)) 
				{
					echo "第".$row['id']."题:";
					echo $row['question']."<br>";
					echo "<input type=\"radio\" name=\"$row[id]\" value=\"1\">$row[s1]<br>";
					echo "<input type=\"radio\" name=\"$row[id]\" value=\"2\">$row[s2]<br>";
					echo "<input type=\"radio\" name=\"$row[id]\" value=\"3\">$row[s3]<br>";
					echo "<input type=\"radio\" name=\"$row[id]\" value=\"4\">$row[s4]<br>";
					echo "<br><br>";
				}
			?>
			<input type="submit" name="交卷！">
		</form>

	</body>
</html>
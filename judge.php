<!DOCTYPE HTML>
<html> 
	<title>感谢你参加考试</title>
	<body>
		<?php  
			$grade = 0;
			$questionDB = mysql_connect("localhost", "username", "password");
			$choiceAnswer = "";
			date_default_timezone_set("Asia/Shanghai");
			$timeNow = date("Y-m-d l h:i:sa");

			if(!$questionDB)
			{
				echo "error: failed to connect the database";
			}
			mysql_select_db("eva", $questionDB);
			$result = mysql_query("select * from questions");
			while ($row = mysql_fetch_array($result)) 
			{
				$thisAnswer = $_POST[$row['id']];
				if ($thisAnswer == "") 
				{
					$thisAnswer = 0;
				}
				$choiceAnswer = $choiceAnswer.$thisAnswer;
				if ($thisAnswer == $row['answer']) 
				{
					$grade = $grade + 4;
				}
			}

			$userDB = mysql_connect("localhost", "username", "pwd");
			if (!$userDB) 
			{
				echo "error occurred when connecting user database";
			}
			mysql_select_db("eva", $userDB);


			$scoreSQL = "UPDATE students 
					SET choiceScore = '$grade' 
					WHERE number = '$_GET[number]';";
			$textSQL = "UPDATE students 
					SET textAnswer = '$_POST[answer]' 
					WHERE number = '$_GET[number]';";
			$answerSQL = "UPDATE students 
					SET choiceAnswer = '$choiceAnswer' 
					WHERE number = '$_GET[number]';";
			$timeSQL = "UPDATE students 
					SET time = '$timeNow' 
					WHERE number = '$_GET[number]';";
			#echo $userSQL;
			#textAnswer = '$_POST[answer]'
			$verifySQL = "SELECT * FROM students WHERE number = '$_GET[number]' AND choiceScore != 'NULL';";
			if (mysql_fetch_array(mysql_query($verifySQL, $userDB))) 
			{
				echo "哎呀，同学，你好像已经交过卷了呢？<br>想重复交卷可不行哦~";
			}
			else
			{
				if (!mysql_query($scoreSQL, $userDB)) 
				{
					echo "<br>error occurred when writing database<br>";
				}
				if (!mysql_query($textSQL, $userDB)) 
				{
					echo "<br>error occurred when writing database<br>";
				}
				if (!mysql_query($answerSQL, $userDB)) 
				{
					echo "<br>error occurred when writing database<br>";
				}
				if (!mysql_query($timeSQL, $userDB)) 
				{
					echo "<br>error occurred when writing database<br>";
				}
				echo "交卷时间：$timeNow";
				echo "<p>感谢您参与E志者协会精品课程在线考试.</p>";
			}

			

		?>

	</body>
</html>
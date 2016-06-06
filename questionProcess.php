<html>
	<body>
	<?php
		echo "The question you are going to add is:<br>";
		echo $_POST[question];
		echo "<br>the choices are:<br>";
		echo $_POST[s1]."<br>".$_POST[s2]."<br>".$_POST[s3]."<br>".$_POST[s4];
		echo "<br>and the answer is number" . $_POST[answer];


		$questionDB = mysql_connect("localhost", "usr", "pwd");
		if(!$questionDB)
		{
			echo "error: failed to connect the database";
		}
		//connect the database

		$sqlQuery = "INSERT INTO questions (question, s1, s2, s3, s4, answer) 
		VALUES ('$_POST[question]','$_POST[s1]','$_POST[s2]','$_POST[s3]','$_POST[s4]','$_POST[answer]')";
		mysql_select_db("eva", $questionDB);
		if (!mysql_query($sqlQuery, $questionDB)) 
		{
			echo "error occurred when writing database";
		}

		mysql_close(questionDB);
		//close the database after use
	?>
	<a href="/evaexam/addQuestion.php">Add more questions</a>
	</body>
</html>

<?php  
	$questionDB = mysql_connect("localhost", "usr", "pwd");
	if(!$questionDB)
	{
		echo "error: failed to connect the database";
	}
	mysql_select_db("eva", $questionDB);
	$result = mysql_query("select * from questions");
	while ($row = mysql_fetch_array($result)) 
	{
		echo "Question".$row['id'].":<br>";
		echo $row['question']."<br>";
		echo "The answer 1 is ".$row['s1']."<br>";
		echo "The answer 2 is ".$row['s2']."<br>";
		echo "The answer 3 is ".$row['s3']."<br>";
		echo "The answer 4 is ".$row['s4']."<br>";
		echo "The right answer is ".$row['answer']."<br><br>";
	}
?>
<html> 
	<head>
		<title>E志者在线考试分数查询系统</title>
	</head>

	<body>

		<?php
			function queryDB($SQL)
			{
				$db = mysql_connect("localhost", "usr", "pwd");
				mysql_select_db("eva", $db);
				if (!($result = mysql_query($SQL, $db))) 
				{
					echo "error occurred when querying database.";
					return NULL;
				}
				else
					return $result;
			}

			function contractQuestions()
			{

				$dbQueryResult = queryDB("select * from questions;");
				return $dbQueryResult;
				#questions = mysql_fetch_array($dbQueryResult);
			}

			$userDB = mysql_connect("localhost", "usr", "pwd");
			if (!$userDB) 
			{
				echo "error occurred when connecting user database";
			}
			mysql_select_db("eva", $userDB);

			$questionDB = mysql_connect("localhost", "root", "pwd");
			if(!$questionDB)
			{
				echo "error: failed to connect the database";
			}
			mysql_select_db("eva", $questionDB);

			
			$studentQuerySQL = "select * from students where number = '$_POST[number]' and name = '$_POST[name]';";

			if (!($studentInfoResult = mysql_query($studentQuerySQL, $userDB))) 
			{
				echo "<p>error: filed when querying database.</p>";
			}
			else
			{
				if (mysql_num_rows($studentInfoResult) == 0) 
				{
					echo "<p>哎呀，好像没找到你呢。<br>要不再试一次看？</p>";
				}
				else
				{
					$studentInfo = mysql_fetch_array($studentInfoResult);
					echo "<p>$_POST[name]同学您好，您的分数是$studentInfo[choiceScore]分。</p><br>以下是您的答题情况:<br>";
					$questions = contractQuestions();
					$studentAnswer = $studentInfo['choiceAnswer'];
					while ( $row = mysql_fetch_array($questions)) 
					{
						echo "第".$row['id']."题:<br>";
						echo $row['question']."<br>";
						echo "选项1是：".$row['s1']."<br>";
						echo "选项2是：".$row['s2']."<br>";
						echo "选项3是：".$row['s3']."<br>";
						echo "选项4是：".$row['s4']."<br>";
						echo "正确选项是第".$row['answer']."项，你回答的是第".$studentAnswer[$row['id'] - 1]."项<br><br>";
					}
							
				}
			}
			

		?>

	</body>
</html>
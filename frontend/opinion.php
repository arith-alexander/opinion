<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "35.163.61.229";
$username = "developer";
$password = "devpass";
$dbname = "opinion";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
$sql = "SELECT * FROM question";
$result = $conn->query($sql);

if (!$result) {
    die("question is empty");
}

$questions = array();
while ($question = $result->fetch_assoc()) {
    $questions[] = $question;
}

$pagename = "Survey";
include('header.php'); 
?>

<body>
<div class="container_12">
	<div class="grid_12" style="height:100px;">&nbsp;</div>
		<div class="grid_2 ">&nbsp;</div>
			<div class="grid_8">
				<center><h2>We value your opinion.</h2></center>
				<form name="input" action="opinion.php" method="post">

				<?php
				foreach ($questions as $question) { ?>
				<div class="question">

				<b><?=$question["content"]?></b></br>
				
				<input type="radio" name="age" value="0">〜19
				<input type="radio" name="age" value="1" checked="checked">20〜29
				<input type="radio" name="age" value="2">30〜39
				<input type="radio" name="age" value="3">40〜49
				<input type="radio" name="age" value="4">50〜59
				<input type="radio" name="age" value="5">60〜
				</div>

				<?php }?>

				<center><input type="submit" value="回答"></center>
				</form>
			</div>
		<div class="grid_2 ">&nbsp;</div>
	</div>
</body>
</html>

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

$sql = "SELECT * FROM choice";
$result = $conn->query($sql);

if (!$result) {
    die("choice is empty");
}

$choices = array();
while ($choice = $result->fetch_assoc()) {
    $choices[$choice["question_id"]][] = $choice;
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
					<b><?=$question["content"]?></b><br>
				    <?php
				    foreach ($choices[$question["id"]] as $choice) { ?>
				        <input type="radio" name="q[<?=$question["id"]?>]" value="<?=$choice["id"]?>"><?=$choice["content"]?>
				    <?php }?>
					</div>

					<?php }?>

				<center><input type="submit" value="回答"></center>
				</form>
			</div>
		<div class="grid_2 ">&nbsp;</div>
	</div>
</body>
</html>

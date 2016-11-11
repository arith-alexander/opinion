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

print_r($_POST);

?>

<html>
<head>
<title>アンケート</title>
</head>
<body>
<form name="input" action="opinion.php" method="post">

<?php
foreach ($questions as $question) { ?>

<?=$question["content"]?>
<br>

    <?php
    foreach ($choices[$question["id"]] as $choice) { ?>
        <input type="radio" name="q[<?=$choice["id"]?>]" value="<?=$choice["id"]?>"><?=$choice["content"]?>
    <?php }?>
<br>

<?php }?>

<input type="submit" value="回答">
</form>
</body>
</html>

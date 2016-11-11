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
        <input type="radio" name="q[<?=$question["id"]?>]" value="<?=$choice["id"]?>"><?=$choice["content"]?>
    <?php }?>
<br>

<?php }?>

<input type="submit" value="回答">
</form>
</body>
</html>

<?php
/*
 * アンケート回答を保存する
 */

define("QUESTION_NUM",		3);
define("AGE_CHOICES_NUM",	6);
define("SEX_CHOICES_NUM",	2);
define("QUESTION_CHOICES_NUM",	4);

$answerList = array();

// 名前入力
if ( !isset($_POST["name"]) || empty($_POST["name"])) {
	exit;
}
$name = strval($_POST["name"]);
// 年齢入力
if ( !isset($_POST["age"]) || !is_numeric($_POST["age"]) || $_POST["age"] < 0 || $_POST["age"] > AGE_CHOICES_NUM ) {
	exit;
}
$age= intval($_POST["age"]);
// 性別入力
if ( !isset($_POST["sex"]) || !is_numeric($_POST["sex"]) || $_POST["sex"] < 0 || $_POST["sex"] > SEX_CHOICES_NUM ) {
	exit;
}
$sex= intval($_POST["sex"]);
// 質問の回答入力
for ( $qno = 1; $qno <= QUESTION_NUM; $qno++ ) {
	if ( !isset($_POST["question".$qno]) || !is_numeric($_POST["question".$qno]) || $_POST["question".$qno] < 0 || $_POST["question".$qno] > QUESTION_CHOICES_NUM ) {
		exit;
	}
	$answerList[$qno] = intval($_POST["question".$qno]);
}

// TODO: データ保存
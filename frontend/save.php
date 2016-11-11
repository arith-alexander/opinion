<html>
<head>
<title>アンケート回答ありがとうございます</title>
</head>
<body>
<h1>アンケート回答ありがとうございます</h1>
</body>
</html>


<?php

if ( !isset($_POST["q"]) ) {
	header("Location: /frontend/opinion.php");
	exit;
}

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

// TODO: contentは後々の拡張
$content = "";
try {
    //TODO: トランザクションかけたい
    $result = $conn->query("INSERT INTO opinion_answer () VALUES ()");
    $result = $conn->query("SELECT LAST_INSERT_ID() FROM opinion_answer");
    if ( $row = $result->fetch_assoc()) {
        $opinion_answer_id = $row["LAST_INSERT_ID()"];
    }
    else {
        throw new Exception("no opinion_answer data");
    }
    foreach ( $_POST["q"] as $question_id => $choice_id ) {
        // TODO: 後でbindにしたい
        $query = sprintf("INSERT INTO question_answer (opinion_answer_id,question_id,choice_id,content) VALUES (%d,%d,%d,'%s')",$opinion_answer_id,$question_id,$choice_id,$content);
        $result = $conn->query($query);
    }
} catch (Exception $e) {
    //TODO:エラーログ残したい
    header("Location: /frontend/opinion.php");
    exit;
}

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
    echo "empty";
}

if ($result->num_rows > 0) {
    print_r($result->fetch_all());
}

?>

<html>
<head>
<title>アンケート</title>
</head>
<body>
<form name="input" action="opinion.php" method="post">

名前
<br>
<input type="text" name="name" size="40">
<br>
年齢
<br>
<input type="radio" name="age" value="0">〜19
<input type="radio" name="age" value="1" checked="checked">20〜29
<input type="radio" name="age" value="2">30〜39
<input type="radio" name="age" value="3">40〜49
<input type="radio" name="age" value="4">50〜59
<input type="radio" name="age" value="5">60〜
<br>
性別
<br>
<input type="radio" name="sex" value="0" checked="checked">男性
<input type="radio" name="sex" value="1">女性
<br><br>
映画「君の名は。」についてどう思いますか？
<br>
<input type="radio" name="question1" value="0" checked="checked">よいと思う
<input type="radio" name="question1" value="1">どちらかといえばよい
<input type="radio" name="question1" value="2">どちらかといえば悪い
<input type="radio" name="question1" value="3">悪いと思う
<br>
Nintendo Switchについてどう思いますか？
<br>
<input type="radio" name="question2" value="0" checked="checked">よいと思う
<input type="radio" name="question2" value="1">どちらかといえばよい
<input type="radio" name="question2" value="2">どちらかといえば悪い
<input type="radio" name="question2" value="3">悪いと思う
<br>
トランプが大統領になったことに対してどう思いますか？
<br>
<input type="radio" name="question3" value="0" checked="checked">よいと思う
<input type="radio" name="question3" value="1">どちらかといえばよい
<input type="radio" name="question3" value="2">どちらかといえば悪い
<input type="radio" name="question3" value="3">悪いと思う
<br>
<input type="submit" value="回答">
</form>
</body>
</html>

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
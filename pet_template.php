<?php
include 'comment_support.php';

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim (dirname ($_SERVER['PHP_SELF']), '/\\');
$_SESSION['page'] = basename($_SERVER['PHP_SELF'], '.php');

if (isset($_POST['done'])) {
	$comment = newComment($_SESSION['userName'], filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS), date("F j Y"));
	writeComment($comment);
	header("Location: https://$host$uri/" . $_SESSION['page'] . ".php");
}


$prev_comments = readComments();
echo "<br>\n";
if (!empty($prev_comments)) {
	foreach ($prev_comments as $c) {
		echo "On " . $c->date . ", " . $c->userName . " said: <br>\n" . $c->text . "<br>\n";
		echo "<br>\n";
	}
}

if (isset($_SESSION['userName'])):
?>
<form method='post'>
	Comment:<br>
	<textarea name='comment' id='comment'></textarea><br>
	<input type='hidden' name='done'>
	<input type='submit' value='Submit'>  
</form>
<?php endif; ?>

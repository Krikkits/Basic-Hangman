<?php
require_once(__DIR__ . "/hangman_lib.php");

session_name(get_current_user() . "u08");
session_start();

if(!isset($_SESSION['toGuess'])) {
	header("Location: hangman-init.php");
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Hangman</title>
    <style>
    #buttons {
    	margin-top: 50px;
    }
    #buttons button {
    	margin: 5px;
    }
    #image {
	margin-top: 40px;
    }
    #image img {
    	width: 80%;
    }
    </style>
</head>
<body>
<center>
<h1>Woerter raten</h1>

<?php
$mistakes = $_SESSION['errorCount'];
if($_SESSION['state'] == 1) {
	echo "<a href='hangman-init.php'><h1>Wort erraten! Play again?</h1></a>";
	echo "<img src='img/fish-happy.png'>";

} else {
	if($_SESSION['state'] == 2) {
		echo "<a href='hangman-init.php'><h1>Play Again</h1></a>";
		echo "<h4>Antwort: " . $_SESSION['toGuess'] . "</h4>";
			echo "<div id='image'><img src='img/fish-9.svg'></div>";
	} else {
		echo implode(" " , $_SESSION['mask']);
		echo "<div id='buttons'><form action='hangman_guess.php' method='post'>";
		foreach(range('A', 'Z') as $current_letter) {
			if(!in_array($current_letter, $_SESSION['guessedLetters'])) {
				echo "<button name='letter' value='$current_letter' type='submit'>$current_letter</button>";
			}
		}
		echo "</form></div>";
		echo "Fehlversuche: $mistakes / 8 <br>";
		echo "<div id='image'><img src='img/fish-$mistakes.svg'></div>";
	}
}
?>
</body>
</html>

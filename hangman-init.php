<?php

require_once(__DIR__ . "/hangman_lib.php");

$url="hangman.php";
session_name(get_current_user() . "u08");
session_start();
initGame();

header("Location: $url");

?>

<?php

require_once(__DIR__ . "/hangman_lib.php");

?>

<!DOCTYPE html>

<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Hangman</title>
    <style>
    </style>
</head>
<body>
<center>
<h1>Alle Woerter</h1>
<table>
<tr> <th>Wort</th> <th>Zu raten</th> <th>Maske</th> </tr>
<?php
  foreach (getAllWords() as $word) {
    echo "<tr><td> $word </td><td>";
    $transformedWord=transformWord($word);
    echo $transformedWord;
    echo "</td></tr>";
    $masked_word=maskWord($word);
    echo implode(" ", $masked_word);
    echo "</td></tr>";
  }
?>
</table>

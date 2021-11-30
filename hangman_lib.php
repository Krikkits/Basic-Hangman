<?php

function transformWord($word){
  $word=strtoupper(str_replace("ß", "ss", str_replace("Ä","AE", str_replace("Ü", "UE", str_replace("Ö", "OE", $word)))));
  return $word;
}

function maskWord($word){
  $maskArr=array();
  for($i=1; $i<=strlen($word); $i++){
    array_push($maskArr, "_");
  }
  return $maskArr;
}

function getAllWords(){
  $words=["Abend", "Abhilfe", "Abtastrate", "Adel", "Ahndung", "Amtseid", "Anbau", "Andenken", "Anfügen", "Angreifer", "Anstand", "Ära", "Arbeitsamt", "Atombomber", "Auerhahn", "Aufhellen", "Aufwertung", "Ausflug", "Ausfluss", "Auslenken", "Axiom", "Babel", "Bächlein", "Badehaus", "Bärin", "Basar", "Becken", "Beethoven", "Bergbau", "Bespannung", "Bewirtung", "Bewundern", "Billett", "Bolivien", "Bruthenne", "Buffet", "Camembert", "Dammriss", "Datenanzug", "Datenblatt", "Diagnose", "Dienstweg", "Dollarfall", "Dorf", "Dozent", "Eckplatz", "Edelgas", "Ehezwist", "Ehrengast", "Einfluss", "Endlauf", "Entzug", "Enzian", "Epilepsie", "Equalizer", "Equipment", "Erbauer", "Ersticken", "Ethologin", "Fakultät", "Faust", "Fazit", "Fechterin", "Fischzug", "Fixstern", "Fluorid", "Flusslauf", "Fremdwort", "Fußpfad", "Garn", "Gedeck", "Gefolge", "Gegenwind", "Gegner", "Gehalt", "Gehör", "Gehweg", "Geldgeber", "Geplärre", "Gerücht", "Gesäusel", "Gesicht", "Glieder", "Glutamat", "Gold", "Greiferin", "Grundidee", "Hafenbahn", "Hälfte", "Halunke", "Haselmaus", "Häuptling", "Hauptwerk", "Hebamme", "Heck", "Hirn", "Holzpfad", "Hotelpark", "Igelchen", "Impfpass", "Impfung", "Indianer", "Infarkt", "Inselchen", "Interesse", "Junikäfer", "Justiziar", "Kämpfer", "Katakombe", "Kätzchen", "Kenner", "Kesselchen", "Ketzer", "Kibbuz", "Kläger", "Klarlack", "Klebeband", "Kleinod", "Klerus", "Klischee", "Knast", "Koch", "Köln", "Komplizin", "Konfident", "Königtum", "Konsens", "Koreakrieg", "Krümmung", "Kühlhaus", "Kunstmaler", "Kupon", "Lastfahrer", "Laube", "Läufer", "Lehrinhalt", "Leiterin", "Lenkrad", "Lichtkegel", "Limes", "Lumen", "Lümmel", "Mafia", "Malmittel", "Manöver", "Mansarde", "Manufaktur", "Markt", "Marxistin", "Mauritius", "Meer", "Meerechse", "Metallbau", "Minimum", "Mitwelt", "Mokka", "Mondtag", "Mordsgaudi", "Münchener", "Muslimin", "Nagel", "Neckar", "Nerz", "Nullwert", "Obdach", "Operand", "Osthang", "Paradies", "Parlament", "Passbild", "Pfad", "Pflicht", "Phantom", "Piercing", "Piratin", "Pluspunkt", "Politesse", "Pollinie", "Poster", "Prediger", "Querulant", "Quotieren", "Radiologe", "Rat", "Rechner", "Ritual", "Route", "Rückblick", "Salafist", "Saloniki", "Sardinien", "Sarg", "Schachzug", "Scherin", "Schlesier", "Schleuser", "Schund", "Schüssel", "Seegras", "Senkgrube", "Sichtung", "Sirius", "Sittich", "Sitzplatz", "Slalom", "Sokrates", "Solvenz", "Spaten", "Spender", "Spickaal", "Spielbaum", "Spinat", "Sportlerin", "Sprachkern", "Staffelei", "Steigerung", "Steinbau", "Stilart", "Stockholm", "Stoßzeit", "Strand", "Strohhalm", "Sünder", "Tabu", "Taupunkt", "Telefonat", "Textur", "Tisch", "Toleranz", "Totenkopf", "Transkript", "Trauzeuge", "Trödler", "Tuchmacher", "Tyrann", "Ulk", "Umbruch", "Umtrieb", "Umwälzung", "Unglaube", "Unionist", "Ventil", "Verfilzen", "Verriss", "Vielzahl", "Vikar", "Virologe", "Vorgabe", "Vorkoster", "Vorstoß", "Wäscher", "Wecker", "Weintraube", "Weiterflug", "Wellental", "Wichtel", "Wortsinn", "Zähheit", "Zahlung", "Zäpfchen", "Zauberhand", "Zerrung", "Zinnkrug", "Zinssatz", "Zölibat", "Zugpferd", "Zulieferer", "Zündpunkt", "Zuspruch"];
  return $words;
}

function getRandomWord(){
  $randomWord=getAllWords()[rand(0, sizeof(getAllWords())-1)];
  return $randomWord;
}

function guessLetter($letter){
  $transformedLetter=transformWord($letter);
  $toGuessArr=str_split($_SESSION['toGuess']);
  if(!in_array($letter, $_SESSION['guessedLetters'])){
    array_push($_SESSION['guessedLetters'], $letter);
    //check if letter is in toGuess
    for($i=0;$i<strlen($_SESSION['toGuess']);$i++){
      if($toGuessArr[$i]==$letter){
        $_SESSION['mask'][$i]=$letter;
      }
    }

    if(!in_array($letter,$toGuessArr)){
      $_SESSION['errorCount']++;
    }

    //win state
    if(!in_array("_",$_SESSION['mask'])){
      $_SESSION['state']=1;
    }
    else{$_SESSION['state']=0;}
  }
    //losing state
    if($_SESSION['errorCount']>8){
      $_SESSION['state']=2;
    }

}

function initGame(){
  $_SESSION['toGuess']=transformWord(getRandomWord());
  $_SESSION['mask']=maskWord($_SESSION['toGuess']);
  $_SESSION['guessedLetters']=[];
  $_SESSION['errorCount']=0;
  $_SESSION['state']=0;
}

?>

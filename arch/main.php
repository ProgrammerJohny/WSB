<?php

session_start();


if(empty($_SESSION["zalogowany"]))$_SESSION["zalogowany"]=0;

mysql_connect("localhost", "admin", "Webmaster2017")or die("Nie można nawiązać połączenia z bazą");
mysql_select_db("aplikacja")or die("Wystąpił błąd podczas wybierania bazy danych");

function ShowLogin($komunikat=""){
	echo "$komunikat<br>";
	echo "<form action='../../main.php' method=post>";
	echo "Login <input type=text  name=login><br>";
	echo "Hasło: <input type=password   name=haslo><br>";
	echo "<button type=submit value='Zaloguj!' id='submitLogin'>Zaloguj!</button>";
	echo "</form>";

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../../scripts/js/main.js"></script>
	<title>ORION - Archiwum - Strona Główna</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="../../css/style.css" />
</head>
<body>
<div class="container-fluid ">
  <br>

  <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Archiwum systemu ORION  - umowy</h4>
      <p>Wszystkie umowy, które wygasły znajdują się właśnie tutaj. Których Klientów chcesz sprawdzić?</p>
      <hr/>
      <div class="panel-body">
  <a href="Ind/contracts.php" class="badge">Klienci Indywidualni</a>
      </div>
      <div class="panel-body">
  <a href="Firm/contracts.php" class="badge">Klienci Biznesowi</a>
  </div>

    </div>
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Archiwum systemu ORION - dokumentacja</h4>
      <p>Tutaj znajdują się wszystkie dokumenty tworzone np, podczas podpisywania umowy(skany umów, dokumentów) a także pisma wysłane do Klientów.</p>
      <p>Których Klientów chcesz sprawdzić?</p>
      <hr>
        <div class="panel-body">
        <a href="Ind/documents.php" class="badge">Klienci Indywidualni</a>
        </div>
        <div class="panel-body">
    <a href="Firm/documents.php" class="badge">Klienci Biznesowi</a>
    </div>
</div>
<button class=" btn btn-default"><a href="../main.php">Powrót do strony głównej</a></button>
</body>
</html>

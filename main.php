


<?php
/*
Strona główna serwisu ORION - aplikacji do wprowadzania umów Klientów wybranego przedsiębiorstwa
© by Jan Zalesiński 2018
*/

session_start();


if(empty($_SESSION["zalogowany"]))$_SESSION["zalogowany"]=0;

mysql_connect("localhost", "janzales_wsb", "Janek1994")or die("Nie można nawiązać połączenia z bazą");
mysql_select_db("janzales_wsb")or die("Wystąpił błąd podczas wybierania bazy danych");

function ShowLogin($komunikat=""){
	echo "$komunikat<br>";
	echo "<form action='main.php' method=post>";
    echo "<div class='container' >";

	echo "<label class='label label-info' for='login'>Login </label>
  <input type='text' class=form-control  placeholder=Podaj swój login...required name='login'><br>";
	echo "<label for='haslo' class='label label-info'>Hasło:</label>
   <input type=password class='form-control' placeholder='Podaj swoje hasło...'  name='haslo'><br>";
	echo "<button type=submit  id='submitLogin' class='btn-group btn-group-justified'>Zaloguj!</button>";
  echo "</div>";
	echo "<div> ";
	echo "Zapomniałeś <a href='#' >hasła?</a></div>";

  echo "</form></br>";
echo "<a href='scripts/db/admin_login.php' class='alert alert-danger'>Panel administracyjny</a>";
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>ORION - Strona Główna</title>
  <meta charset="utf-8"/>
  <script src="scripts/js/main.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
	<?
	include('scripts/db/main.php');

	?>
<?php
if($_GET["wyloguj"]=="tak"){$_SESSION["zalogowany"]=0;echo "Zostałeś wylogowany z serwisu";}
if($_SESSION["zalogowany"]!=1){
	if(!empty($_POST["login"]) && !empty($_POST["haslo"])){
		if(mysql_num_rows(mysql_query("SELECT * FROM members where member_login = '".htmlspecialchars($_POST["login"])."' AND member_password = '".htmlspecialchars($_POST["haslo"])."'"))){
			echo "Zalogowano poprawnie. <a href='main.php'>Przejdź na stronę główną</a>";
			echo "<br/>Lub przejdź do swojego <a href='usr/profile.php?login=".$_SESSION['zalogowany']."'>profilu</a>";
			$_SESSION["zalogowany"]=1;
			}
		else echo ShowLogin("Podano złe dane!!!");
		}
	else ShowLogin();
}
else{
?>
<div class="jumbotron text-center">
<h1>ORION - System Zarządzania </h1>
<p>Wybierz odpowiednią opcję poniżej</p>
</div>

<a href='main.php?wyloguj=tak' class="alert alert-danger" role="alert">Wyloguj się</a>
<div class="container">
<div class="row">
  <div class="col-sm-4" >
      <div class="categories" onclick="addIndywidualny();">
    <h3>Dodaj Klienta indywidualnego do bazy</h3>
<p>Kliknij ten kafelek aby przejść do dodania Klienta indywidualnego</p>
  </div>
  <div class="categories" onclick="addFirmowy();">
    <h3>Dodaj Klienta Biznesowego do bazy</h3>
<p>Kliknij ten kafelek aby przejść do dodania Klienta Biznesowego</p>
  </div>
</div>
  <div class="col-sm-4">
    <div class="categories" onclick="editIndywidualny()">
    <h3> Przeglądaj i edytuj dane Klienta indywidualnego</h3>
<p>Kliknij ten kafelek aby przejść do edytowania danych Klienta indywidualnego</p>
  </div>
  <div class="categories" onclick="editFirmowy();">
    <h3>Przeglądaj i edytuj dane Klienta Biznesowego</h3>
    <p>Kliknij ten kafelek aby przejść do edytowania danych Klienta Biznesowego</p>
  </div>
  </div>

  <div class="col-sm-3">
    <div class="categories" onclick="viewArchiwum();">
    <h3>Archiwum</h3>
<p>Kliknij tutaj aby przejść do Archiwum Danych Klientów</p>
  </div>
    <div class="categories" onclick="viewRaporty();">
    <h3>Raporty</h3>
<p>Kliknij ten kafelek w celu wygenerowania raportów</p>
  </div>
  </div>
</div>
</div>
<footer>
&copy; by <a href="https://www.facebook.com/JZstronyWWW/" title="Jan Zalesiński - Strony WWW" target="_blank">Jan Zalesiński - Strony WWW</a>
<h2 id="feedback" onclick="sendMail();">Zgłoś problem</h2>
</footer>

<?php
}
?>
</body>
</html>

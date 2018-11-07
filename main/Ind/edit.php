<?
session_start();


if(empty($_SESSION["zalogowany"]))$_SESSION["zalogowany"]=0;

mysql_connect("localhost", "janzales_wsb", "Janek1994")or die("Nie można nawiązać połączenia z bazą");
mysql_select_db("janzales_wsb")or die("Wystąpił błąd podczas wybierania bazy danych");

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
	<title>ORION - Podgląd Umowy[Dashboard]</title>

  <meta charset="utf-8"/>

  <link rel="stylesheet" type="text/css" href="../../css/style.css" />

</head>
<body>

<?php
include('../../scripts/db/main.php'); // skrypt łączenia się z bazą danych
if($_GET["wyloguj"]=="tak"){$_SESSION["zalogowany"]=0;echo "Zostałeś wylogowany z serwisu";}
if($_SESSION["zalogowany"]!=1){
	if(!empty($_POST["login"]) && !empty($_POST["haslo"])){
		if(mysql_num_rows(mysql_query("SELECT * FROM members where member_login = '".htmlspecialchars($_POST["login"])."' AND member_password = '".htmlspecialchars($_POST["haslo"])."'"))){
			echo "Zalogowano poprawnie. <a href='main.php'>Przejdź na stronę główną</a>";
			$_SESSION["zalogowany"]=1;
			}
		else echo ShowLogin("Podano złe dane!!!");
		}
	else ShowLogin();
}
else {
	try
  	{
  		$pdo = new PDO('mysql:host=localhost;dbname=janzales_wsb', 'janzales_wsb', 'Janek1994');
  		$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->query("set names utf8");


  		if(isset($_GET['basic']))
  		{
  			$stmt = $pdo -> prepare('SELECT * FROM customersInd WHERE `ID_cus_ind` = :id');
  			$stmt -> bindValue(':id', $_GET['id'], PDO::PARAM_INT);
  			$stmt -> execute();
  			if($details = $stmt -> fetch())
  			{

  				echo '<div class="container-fluid card" style="width:50rem">
          <div class="panel panel-primary">
          <div class="panel-heading">
					<form method="POST">
<center>					<h2 class="panel-title" ><badge class="badge badge-ligth">'.$details['name_cus_ind'].' '.$details['surname_cus_ind'].'</badge></center>
          </div>

          <p class="alert-info">Umowa ważna od '.$details['period_cus_ind'].'</p>
          <p><input type="hidden" placeholder="'.$details['ID_cus_ind'].'/"></p>
          <p name="name"><b>Imię:</b><input type="text" class="form-control" placeholder= '.$details['name_cus_ind'].'></p>
  				<p name="surname"><b>Nazwisko:</b><input type="text" class="form-control" placeholder= '.$details['surname_cus_ind'].'></p>
  				<p name="pesel"><b>PESEL:</b> '.$details['pesel_cus_ind'].'</p>
  				<p name="email"><b>E-mail:</b> <input type="mail" class="form-control" placeholder='.$details['email_cus_ind'].'></p>
  				<p name="tel"><b>Numer telefonu:</b><input type="text" class="form-control" placeholder= '.$details['tel_cus_ind'].'></p>
					<button class="btn btn-sm btn-success" type="submit">Zapisz zmiany</button>
					<button class="btn btn-sm btn-warning" type="reset">Wyczyść</button>
					<hr>
					</form>
					<a href="#" class="btn btn-danger">Powrót</a>
					</div>';
				}
			} // end of if(isset($_GET['basic']))
			if(isset($_GET['corr']))
			{
				$stmt = $pdo -> prepare('SELECT * FROM customersInd WHERE `ID_cus_ind` = :id');
				$stmt -> bindValue(':id', $_GET['id'], PDO::PARAM_INT);
				$stmt -> execute();
				if($details = $stmt -> fetch())
				{

					echo '<div class="container-fluid card" style="width:50rem">
					<div class="panel panel-primary">
					<div class="panel-heading">
					<form method="POST">
<center>					<h2 class="panel-title" ><badge class="badge badge-light">'.$details['country_corr_cus_ind'].' '.$details['code_corr_cus_ind'].' '.$details['city_corr_cus_ind'].' '.$details['street_corr_cus_ind'].' '.$details['numberhouse_corr_cus_ind'].' / '.$details['numberflat_corr_cus_ind'].'</bagde></center>
					</div>

					<p class="alert-info">Umowa ważna od '.$details['period_cus_ind'].'</p>
					<p><input type="hidden" placeholder="'.$details['ID_cus_ind'].'/"></p>
					<p name="name"><b>Kraj:</b><input type="text" class="form-control" placeholder= '.$details['country_corr_cus_ind'].'></p>
					<p name="surname"><b>Kod pocztowy:</b><input type="text" class="form-control" placeholder= '.$details['code_corr_cus_ind'].'></p>
					<p name="pesel"><b>Miejscowość:</b><input type="text" class="form-control" placeholder='.$details['city_corr_cus_ind'].'></p>
					<p name="email"><b>Ulica:</b> <input type="mail" class="form-control" placeholder="'.$details['street_corr_cus_ind'].'"></p>
					<p name="tel"><b>Numer budynku:</b><input type="text" class="form-control" placeholder= '.$details['numberhouse_corr_cus_ind'].'></p>
					<p name="tel"><b>Numer budynku:</b><input type="text" class="form-control" placeholder= '.$details['numberflat_corr_cus_ind'].'></p>
					<button class="btn btn-sm btn-success" type="submit">Zapisz zmiany</button>

					<button class="btn btn-sm btn-warning" type="reset">Wyczyść</button>
					<hr>
					</form>
					<a href="#" class="btn btn-danger">Powrót</a>
					</div>';
				}
			} // end of if(isset($_GET['corr']))
			if(isset($_GET['reg']))
			{
				$stmt = $pdo -> prepare('SELECT * FROM customersind WHERE `ID_cus_ind` = :id');
				$stmt -> bindValue(':id', $_GET['id'], PDO::PARAM_INT);
				$stmt -> execute();
				if($details = $stmt -> fetch())
				{

					echo '<div class="container-fluid card" style="width:50rem">
					<div class="panel panel-primary">
					<div class="panel-heading">
					<form method="POST">
<center>					<h2 class="panel-title" ><badge class="badge badge-light">'.$details['country_corr_cus_ind'].' '.$details['code_reg_cus_ind'].' '.$details['city_reg_cus_ind'].' '.$details['street_reg_cus_ind'].' '.$details['numberhouse_reg_cus_ind'].' / '.$details['numberflat_reg_cus_ind'].'</bagde></center>
					</div>

					<p class="alert-info">Umowa ważna od '.$details['period_cus_ind'].'</p>
					<p><input type="hidden" placeholder="'.$details['ID_cus_ind'].'/"></p>
					<p name="name"><b>Kraj:</b><input type="text" class="form-control" placeholder= '.$details['country_reg_cus_ind'].'></p>
					<p name="surname"><b>Kod pocztowy:</b><input type="text" class="form-control" placeholder= '.$details['code_reg_cus_ind'].'></p>
					<p name="pesel"><b>Miejscowość:</b><input type="text" class="form-control" placeholder='.$details['city_reg_cus_ind'].'></p>
					<p name="email"><b>Ulica:</b> <input type="mail" class="form-control" placeholder="'.$details['street_reg_cus_ind'].'"></p>
					<p name="tel"><b>Numer budynku:</b><input type="text" class="form-control" placeholder= '.$details['numberhouse_reg_cus_ind'].'></p>
					<p name="tel"><b>Numer budynku:</b><input type="text" class="form-control" placeholder= '.$details['numberflat_reg_cus_ind'].'></p>
					<button class="btn btn-sm btn-success" type="submit">Zapisz zmiany</button>

					<button class="btn btn-sm btn-warning" type="reset">Wyczyść</button>
					<hr>
					</form>
					<a href="#" class="btn btn-danger">Powrót</a>
					</div>';
				}
			} // end of if(isset($_GET['corr']))

}
catch(PDOException $e) {
	echo "Błąd!!".$e->getMessage();
}
}

?>

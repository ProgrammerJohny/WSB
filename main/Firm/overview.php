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
	<script src="../../scripts/js/SearchFirm.js"></script>
	<title>ORION - Dodaj umowę</title>

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
else {?>

		<div class="search">
    Wyszukaj po nazwie firmy : <input type="text" id="input_firm" onkeyup="SearchNameFirm()" placeholder="Nazwa firmy">
	Wyszukaj po NIP : <input type="text" id="input_firm1" onkeyup="SearchNIP()" placeholder="NIP">
	Wyszukaj po numerze Klienta : <input type="text" id="input_firm2" onkeyup="SearchNumberFirm()" placeholder="Numer Klienta">
</div><?
echo '<h2>Lista wszystkich umów Klientów Biznesowych</h2>';
   try
   {
      $conn = new PDO('mysql:host=localhost;dbname=janzales_wsb', 'janzales_wsb', 'Janek1994');
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->query("set names utf8");
      $stmt = $conn -> query('SELECT * FROM customersfirm');
      echo '<table class="table" id="TableFirm">';
			echo '<tr class="alert-success">';
			echo '<th>ID</th>';
			echo '<th>Nazwa firmy</th>';
			echo '<th>NIP</th>';
			echo '<th>REGON</th>';
			echo '<th>Numer Klienta</th>';
			echo '<th>Status umowy</th>';
			echo '<th>Akcja</th>';
			echo '</tr>';
      while($row = $stmt->fetch())
      {

				echo '<tr>';
				echo '<form action="" method="GET">';
				echo '<td>'.$row['ID_cus_firm'].'</td>';
				echo '<td>'.$row['name_cus_firm'].'</td>';
				echo '<td>'.$row['nip_cus_firm'].'</td>';
				echo '<td>'.$row['regon_cus_firm'].'</td>';
				echo '<td>'.$row['number_cus_firm'].'</td>';
				if($row['contract_status_cus_firm'] ==0) {
					echo '<td><i class="alert-success">Aktywna</i></td>';
					echo '<td><a href="customer.php?id='.$row['ID_cus_firm'].'" name="details">Przejdź dalej</a></td>';
				}
				else if($row['contract_status_cus_firm'] ==1) {
					echo '<td><i class="alert-warning">W trakcie wypowiedzenia</i></td>';
					echo '<td><a href="customer.php?id='.$row['ID_cus_firm'].'" name="details">Przejdź dalej</a></td>';
				}
				else if($row['contract_status_cus_firm'] ==2) {
					echo '<td><i class="alert-danger">Dane dostępne w <a href="../../arch/Firm/contracts?id='.$row['ID_cus_firm'].'">Archiwum</a></i></td>';

				}

				echo '</tr>';
				echo '</form>';
			}
      $stmt->closeCursor();
      echo '</table>';
			echo "<button class='btn btn-default'><a href='../../main.php'>Powrót na stronę glówną</button>";
   }
   catch(PDOException $e)
   {
      echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
   }
}
?>

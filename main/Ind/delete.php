

<?
session_start();
// skrypt w PHP  usuwający umowę - zmiana statusu na wypowiedziana i przeniesienie do tabeli customersInd_arch

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
	<title>ORION - Usuwanie umowy</title>

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
  		$pdo = new PDO('mysql:host=localhost;dbname=aplikacja', 'admin', 'Webmaster2017');
  		$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->query("set names utf8");

# $sql = "DELETE FROM customersInd WHERE ID_cus_ind =  :id";
# $stmt = $pdo->prepare($sql);
# $stmt->bindParam(':id', $_POST['ID_cus_ind'], PDO::PARAM_INT);
# $stmt->execute();
  		if(isset($_GET['id'])) // 1
  		{
  			$stmt = $pdo -> prepare('SELECT * FROM customersInd WHERE `ID_cus_ind` = :id'); // 2
  			$stmt -> bindValue(':id', $_GET['id'], PDO::PARAM_INT);
  			$stmt -> execute(); // 3
  			if($details = $stmt -> fetch()) // 4
  			{
          echo '<center>';
            echo '<h4>Potwierdź dane do usunięcia</h4>';

          echo '<div class="container-fluid" style="width:30rem; background-color: #ccc">

					<form method="POST">
          <p class="alert-info">Umowa ważna od '.$details['period_cus_ind'].'</p>
          <p><input type="hidden" placeholder="'.$details['ID_cus_ind'].'/"></p>
          <p name="name"><b>Imię:</b> '.$details['name_cus_ind'].'</p>
  				<p name="surname"><b>Nazwisko:</b> '.$details['surname_cus_ind'].'</p>
  				<p name="pesel"><b>PESEL:</b> '.$details['pesel_cus_ind'].'</p>
  				<p name="email"><b>E-mail:</b> '.$details['email_cus_ind'].'</p>
  				<p name="tel"><b>Numer telefonu:</b> '.$details['tel_cus_ind'].'</p>
					</form>
				  </hr>

          <p><b>Kraj:</b> '.$details['country_corr_cus_ind'].'</p>
          <p><b>Kod pocztowy:</b> '.$details['code_corr_cus_ind'].'</p>
          <p><b>Miejscowość:</b> '.$details['city_corr_cus_ind'].'</p>
          <p><b>Ulica:</b> '.$details['street_corr_cus_ind'].'</p>
          <p><b>Numer domu:</b> '.$details['numberhouse_corr_cus_ind'].'</p>
          <p><b>Numer lokalu:</b> '.$details['numberflat_corr_cus_ind'].'</p>
          <p><b>Kraj:</b> '.$details['country_reg_cus_ind'].'</p>
          <p><b>Kod pocztowy:</b> '.$details['code_reg_cus_ind'].'</p>
          <p><b>Miejscowość:</b> '.$details['city_reg_cus_ind'].'</p>
          <p><b>Ulica:</b> '.$details['street_reg_cus_ind'].'</p>
          <p><b>Numer domu:</b> '.$details['numberhouse_reg_cus_ind'].'</p>
          <p><b>Numer lokalu:</b> '.$details['numberflat_reg_cus_ind'].'</p>
          <hr>
          <p><b>Załącz plik:</b><input type="file"></p>
          <p class="alert-warning"><b>Data operacji:</b>'.date('d.m.Y H:i:s').'</p>

          <button class="btn btn-danger">Usuń</button>
          <hr>
          <button class="btn btn-default"><a href="../../main.php">Powrót na stronę glówną</a></button>
          </div>
          </center>
          ';


         }
  			else
  			{
  				echo '<hr/><p>Przepraszamy, podany rekord nie istnieje!</p>';
  			}
  			$stmt -> closeCursor();
  		}
  	}
  	catch(PDOException $e)
  	{
  		echo 'Wystapil blad biblioteki PDO: ' . $e->getMessage();
  	}


}
?>

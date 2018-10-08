<?
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
  		$pdo = new PDO('mysql:host=localhost;dbname=aplikacja', 'admin', 'Webmaster2017');
  		$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->query("set names utf8");


  		if(isset($_GET['id'])) // 1
  		{
  			$stmt = $pdo -> prepare('SELECT * FROM customersInd WHERE `ID_cus_ind` = :id'); // 2
  			$stmt -> bindValue(':id', $_GET['id'], PDO::PARAM_INT);
  			$stmt -> execute(); // 3
  			if($details = $stmt -> fetch()) // 4
  			{
         if(isset($_POST['save'])) {
            $ins = "UPDATE customersIND SET
            ID_cus_ind = :ID_cus_ind,
          name_cus_ind = :name_cus_ind,
          surname_cus_ind = :surname_cus_ind,
          pesel_cus_ind = :pesel_cus_ind,
          number_cus_ind = :number_cus_ind,
          tel_cus_ind = :tel_cus_ind,
          email_cus_ind = :email_cus_ind,
          country_corr_cus_ind = :country_corr_cus_ind,
          code_corr_cus_ind = :code_corr_cus_ind,
          city_corr_cus_ind = :city _corr_cus_ind,
          street_corr_cus_ind = :street_corr_cus_ind,
          numberhouse_corr_cus_ind = :numberhouse_corr_cus_ind,
          numberflat_corr_cus_ind =:numberflat_corr_cus_ind,
          country_reg_cus_ind = :country_reg_cus_ind,
          code_reg_cus_ind = :code_reg_cus_ind,
          city_reg_cus_ind = :city_reg_cus_ind,
          street_reg_cus_ind = :street_reg_cus_ind,
          numberhouse_reg_cus_ind = :numberhouse_reg_cus_ind,
          numberflat_reg_cus_ind = :numberflat_reg_cus_ind,
          period_cus_ind = :period_cus_ind
          ";
         }
         ?> 
        <div class="container-fluid">
         <div class="panel panel-primary">
         <div class="panel-heading">
         <h3 class="panel-title">Dane podstawowe</h3>
         </div>
         <form action="<?$_PHP_SELF ?>" method="POST" id="editInd">
         <p class="alert-info">Umowa ważna od <? echo $details['period_cus_ind']?></p>
         <p><input type="hidden" placeholder="<?$details['ID_cus_ind']?>"/></p>
         <p><b>Imię:</b><input type="text"  placeholder="<? echo $details['name_cus_ind']?>"></p>
         <p><b>Nazwisko:</b> <input type="text" placeholder= <? echo $details['surname_cus_ind']?>></p>
         <p><b>PESEL:</b><input type="text" placeholder= <? echo $details['pesel_cus_ind']?>></p>
         <p><b>E-mail:</b><input type="text" placeholder= <? echo $details['email_cus_ind']?>></p>
         <p><b>Numer telefonu:</b><input type="text" placeholder=<? echo $details['tel_cus_ind']?>></p>
         </div>
         <hr>

         <div class="panel panel-primary">
         <div class="panel-heading">
         <h3 class="panel-title">Adres do korespondencji</h3>
         </div>
         <p><b>Kraj:</b><input type="text" placeholder=<? echo $details['country_corr_cus_ind']?>></p>
         <p><b>Kod pocztowy:</b><input type="text" placeholder= <?echo $details['code_corr_cus_ind']?>></p>
         <p><b>Miejscowość:</b><input type="text" placeholder=<? echo $details['city_corr_cus_ind']?>></p>
         <p><b>Ulica:</b><input type="text" placeholder = <? echo $details['street_corr_cus_ind']?>></p>
         <p><b>Numer domu:</b><input type="text" placeholder=<? echo $details['numberhouse_corr_cus_ind']?>></p>
         <p><b>Numer lokalu:</b><input type="text" placeholder= <? echo $details['numberflat_corr_cus_ind']?>></p>
         </div>
         <div class="panel panel-primary">
         <div class="panel-heading">
         <h3 class="panel-title">Adres zameldowania</h3>
         </div>
         <p><b>Kraj:</b><input type="text" placeholder=<? echo $details['country_reg_cus_ind']?>></p>
         <p><b>Kod pocztowy:</b><input type="text" placeholder=<? echo $details['code_reg_cus_ind']?>></p>
         <p><b>Miejscowość:</b><input type="text" placeholder=<? echo $details['city_reg_cus_ind']?>></p>
         <p><b>Ulica:</b><input type="text" placeholder= <? echo $details['street_reg_cus_ind']?>></p>
         <p><b>Numer domu:</b><input type="text" placeholder= <? echo $details['numberhouse_reg_cus_ind']?>></p>
         <p><b>Numer lokalu:</b><input type="text" placeholder= <? echo $details['numberflat_reg_cus_ind']?>></p>
         </div>
          <button class="btn btn-success" type="submit" name="save">Zapisz</button>
          <button class="btn btn-warning" type="reset">Kasuj dane</button>
          <button class="btn btn-danger">Anuluj edycję</button>
         </div>
          <a href="overview.php">Powrót do listy umów</a>
          <br>
          <a href="../../main.php">Powrót do strony głównej</a>
<?
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

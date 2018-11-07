<?
session_start();


if(empty($_SESSION["zalogowany"]))$_SESSION["zalogowany"]=0;

mysql_connect("localhost", "admin", "Webmaster2017")or die("Nie można nawiązać połączenia z bazą");
mysql_select_db("aplikacja")or die("Wystąpił błąd podczas wybierania bazy danych");

function ShowLogin($komunikat=""){
	echo "$komunikat<br>";
	echo "<form action='../../main.php' method=post>";
	echo "Login <input type=text  name=login><br>";
	echo "Hasło: <input type=text   name=haslo><br>";
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
	<title>ORION - Dodaj umowę</title>
  <meta charset="utf-8"/>
  <script src="../../scripts/js/main.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
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
else{
?>
<?

mysql_query("set names utf8");
if(isset($_POST['add'])) {
try {


    $ins = "INSERT INTO customersFirm(
      ID_cus_firm,
      name_cus_firm,
      nip_cus_firm,
      regon_cus_firm,
      number_cus_firm,
      tel_cus_firm,
      email_cus_firm,
      country_corr_cus_firm,
      code_corr_cus_firm,
      city_corr_cus_firm,
      street_corr_cus_firm,
      numberhouse_corr_cus_firm,
      numberflat_corr_cus_firm,
      
      period_cus_firm)
      VALUES(
        :ID_cus_firm,
        :name_cus_firm,
        :nip_cus_firm,
        :regon_cus_firm,
        :number_cus_firm,
        :tel_cus_firm,
        :email_cus_firm,
        :country_corr_cus_firm,
        :code_corr_cus_firm,
        :city_corr_cus_firm,
        :street_corr_cus_firm,
        :numberhouse_corr_cus_firm,
        :numberflat_corr_cus_firm,
        :period_cus_firm
      )";

    $sql = $conn->prepare($ins);
    $sql->bindParam(":ID_cus_firm", $_REQUEST['ID_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":name_cus_firm", $_POST['name_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":nip_cus_firm", $_POST['nip_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":regon_cus_firm",$_POST['regon_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":number_cus_firm", $_POST['number_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":tel_cus_firm", $_POST['tel_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":email_cus_firm", $_POST['email_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":country_corr_cus_firm", $_POST['country_corr_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":code_corr_cus_firm", $_POST['code_corr_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":city_corr_cus_firm", $_POST['city_corr_cus_firm'], PDO::PARAM_STR);
    $sql->bindParam(":street_corr_cus_firm",$_POST['street_corr_cus_firm'],PDO::PARAM_STR);
    $sql->bindParam(":numberhouse_corr_cus_firm", $_POST['numberhouse_corr_cus_firm'],PDO::PARAM_STR);
    $sql->bindParam(":numberflat_corr_cus_firm", $_POST['numberflat_corr_cus_firm'],PDO::PARAM_STR);
    $sql->bindParam("period_cus_firm", $_POST['period_cus_firm'], PDO::PARAM_STR);
    $sql->execute();
    echo "Umowa została dodana :) <br/><a href='../../main.php'>Powrót</a>";
}
catch(PDOException $e) {
 echo  "Ops... Błąd! <br>" . $e->getMessage();
 var_dump($sql);
  }
} // koniec if

else {
?>
<div class="container">
<h2>Dodawanie nowego rekordu</h2>
<form action="<?php $_PHP_SELF ?>" method="POST" name="addInd" >
<ul class="list-group">
	<div class="panel panel-success">
	<label class="panel-heading">Dane identyfikacyjne</label>
	<li class="list-group-item"><input type="hidden" name="ID_cus_firm"></li>
<li class="list-group-item">Nazwa firmy  : <input type="text" name="name_cus_firm" placeholder="Wpisz pełną nazwę firmy" required></li>
	<li class="list-group-item">NIP : <input type="text" name="nip_cus_firm" placeholder="Wpisz NIP" required></li>
<li class="list-group-item">REGON : <input type="text" name="regon_cus_firm" placeholder="Wpisz REGON" required maxlength="11"></li>

<li class="list-group-item">Numer Klienta[<i>Wpisz liczbę, która pojawi się w okienku obok</i>] : <? echo rand(101,201)?> <input type="text" name="number_cus_ind" required></li>
<li class="list-group-item">Numer telefonu : <input type="text" name="tel_cus_firm" placeholder="Wpisz numer telefonu" required></li>
<li class="list-group-item">Adres e-mail : <input type="email" name="email_cus_firm" placeholder="Wpisz adres email" required></li>

</div>
<div class="panel panel-success">
	<label class="panel-heading" >Dane teleadresowe</label>
		<li class="list-group-item">Kraj : <input type="text" name="country_reg_cus_firm" placeholder="Wpisz nazwę kraju" required></li>
		<li class="list-group-item">Kod pocztowy : <input type="text" name="code_reg_cus_firm" placeholder="Wpisz kod pocztowy" required></li>
	<li class="list-group-item">Miejscowość : <input type="text" name="city_reg_cus_firm" placeholder="Wpisz nazwę miejscowości"required></li>
		<li class="list-group-item">Ulica : <input type="text" name="street_reg_cus_firm" placeholder="Wpisz nazwę ulicy" required></li>
	<li class="list-group-item">Numer domu : <input type="text" name="numberhouse_reg_cus_firm" placeholder="Wpisz numer domu" required></li>
		<li class="list-group-item">Numer mieszkania : <input type="text" name="numberflat_reg_cus_firm"placeholder="Wpisz numer mieszkania" required></li>
</div>

<div class="panel panel-success">
<li class="list-group-item">Od kiedy klientem: <input type="date" name="period_cus_firm"></li>
</div>
<div style="clear : both;">
<button type="submit" class="btn btn-success" name="add" id="add">Zapisz dane</button>
<button type="reset" class="btn btn-warning">Kasuj dane</button>
<a href="../../main.php"><button type="button" class="btn btn-primary" >Powrót do strony głównej</button></a>
</div>
</ul>

</form>
</div>

<?
} // koniec pętli else
?>

</body>
<footer>
&copy; by <a href="https://www.facebook.com/JZstronyWWW/" title="Jan Zalesiński - Strony WWW" target="_blank">Jan Zalesiński - Strony WWW</a>
<h2 id="feedback" onclick="sendMail();">Zgłoś problem</h2>
</footer>

<?php
}
?>

</body>
</html>
<?php mysql_close(); ?>

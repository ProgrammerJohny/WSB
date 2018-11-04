
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

<?

mysql_query("set names utf8");

if(isset($_POST['add'])) {
try {
include('../../scripts/db/main.php');
$ins = "INSERT INTO customersInd(ID_cus_ind,name_cus_ind,surname_cus_ind,pesel_cus_ind,number_cus_ind,tel_cus_ind,email_cus_ind,country_corr_cus_ind,code_corr_cus_ind,city_corr_cus_ind,street_corr_cus_ind,numberhouse_corr_cus_ind,numberflat_corr_cus_ind,country_reg_cus_ind,code_reg_cus_ind,city_reg_cus_ind,street_reg_cus_ind,numberhouse_reg_cus_ind,numberflat_reg_cus_ind,period_cus_ind)
      VALUES(
        :ID_cus_ind,
        :name_cus_ind,
        :surname_cus_ind,
        :pesel_cus_ind,
        :number_cus_ind,
        :tel_cus_ind,
        :email_cus_ind,
        :country_corr_cus_ind,
        :code_corr_cus_ind,
        :city_corr_cus_ind,
        :street_corr_cus_ind,
        :numberhouse_corr_cus_ind,
        :numberflat_corr_cus_ind,
        :country_reg_cus_ind,
        :code_reg_cus_ind,
        :city_reg_cus_ind,
        :street_reg_cus_ind,
        :numberhouse_reg_cus_ind,
        :numberflat_reg_cus_ind,
        :period_cus_ind
      )";

    $sql = $conn->prepare($ins);
    $sql->bindParam(":ID_cus_ind", $_REQUEST['ID_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":name_cus_ind", $_POST['name_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":surname_cus_ind", $_POST['surname_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":pesel_cus_ind",$_POST['pesel_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":number_cus_ind", $_POST['number_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":tel_cus_ind", $_POST['tel_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":email_cus_ind", $_POST['email_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":country_corr_cus_ind", $_POST['country_corr_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":code_corr_cus_ind", $_POST['code_corr_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":city_corr_cus_ind", $_POST['city_corr_cus_ind'], PDO::PARAM_STR);
    $sql->bindParam(":street_corr_cus_ind",$_POST['street_corr_cus_ind'],PDO::PARAM_STR);
    $sql->bindParam(":numberhouse_corr_cus_ind", $_POST['numberhouse_corr_cus_ind'],PDO::PARAM_STR);
    $sql->bindParam(":numberflat_corr_cus_ind", $_POST['numberflat_corr_cus_ind'],PDO::PARAM_STR);
    $sql->bindParam(":country_reg_cus_ind",$_POST['country_reg_cus_ind'],PDO::PARAM_STR);
    $sql->bindParam(":code_reg_cus_ind",$_POST['code_reg_cus_ind'],PDO::PARAM_STR);
    $sql->bindParam(":city_reg_cus_ind",$_POST['city_reg_cus_ind'],PDO::PARAM_STR);
    $sql->bindParam(":street_reg_cus_ind",$_POST['street_reg_cus_ind'],PDO::PARAM_STR);
    $sql->bindParam(":numberhouse_reg_cus_ind",$_POST['numberhouse_reg_cus_ind'],PDO::PARAM_STR);
    $sql->bindParam(":numberflat_reg_cus_ind",$_POST['numberflat_reg_cus_ind'],PDO::PARAM_STR);
    $sql->bindParam("period_cus_ind", $_POST['period_cus_ind'], PDO::PARAM_STR);

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
<h2>Dodawanie nowej umowy</h2>
<form action="<?php $_PHP_SELF ?>" method="POST" name="addInd" >
<ul class="list-group">
	<div class="panel panel-success">
	<label class="panel-heading">Dane personalne</label>
	<li class="list-group-item"><input type="hidden" name="ID_cus_ind"></li>
	<li class="list-group-item">Imię  : <input type="text" name="name_cus_ind" placeholder="Wpisz imię" required></li>
	<li class="list-group-item">Nazwisko : <input type="text" name="surname_cus_ind" placeholder="Wpisz nazwisko" required></li>
	<li class="list-group-item">PESEL : <input type="text" name="pesel_cus_ind" placeholder="Wpisz PESEL" required maxlength="11"></li>
	<li class="list-group-item">Numer Klienta[<i>Wpisz liczbę, która pojawi się w okienku obok</i>] : <? echo rand(0,100)?> <input type="text" name="number_cus_ind" required></li>
	<li class="list-group-item">Numer telefonu : <input type="text" name="tel_cus_ind" placeholder="Wpisz numer telefonu" required></li>
	<li class="list-group-item">Adres e-mail : <input type="email" name="email_cus_ind" placeholder="Wpisz adres email" required></li>
</div>
<div class="panel panel-success">
	<label class="panel-heading" >Dane teleadresowe - adres zameldowania</label>
		<li class="list-group-item">Kraj : <input type="text" name="country_reg_cus_ind" placeholder="Wpisz nazwę kraju" required></li>
		<li class="list-group-item">Kod pocztowy : <input type="text" name="code_reg_cus_ind" placeholder="Wpisz kod pocztowy" required></li>
		<li class="list-group-item">Miejscowość : <input type="text" name="city_reg_cus_ind" placeholder="Wpisz nazwę miejscowości"required></li>
		<li class="list-group-item">Ulica : <input type="text" name="street_reg_cus_ind" placeholder="Wpisz nazwę ulicy" required></li>
		<li class="list-group-item">Numer domu : <input type="text" name="numberhouse_reg_cus_ind" placeholder="Wpisz numer domu" required></li>
		<li class="list-group-item">Numer mieszkania : <input type="text" name="numberflat_reg_cus_ind"placeholder="Wpisz numer mieszkania" required></li>
</div>
		<div class="panel panel-success">
				<label class="panel-heading" >Dane teleadresowe - adres do korespondencji</label>
				<label class="panel-body">Wpisz dane lub... <input type="checkbox" onChange="copyStrings()">Dane te same jak zameldowania</button></label>
				<li class="list-group-item">Kraj : <input type="text" name="country_corr_cus_ind" placeholder="Wpisz nazwę kraju" required></li>
				<li class="list-group-item">Kod pocztowy : <input type="text" name="code_corr_cus_ind" placeholder="Wpisz kod pocztowy" required></li>
				<li class="list-group-item">Miejscowość : <input type="text" name="city_corr_cus_ind" placeholder="Wpisz nazwę miejscowości"required></li>
				<li class="list-group-item">Ulica : <input type="text" name="street_corr_cus_ind" placeholder="Wpisz nazwę ulicy" required></li>
				<li class="list-group-item">Numer domu : <input type="text" name="numberhouse_corr_cus_ind" placeholder="Wpisz numer domu" required></li>
				<li class="list-group-item">Numer mieszkania : <input type="text" name="numberflat_corr_cus_ind"placeholder="Wpisz numer mieszkania" required></li>
</div>
	<div class="panel panel-success">
		<li class="list-group-item">Od kiedy klientem: <input type="date" name="period_cus_ind"></li>
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

>

</body>
</html>

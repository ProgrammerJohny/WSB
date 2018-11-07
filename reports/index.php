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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


	<script src="../../scripts/js/main.js"></script>
	<title>ORION - Sekcja Raportów</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="../../css/style.css" />
</head>
<body>
<div class="container-fluid">

<div class="card text-center card-tex-white bg-primary mb-3">
  <div class="card-header">
    <i>Klient Indywidualny</i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Raport ilościowy </h5>
    <p class="card-text">Generuj raport w oparciu o wybrany okres czasu</p>
		<a href="Ind/numeric/week.php" target="_blank" class="btn btn-secondary">Ostatni tydzień [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 week"))?>]</a>
		<a href="Ind/numeric/month.php" target="_blank" class="btn btn-secondary">Ostatnie 30 dni [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 month"))?>]</a>
		<a href="Ind/numeric/year.php" target="_blank" class="btn btn-secondary">Ostatni rok [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 year"))?>]</a>

  </div>

</div>
<div>
<div class="card text-center card-tex-white bg-primary mb-3">
  <div class="card-header">
    <i>Klient Indywidualny</i>
	  </div>
  <div class="card-body">
    <h5 class="card-title">Raport sprzedaży </h5>
    <p class="card-text">Generuj raport w oparciu o wybrany okres czasu</p>
		<a href="Ind/sales/week.php" class="btn btn-secondary">Ostatni tydzień [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 week"))?>]</a>
		<a href="Ind/sales/month.php" class="btn btn-secondary">Ostatnie 30 dni [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 month"))?>]</a>
		<a href="Ind/sales/year.php" class="btn btn-secondary">Ostatni rok [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 year"))?>]</a>

		</div>
  </div>

</div>
<!-- end of section for individual Customers-->
<div class="card text-center card-tex-white bg-primary mb-3">
  <div class="card-header">
  <i>  Klient Biznesowy</i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Raport ilościowy </h5>
    <p class="card-text">Generuj raport w oparciu o wybrany okres czasu</p>
		<a href="Firm/numeric/week.php" class="btn btn-secondary">Ostatni tydzień [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 week"))?>]</a>
		<a href="Firm/numeric/month.php" class="btn btn-secondary">Ostatnie 30 dni [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 month"))?>]</a>
		<a href="Firm/numeric/year.php" class="btn btn-secondary">Ostatni rok [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 year"))?>]</a>

  </div>

</div>
<div>
<div class="card text-center card-tex-white bg-primary mb-3">
  <div class="card-header">
  <i>  Klient Bizneoswy</i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Raport sprzedaży </h5>
    <p class="card-text">Generuj raport w oparciu o wybrany okres czasu</p>
		<a href="Firm/sales/week.php" class="btn btn-secondary">Ostatni tydzień [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 week"))?>]</a>
		<a href="Firm/sales/month.php" class="btn btn-secondary">Ostatnie 30 dni [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 month"))?>]</a>
		<a href="Firm/sales/year.php" class="btn btn-secondary">Ostatni rok [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 year"))?>]</a>

  </div>

</div>



</div>
<button class=" btn btn-link"><a href="../main.php">Powrót do strony głównej serwisu</a></button>
</body>
</html>

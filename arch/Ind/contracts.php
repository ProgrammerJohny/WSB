<?php
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


	<script src="../../scripts/js/main.js"></script>
	<title>ORION - Archiwum - Strona Główna - Klienci Indywidualni - Umowy</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="../../css/style.css" />
</head>
<body>
<div class="container-fluid">
  <br>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="../main.php">Strona główna Archiwum</a></li>
    <li class="breadcrumb-item active" aria-current="page">Klienci Indywidualni - umowy</li>
	</ol>
	</nav>
	<div class="search">
Wyszukaj po imieniu : <input type="text" id="input_ind" onkeyup="SearchName()" placeholder="Imię">
Wyszukaj po PESEL : <input type="text" id="input_ind1" onkeyup="SearchPesel()" placeholder="PESEL">
Wyszukaj po numerze Klienta : <input type="text" id="input_ind2" onkeyup="SearchNumber()" placeholder="Numer Klienta">
</div>
<?php
try {
  include('../../scripts/db/main.php');
  $conn->query("set names utf8");
  $stmt = $conn -> query('SELECT * FROM customersind_arch');
  echo '<table class="table" id="TableInd">';
  echo '<tr class="alert-success">';
  echo '<th>ID</th>';
  echo '<th>Imię</th>';
  echo '<th>Nazwisko</th>';
	echo '<th>PESEL</th>';
  echo '<th>Numer Klienta</th>';
  echo '<th>Status umowy</th>';
  echo '<th>Akcja</th>';
  echo '</tr>';
  while($row = $stmt->fetch())
  {

    echo '<tr>';
    echo '<form action="" method="GET">';
    echo '<td>'.$row['ID_cus_ind'].'</td>';
    echo '<td>'.$row['name_cus_ind'].'</td>';
    echo '<td>'.$row['surname_cus_ind'].'</td>';
		echo '<td>'.$row['pesel_cus_ind'].'</td>';
    echo '<td>'.$row['number_cus_ind'].'</td>';

    if($row['contract_status_cus_ind'] ==2) {
      echo '<td><i class="alert-danger">Umowa rozwiązana dnia</i> <span class="badge badge-light">'.$row['date_expired'].'</span></td>';
      }
      echo '<td><button class="btn btn-dark"><a href="documents.php?id='.$row['ID_cus_ind'].'">Dokumenty</a></button></td>';
    echo '</tr>';
    echo '</form>';
  }
  $stmt->closeCursor();
  echo '</table>';
}
catch(PDOException $e) {
  echo 'Error'.$e->getMessage();
}
?>
</div>
<button class=" btn btn-link"><a href="../../main.php">Powrót do strony głównej serwisu</a></button>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>ORION - Panel administracyjny</title>
  <meta charset="utf-8"/>
</head>
<body>
<?
include('main.php');
?>
<?
try {
$ins = "INSERT INTO members(member_id,member_login,member_password,member_email,member_tel,member_name,member_surname,member_date) VALUES(
  :member_id,
  :member_login,
  :member_password,
  :member_email,
  :member_tel,
  :member_name,
  :member_surname,
  :member_date)";

$sql= $conn->prepare($ins);

$sql->bindParam(":member_id",$_REQUEST['member_id'], PDO::PARAM_STR);
$sql->bindParam(":member_login",$_POST['member_login'], PDO::PARAM_STR);
$sql->bindParam(":member_password",$_POST['member_password'], PDO::PARAM_STR);
$sql->bindParam(":member_email",$_POST['member_email'], PDO::PARAM_STR);
$sql->bindParam(":member_tel",$_POST['member_tel'],PDO::PARAM_STR);
$sql->bindParam(":member_name",$_POST['member_name'], PDO::PARAM_STR);
$sql->bindParam(":member_surname",$_POST['member_surname'],PDO::PARAM_STR);
$sql->bindParam(":member_date",$_POST['member_date'],PDO::PARAM_STR);
$sql->execute();
echo "Użytkownik został dodany :) <br/><a href='admin.php'>Powrót</a>";
}
catch(PDOException $e) {
 echo  "Ops... Błąd! <br>" . $e->getMessage();
 //var_dump($sql);
  }

<meta charset="utf-8"/>
<?php
$servername = "localhost";
$username = "janzales_wsb";
$password = "Janek1994";

try {
    $conn = new PDO("mysql:host=$servername;dbname=janzales_wsb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  echo "Connected successfully";
$conn->query("SET NAMES utf8");

}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
  mysql_query("set names utf8");
?>

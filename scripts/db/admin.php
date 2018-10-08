
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>ORION - Strona Główna</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <meta charset="utf-8"/>
</head>
<body>
<?


include('main.php');
?>
<?
echo "<div class='container'>";
echo "<table class='table table-hover'>";
echo "<tr>

<th>Imię</th>
<th>Nazwisko</th>
<th>Login</th>
<th>E-mail</th>
<th>Telefon</th>
<th>Data początkowa</th>
</tr>";

class TableRows extends RecursiveIteratorIterator {

    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;' class='success'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {

        echo "</tr>" . "\n";
    }
}

$stmt = $conn->prepare("SELECT member_name,member_surname,member_login,member_email,member_tel,member_date FROM members");

$stmt->Execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
   foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

       echo $v;
     }

     echo "</table>";
     echo "</div>";
// koniec pętli else
?>
<!--dodawanie nowego Użytkownika -->
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<body>

<form id="regForm" action="admin_add.php" method="post">
  <h1>Rejestracja Użytkownika:</h1>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">I:
    <p><input placeholder="Nazwa Użytkownika" oninput="this.className = ''" name="member_login"></p>
    <p><input placeholder="Hasło" oninput="this.className = ''" name="member_password" type="password" >
<?
//skrypt generujący losowo hasło
function passwordGenerator($length) {
    $uppercase = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'W', 'Y', 'Z');
    $lowercase = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'w', 'y', 'z');
    $number = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);

    $password = NULL;

    for ($i = 0; $i < $length; $i++) {
        $password .= $uppercase[rand(0, count($uppercase) - 1)];
        $password .= $lowercase[rand(0, count($lowercase) - 1)];
        $password .= $number[rand(0, count($number) - 1)];
    }

    return substr($password, 0, $length);
}
$myPassword = passwordGenerator(8);
?>Wpisz powyżej wygenerowane losowo hasło: <? echo $myPassword?></p>
    </p>
  </div>
  <div class="tab">II:
    <p><input placeholder="E-mail..." oninput="this.className = ''" name="member_email"></p>
    <p><input placeholder="Telefon..." oninput="this.className = ''" name="member_tel" type="tel"></p>
  </div>
  <div class="tab">III:
    <p><input placeholder="Imię" oninput="this.className = ''" name="member_name"></p>
    <p><input placeholder="Nazwisko" oninput="this.className = ''" name="member_surname"></p>
  </div>
  <div class="tab">Data:
    <p><input type="date" oninput="this.className = ''" name="member_date"><? echo date('d.m.Y')?></p>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Poprzednie</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Następne</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Wyślij";
  } else {
    document.getElementById("nextBtn").innerHTML = "Dalej";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
<footer>
  <a href="../../main.php">Powrót do strony głównej</a>
&copy; by <a href="https://www.facebook.com/JZstronyWWW/" title="Jan Zalesiński - Strony WWW" target="_blank">Jan Zalesiński - Strony WWW</a>
<h2 id="feedback" onclick="sendMail();">Zgłoś problem</h2>
</footer>

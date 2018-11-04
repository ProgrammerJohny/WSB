<?php
function fetch_data()
{
  if (@file_exists(dirname(__FILE__).'/lang/pl.php')) {
    require_once(dirname(__FILE__).'/lang/pol.php');
    $pdf->setLanguageArray($l);
  }
     $output = '';
     $conn = new PDO('mysql:host=localhost;dbname=aplikacja', 'admin', 'Webmaster2017');
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $conn->query("set names utf8");

     $stmt = $conn -> query("SELECT * FROM customersInd");
     while($row = $stmt->fetch())
     {

     $output .= '<tr align="center">
                         <td>'.$row["ID_cus_ind"].'</td>
                         <td>'.$row["name_cus_ind"].'</td>
                         <td>'.$row["surname_cus_ind"].'</td>
                         <td>'.$row["pesel_cus_ind"].'</td>
                         <td>'.$row["number_cus_ind"].'</td>
                         <td>'.$row['period_cus_ind'].'</td>
                         <td>'.$row['contract_status_cus_ind'].'</td>
                         <td>'.$row['country_reg_cus_ind'].'</td>
                    </tr>
                         ';
     }
     return $output;
}
if(isset($_POST["create_pdf"]))
{
  require_once('../../tcpdf/tcpdf.php');
     $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf8', false);
     $obj_pdf->SetCreator(PDF_CREATOR);
     $obj_pdf->SetTitle("Raport tygodniowy");
     $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
     $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
     $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
     $obj_pdf->SetDefaultMonospacedFont('freesans');
     $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
     $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '1', PDF_MARGIN_RIGHT);
     $obj_pdf->setPrintHeader(false);
     $obj_pdf->setPrintFooter(false);
     $obj_pdf->SetAutoPageBreak(TRUE, 10);
     $obj_pdf->SetFont('freesans', '', 10);
     $obj_pdf->AddPage();
     $content = '';
     $content .= '
     <h3 align="center">Raport tygodniowy</h3><br /><br />
     <table border="1">
          <tr align="center">
               <th width="5%">ID</th>
               <th width="10%">Imię</th>
               <th width="16%">Nazwisko</th>
               <th width="20%">PESEL</th>
               <th width="10%">Numer Klienta</th>
               <th width="16%">Data podpisania umowy</th>
               <th width="10%">Status umowy</th>
               <th width="10%">Kraj zameldowania</th>
          </tr>
     ';
     $content .= fetch_data();
     $content .= '</table>';
     $obj_pdf->writeHTML($content);
     $obj_pdf->Output('Raport miesięczny.pdf', 'I');
}
?>
<!DOCTYPE html>
<html>
     <head>
          <title>Raport tygodniowy</title>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
          <meta charset="utf-8"/>
     </head>
     <body>
          <br /><br />
          <div class="container" style="width:700px;">
               <h3 align="center">Tworzenie raportu tygodniowego [<? echo date('d.m.Y')?> - <? echo date('d.m.Y',strtotime("-1 week"))?>]</h3><br />
               <h4 align="center">Jeżeli status umowy = 0 <b>umowa aktywna</b></h4>
               <div class="table-responsive">
                    <table class="table table-bordered">
                         <tr>
                              <th width="5%">ID</th>
                              <th width="30%">Imię</th>
                              <th width="10%">Nazwisko</th>
                              <th width="45%">PESEL</th>
                              <th width="10%">Numer Klienta</th>
                              <th width="20%">Data podpisania umowy</th>
                              <th width="30%">Status umowy</th>
                              <th width="30%">Kraj zameldowania</th>
                         </tr>
                    <?php
                    echo fetch_data();
                    ?>
                    </table>
                    <br />
                    <form method="post">
                         <input type="submit" name="create_pdf" class="btn btn-warning" value="Utwórz PDF" />
                    </form>
                      <button class="btn-sm btn-link" onclick="window.close()">Zamknij okno i wróc do strony głównej</button>
               </div>
          </div>
     </body>
</html>

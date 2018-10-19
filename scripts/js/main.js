//funkcje zawierąjące odnośniki do modułów
  function addIndywidualny()
{
  window.open("main/Ind/add.php","_self");
}
function addFirmowy()
{
  window.open("main/Firm/add.php","_self");
}
function editIndywidualny()
{
  window.open("main/Ind/overview.php","_self");
}
function editFirmowy()
{
  window.open("main/Firm/overview.php","_self");
}
function viewArchiwum()
{
  window.open("arch/main.php","_self");
}
function viewRaporty()
{
  window.open("reports/index.php","_self")
}
function sendMail()
{
  window.open("mailto:janzalesinski@gmail.com","_self");
}
function SearchName() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("input_ind");
  filter = input.value.toUpperCase();
  table = document.getElementById("TableInd");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function SearchPesel() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("input_ind1");
  filter = input.value.toUpperCase();
  table = document.getElementById("TableInd");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function SearchNumber() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("input_ind2");
  filter = input.value.toUpperCase();
  table = document.getElementById("TableInd");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
//-------------------------------------------------------//

// funkcja kopiowania danych w module add.php przy adresach Klienta
function copyStrings() {
      if(!document.addInd.country_corr_cus_ind.value)
          document.addInd.country_corr_cus_ind.value=document.addInd.country_reg_cus_ind.value;
      else
          document.addInd.country_corr_cus_ind.value='';
      if(!document.addInd.city_corr_cus_ind.value)
          document.addInd.city_corr_cus_ind.value = document.addInd.city_reg_cus_ind.value;
      else
          document.addInd.city_corr_cus_ind.value ='';
      if(!document.addInd.code_corr_cus_ind.value)
          document.addInd.code_corr_cus_ind.value = document.addInd.code_reg_cus_ind.value;
      else
          document.addInd.code_corr_cus_ind.value ='';

      if(!document.addInd.street_corr_cus_ind.value)
          document.addInd.street_corr_cus_ind.value = document.addInd.street_reg_cus_ind.value;
      else
          document.addInd.street_corr_cus_ind.value='';
      if(!document.addInd.numberhouse_corr_cus_ind.value)
          document.addInd.numberhouse_corr_cus_ind.value = document.addInd.numberhouse_reg_cus_ind.value;
      else
          document.addInd.numberhouse_corr_cus_ind.value='';
      if(!document.addInd.numberflat_corr_cus_ind.value)
          document.addInd.numberflat_corr_cus_ind.value = document.addInd.numberflat_reg_cus_ind.value;
      else
          document.addInd.numberflat_corr_cus_ind.value='';
} // koniec funkcji copyStrings()

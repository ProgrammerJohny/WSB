function SearchNameFirm() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("input_firm");
  filter = input.value.toUpperCase();
  table = document.getElementById("TableFirm");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      }
      else {
        tr[i].style.display = "none";
      }
    }
  }
}
function SearchNIP() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("input_firm1");
  filter = input.value.toUpperCase();
  table = document.getElementById("TableFirm");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      }
      else {
        tr[i].style.display = "none";
      }
    }
  }
}
function SearchNumberFirm() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("input_firm2");
  filter = input.value.toUpperCase();
  table = document.getElementById("TableFirm");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      }
      else {
        tr[i].style.display = "none";
      }
    }
  }
}
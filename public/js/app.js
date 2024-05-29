
function tableSearch(inputID, tableID) {
	// Declare variables
	var input, filter, table, tr, td, i, txtValue;
	var rowDisplay;

	input = document.getElementById(inputID);
	filter = input.value.toUpperCase();
	table = document.getElementById(tableID);
	tr = table.getElementsByTagName("tr");

	// Loop through all table rows
	for (i = 0; i < tr.length; i++) {
		rowDisplay = 'none';
		// Loop through all columns in row
		td = tr[i].getElementsByTagName("td");
		for (j = 0; j < td.length; j++) {
			txtValue = td[j].textContent || td[j].innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				rowDisplay = "";
			}
		}
		tr[i].style.display = rowDisplay;
	}
}


<?php
//ini_set('display_errors', 'On');
include 'excel_reader2.php';
	//display form to upload the excel file
	if($action=="import_excel") {
	echo "	<center>
		Upload your Excel file below to import multiple users.
		</center>
		<div class='cont_header'>
		Upload
		</div>
		Select file to upload below. The file must be a Microsoft Excel .xls file.<br>
		<form enctype='multipart/form-data' method='post' action='$index_file?action=import_excel2'>
		<input type='hidden' name='MAX_FILE_SIZE' value='2000000' />
		<input type='file' name='xlsdoc' /><br>
		<input type='submit' value='Upload' /> <input type='reset' value='Reset'/>
		</form>
	";
	}

	//process the file and display preview of data that will be added
	elseif($action=="import_excel2") {
		if($_FILES['xlsdoc']['error'] == 0) {
		$data = new Spreadsheet_Excel_Reader( $_FILES['xlsdoc']['tmp_name']);

		//excel document should have the following attributes
		//on original excel sheet that they are using, they have a Name field, along with f and l name, but that is not necessary.
		//vol, int, pay, rec, sus, gcp, rare, earc, date, grad, f_name, l_name, phone, email, notes, gender, g_level(year)
		
		//proposed order for spreadsheet:
		//l_name, f_name, email, date, g_level, vol, int, pay, rec, sus, gcp, rare, earc, grad, phone, notes, gender
		
		//iterate through each row, was trying to use her excel file, hence the long list. but will change
		//to loop instead of 20 lines of code, and use a new excel doc. there is redundant info in the current one
		echo "	<center>Below is the information that will be added to the database. Click Add Users to continue.<br>
			<form action='$index_file?action=import_excel3' method='post'>
			<input type='submit' value='Add Users' />
			</form>
			</center>
			<div class='cont_header'>Preview</div>
			<div class='tbl_container'>";
		for($i=2; $i<=$data->rowcount($sheet_index=0); $i++) {
			
			//for each row, output some cells
			echo "<div class='tbl_row'>";
			for($j=1; $j<4; $j++) {		//increase $j<4 to display more info to user

				//setting cell style(different widths, see stylesheet)
				if($j==3) $cell_style="tbl_cell_email";
		//		elseif($j>=6||$j<=13) $cell_style="tbl_cell_narrow";  <---/this will probably be deleted
				else $cell_style="tbl_cell";

				//output cells
				echo "<div class='$cell_style'>".$data->val($i,$j)."</div>";
				
			}
			echo "&nbsp</div>";
		}
		echo "</div>";
	}
	else {
		echo 'error';
	}
	}
	//process sql statements and display confirmation
	elseif($action=="import_excel3") {
	echo "display confirmation here";
	}
?>

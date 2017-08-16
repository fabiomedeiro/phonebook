<?php
require ("main.php");	
if(check_session() == 0){

}else{
        exit("You must be logged in to view this page");
}


$result  = consult_db("");

function row($r){
		$id = $r['id'];
		$vals = array_values($r);
		$row ="<tr id=$id>";
		foreach ($vals as $key => $value) {
				$row .= "<td>";
				$row .= $value;
				$row .="</td>";
		}
		$row .= "<td><button class='btn btn-mini btn-danger delete' type='button'>Delete</button></td>";
		$row .="</tr>";
		return $row;
}*/
?>

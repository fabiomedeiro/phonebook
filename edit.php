<?php
require ("main.php");	
if(check_session() == 0){

}else{
        exit("You must be logged in to view this page");
}

$result = consult_db("office_phones", "*");
?>
    <div class="container">
	<table id="table" class="table table-striped" class='tablesorter' ><form action="edit_phones.php" method="post">
            <thead>
              <tr> <th>Phone number</th><th>User</th><th>Actions</th></tr>
            </thead>

             <?php
		for($a=0; $a < count($result); $a++)
		{
			echo "<tr><td>". $result[$a]['pnumber'] ."</td>";
			echo "<td>". $result[$a]['users'] ."</td>";
			echo '<td><button name="edit" type="submit" value='. $result[$a]['mac'] .'>Edit</button></td></tr>';

		}
            ?>
	  </form></table></div>

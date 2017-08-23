<?php
	require ("main.php");
	$result = consult_db("office_phones", "*");
?>
    <div class="container" align="center">
        <table id="table" class="table table-striped" class="tablesorter" >
        <h1>Phonebook</h1> 
	<form action="edit_phones.php" method="post">
            <thead>
              <tr> <th>Phone number</th><th>User</th><th>Departmet</th></tr>
            </thead>

             <?php
                for($a=0; $a < count($result); $a++)
                {
                        echo "<tr><td>". $result[$a]['pnumber'] ."</td>";
                        echo "<td>". $result[$a]['users'] ."</td>";
			echo "<td>". $result[$a]['location'] ."</td></tr>";
                }
            ?>
          </form></table></div>


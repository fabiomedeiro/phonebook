<?php
require ("main.php");


$result = $_POST['edit2'] ;
$result = consult_db("office_phones", $result);
?>
<div class="container" align="center">
	<h1>Are you sure you want to delete?</h1>
	<?php
	  echo "<h3>Phone: ". $result[0]['pnumber'] ." User: ". $result[0]['users'] ." MAC: ". $result[0]['mac'] ."</h3>";

	echo "<br>";
	echo '<form action="del_mac.php" method="post">';
	 	 echo '<button name="del" type="submit" class="btn" value='. $result[0]['mac'] .'>Yes</button>';
		echo '<button type=="submit" class="btn" formaction="edit.php">NO</button>';
	echo "</form>";
	?>
</div>

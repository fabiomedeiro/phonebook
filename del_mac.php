<?php
require ("main.php");


$result = $_POST['del'];
$conn = connect_db();
unlink("/home/tftpboot/". $result .".cfg");
unlink("macs_files/". $result .".cfg");
$stmt = $conn->prepare("delete FROM office_phones WHERE mac='$result'");
$stmt->execute();
?>
<div class="container" align="center">
	<h1>File Deleted </h1>
	<form action="edit.php" method="post">
		<button type="submit" class="btn" >OK</button>
	</form>
</div>

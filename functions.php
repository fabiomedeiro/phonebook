<?php

function connect_db()
{
	include 'config_db.php';
	try {
    		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    		// set the PDO error mode to exception
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn; 
    	}
	catch(PDOException $e)
    	{
    		echo "Connection failed: " . $e->getMessage();
    	}
}
function consult_db($table, $pk)
{
	$conn = connect_db();
	if ($pk == "*")
	{
		$stmt = $conn->prepare("SELECT * FROM $table");		
	}else{  
		if ($table == "office")
			{
				$stmt = $conn->prepare("SELECT * FROM $table WHERE mac='$pk'");
			}
		if ($table == "blueface")
                        {
                                $stmt = $conn->prepare("SELECT * FROM $table WHERE mac='$pk'");
                        }       

	}
	$stmt->execute();
    	if ($stmt->rowCount() > 0) 
	{	
		$data = $stmt->fetchAll();
		return $data;
			 
	}else {
		return "0";
	}
}
function insert_table_office($mac, $id, $password, $users, $location,  $status)
{
	$conn = connect_db();
        $stmt = $conn->prepare("INSERT INTO office (mac, id, password, users, location, status) VALUES ('$mac', '$id', '$password', '$users', '$location',  '$status')");
	$stmt->execute();
}
function update_table_office($mac, $id, $password, $users, $location,  $status)
{
	$table = "office";
	$conn = connect_db();
	$consult = consult_db($table, $mac);
	if ($consult[0]["mac"] == $mac)
	{
			if ($consult[0]["id"] != $id)
			{
				$stmt = $conn->prepare("UPDATE  $table SET id='$id' WHERE mac='$mac'");
        			$stmt->execute();
			}
			if ($consult[0]["users"] != $users)
                        {
                                $stmt = $conn->prepare("UPDATE $table SET users='$users' WHERE mac='$mac'");
                                $stmt->execute();
                        }
			if ($consult[0]["location"] != "0")
                        {
                                $stmt = $conn->prepare("UPDATE $table SET location='$location' WHERE mac='$mac'");
                                $stmt->execute();
                        }
			if ($consult[0]["status"] != "0")
                        {
                                $stmt = $conn->prepare("UPDATE  $table SET status='$status' WHERE mac='$mac'");
                                $stmt->execute();
                        }
			if ($consult[0]["password"] != $password)
                        {
                                $stmt = $conn->prepare("UPDATE $table SET password='$password' WHERE mac='$mac'");
                                $stmt->execute();
                        }
	}else{
		insert_table_office( $mac, $id, $password, $users, $location,  $status);
	}
}
function read_folder()
{
	$files = scandir("/srv/tftpboot");
	return $files;
}
function read_file($files)
{
	$xml=simplexml_load_file("/srv/tftpboot/$files") or die("Error: Cannot create object");
	return $xml;
	echo $xml->User_ID_1_;
	echo $xml->Password_1_;
	echo $xml->Display_Name_1_;
}
function auto_update_office()
{
	$files = read_folder();
	$n_files = count($files);
	for ($x = 3; $x < $n_files;$x++)
	{
		$mac = substr($files[$x],0,12);
		$data = read_file($files[$x]);
		update_table_office($mac, $data->User_ID_1_ , $data->Password_1_, $data->Display_Name_1_, "0", "0");
	}


}
?>


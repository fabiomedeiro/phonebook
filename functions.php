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
function insert_table_office( $mac, $id, $users, $location,  $status, $password)
{
	$conn = connect_db();
        $stmt = $conn->prepare("INSERT INTO $table (mac, id, users, location, status, password) VALUES ('$mac, $id, $users, $location,  $status, $password'");
	$stmt->execute();
}
function update_table_office( $mac, $id, $users, $location,  $status, $password)
{
	$table = "office";
	$conn = connect_db();
	$consult = consult_db($table, $mac);
	echo $consult[0]["mac"];
	if ($consult[0]["mac"] == $mac)
	{
			if ($consult[0]["id"] != $id)
			{
				$stmt = $conn->prepare("UPDATE  $table SET id='$id' WHERE mac='$mac'";
        			$stmt->execute();
			}
			if ($consult[0]["users"] != $users)
                        {
                                $stmt = $conn->prepare("UPDATE $table SET users='$users' WHERE mac='$mac'";
                                $stmt->execute();
                        }
			if ($consult[0]["location"] != $locations)
                        {
                                $stmt = $conn->prepare("UPDATE $table SET location='$location' WHERE mac='$mac'";
                                $stmt->execute();
                        }
			if ($consult[0]["status"] != $status)
                        {
                                $stmt = $conn->prepare("UPDATE  $table SET status='$status' WHERE mac='$mac'";
                                $stmt->execute();
                        }
			if ($consult[0]["password"] != $password)
                        {
                                $stmt = $conn->prepare("UPDATE $table SET password='$password' WHERE mac='$mac'";
                                $stmt->execute();
                        }
	}else{
		insert_table_office( $mac, $id, $users, $location,  $status, $password);
	}
}
update_table_office("*");
?>

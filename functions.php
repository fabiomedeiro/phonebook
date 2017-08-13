<?php
include 'classes.php';

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
		if ($table == "phones")
			{
				$stmt = $conn->prepare("SELECT * FROM $table WHERE mac='$pk'");
			}
		if ($table == "voicemail")
                        {
                                $stmt = $conn->prepare("SELECT * FROM $table WHERE mailbox='$pk'");
                        }       
		if ($table == "numbers")
			{
				$stmt = $conn->prepare("SELECT * FROM $table WHERE numbers='$pk'");
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

function insert_phones($mac, $numbers, $users, $location,  $status)
{
	$conn = connect_db();
        $stmt = $conn->prepare("INSERT INTO phones (mac, numbers, users, location, status) VALUES ('$mac', '$numbers', '$users', '$location',  '$status')");
	$stmt->execute();
}

function insert_numbers($numbers, $account, $password, $mailbox)
{
	$conn = connect_db();
	$stmt = $conn->prepare("INSERT INTO numbers (numbers, account, password, mailbox) VALUES ('$numbers', '$account', '$password', '$mailbox')");
	$stmt->execute();
}

function insert_voicemail($mailbox, $pin, $name, $mail)
{
	        $conn = connect_db();
		        $stmt = $conn->prepare("INSERT INTO voicemail (mailbox, pin, name, mail) VALUES ('$mailbox', '$pin', '$name', '$mail')");
		        $stmt->execute();
}

function update_phones($mac, $numbers, $users, $location,  $status)
{
	$conn = connect_db();
	$consult = consult_db("phones", $mac);
	if ($consult[0]["mac"] == $mac)
	{
			if ($consult[0]["numbers"] != $numbers)
			{
				$stmt = $conn->prepare("UPDATE phones SET numbers='$numbers' WHERE mac='$mac'");
        			$stmt->execute();
			}
			if ($consult[0]["users"] != $users)
                        {
                                $stmt = $conn->prepare("UPDATE phones SET users='$users' WHERE mac='$mac'");
                                $stmt->execute();
                        }
			if ($consult[0]["location"] != "0")
                        {
                                $stmt = $conn->prepare("UPDATE phones SET location='$location' WHERE mac='$mac'");
                                $stmt->execute();
                        }
			if ($consult[0]["status"] != "0")
                        {
                                $stmt = $conn->prepare("UPDATE  phones SET status='$status' WHERE mac='$mac'");
                                $stmt->execute();
                        }
	}else{
		insert_phones($mac, $numbers, $users, $location,  $status);
	}
}

function update_voicemail($mailbox, $pin, $name, $mail)
{
	        $conn = connect_db();
		$consult = consult_db("voicemail", $mailbox);
		if ($consult[0]["mailbox"] == $mailbox)
		{
			if ($consult[0]["pin"] != $pin)
			{
				$stmt = $conn->prepare("UPDATE voicemail SET pin='$pin' WHERE mailbox='$mailbox'");
				$stmt->execute();
			}
			if ($consult[0]["name"] != $name)
			{ 
				$stmt = $conn->prepare("UPDATE voicemail SET name='$name' WHERE mailbox='$mailbox'");
				$stmt->execute();                                                                                                                      }
			if ($consult[0]["mail"] != $mail)
			{       
				$stmt = $conn->prepare("UPDATE voicemail SET mail='$mail' WHERE mailbox='$mailbox'");                                                           $stmt->execute();
			}
		}else{
			insert_voicemail($mailbox, $pin, $name, $mail);
		}
}

function update_numbers($numbers, $account, $password, $mailbox)
{
	$conn = connect_db();
	$consult = consult_db("numbers", $numbers);
	if ($consult[0]["numbers"] == $numbers)
	{
		if ($consult[0]["account"] != $account)
		{
			$stmt = $conn->prepare("UPDATE numbers SET account='$account' WHERE numbers='$numbers'");
			$stmt->execute();
		}
		if ($consult[0]["password"] != $password)
		{
		        $stmt = $conn->prepare("UPDATE numbers SET password='$password' WHERE numbers='$numbers'");
		        $stmt->execute();
		}
		if ($consult[0]["mailbox"] != $mailbox)
		{
		        $stmt = $conn->prepare("UPDATE numbers SET mailbox='$mailbox' WHERE numbers='$numbers'");
		        $stmt->execute();
		}
	}else{
		insert_numbers($numbers, $account, $password, $mailbox);
	}
}

/*
function read_folder()
{
	$files = scandir("/home/tftpboot");
	return $files;
}
function read_file($files)
{
	$xml=simplexml_load_file("/home/tftpboot/$files") or die("Error: Cannot create object");
	return $xml;
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
auto_update_office();
 */
?>


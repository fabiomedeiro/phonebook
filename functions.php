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
		if ($table == "blueface_data")
			{
				$stmt = $conn->prepare("SELECT * FROM $table WHERE pnumber='$pk'");
			}
		if ($table == "office_phones")
                        {
                                $stmt = $conn->prepare("SELECT * FROM $table WHERE mac='$pk'");
                        }
		if ($table == "admins")
                        {
                                $stmt = $conn->prepare("SELECT * FROM $table WHERE name='$pk'");
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

function insert_office_phones($mac, $numbers, $users, $location,  $img)
{
	$conn = connect_db();
        $stmt = $conn->prepare("INSERT INTO office_phones (mac, pnumber, users, location, img) VALUES ('$mac', '$numbers', '$users', '$location',  '$img')");
	$stmt->execute();
}

function insert_blueface_data($numbers, $account, $password, $mailbox, $pin, $name, $mail)
{
	$conn = connect_db();
	$stmt = $conn->prepare("INSERT INTO blueface_data (pnumber, account, password, mailbox, pin, name, mail) VALUES ('$numbers', '$account', '$password', '$mailbox', '$pin', '$name', '$mail')");
	$stmt->execute();
}


function update_office_phones($mac, $numbers, $users, $location,  $img)
{
	$conn = connect_db();
	$consult = consult_db("office_phones", $mac);
	if ($consult[0]["mac"] == $mac)
	{
			if ($consult[0]["pnumber"] != $numbers)
			{
				$stmt = $conn->prepare("UPDATE office_phones SET pnumber='$numbers' WHERE mac='$mac'");
        			$stmt->execute();
			}
			if ($consult[0]["users"] != $users)
                        {
                                $stmt = $conn->prepare("UPDATE office_phones SET users='$users' WHERE mac='$mac'");
                                $stmt->execute();
                        }
			if ($consult[0]["location"] != $location)
                        {
                                $stmt = $conn->prepare("UPDATE office_phones SET location='$location' WHERE mac='$mac'");
                                $stmt->execute();
                        }
			if ($consult[0]["img"] != $img)
                        {
                                $stmt = $conn->prepare("UPDATE  office_phones SET img='$img' WHERE mac='$mac'");
                                $stmt->execute();
                        }
	}else{
		insert_office_phones($mac, $numbers, $users, $location,  $status);
	}
}
function update_blueface_data($numbers, $account, $password, $mailbox, $pin, $name, $mail)
{
	$conn = connect_db();
	$consult = consult_db("blueface_data", $numbers);
	if ($consult[0]["pnumber"] == $numbers)
	{
		if ($consult[0]["account"] != $account)
		{
			$stmt = $conn->prepare("UPDATE blueface_data SET account='$account' WHERE numbers='$numbers'");
			$stmt->execute();
		}
		if ($consult[0]["password"] != $password)
		{
		        $stmt = $conn->prepare("UPDATE blueface_data SET password='$password' WHERE numbers='$numbers'");
		        $stmt->execute();
		}
		if ($consult[0]["mailbox"] != $mailbox)
		{
		        $stmt = $conn->prepare("UPDATE blueface_data SET mailbox='$mailbox' WHERE numbers='$numbers'");
		        $stmt->execute();
		}
		if ($consult[0]["pin"] != $pin)
                {
                        $stmt = $conn->prepare("UPDATE blueface_data SET pin='$pin' WHERE mailbox='$mailbox'");
                        $stmt->execute();
                }
                if ($consult[0]["name"] != $name)
                { 
                        $stmt = $conn->prepare("UPDATE blueface_data SET name='$name' WHERE mailbox='$mailbox'");
                        $stmt->execute(); 
                }
                if ($consult[0]["mail"] != $mail)
                {
                        $stmt = $conn->prepare("UPDATE blueface_data SET mail='$mail' WHERE mailbox='$mailbox'");
                        $stmt->execute();
                }

	}else{
		insert_blueface_data($numbers, $account, $password, $mailbox, $pin, $name, $mail);
	}
}
function check_session()
{
	session_start();
	if(isset($_SESSION['user']))
	{
		return 0;
      	}else{
		return 1;
            }

}

function read_folder()
{
	$files = scandir("/home/tftpboot");
	return $files;
}
?>


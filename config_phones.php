<?php
require ("main.php");


$display = $_POST['disp'] ;
$img = $_POST['img'] ;
$mac = $_POST['mac'];
$location = $_POST['department'];
$pnumber = $_POST['numbers'];
$fileName = "";
$error = false;
$result = consult_db("blueface_data",$pnumber);
$user = $result[0]['account'];
$pass = $result[0]['password'];

if($display == "" || $mac == "" || $user == "" || $pass == ""){
	echo "Please go back and ensure all fields are completed";
	$error = true;
}

if(!$error  && !checkMac($mac)){
	echo "Please go back and enter a valid Mac address of the form: ";
	echo "<ul>" .
              "<li>000E08D06A63</li>" .
              "<li>00:0E:08:D0:6A:63</li>" .
              "<li>00-0E-08-D0-6A-63</li>" .
              "<li>000e08d06a63</li>" .
            "</ul>";
	$error = true;
}

if(!$error){
	$mac = normaliseMac($mac);
	$fileName = genFileName($mac);

}
if (file_exists($fileName))
{
	$xml = simplexml_load_file($fileName);
	$xml->Short_Name_1_ = "$display";
	$xml->User_ID_1_ = $user;
	$xml->Password_1_ = $pass;
	$xml->Display_Name_1_ = "$display";
	$xml->BMP_Picture_Download_URL = "tftp://192.168.30.133/logos/". $img .".bmp";
	copyConfig("$fileName");
	update_office_phones($mac, $pnumber, $display, $location,  $img);
        echo " <p class='lead' align='center'>Config update succesfully and opied to TFTP Server</p>";
        echo '<form  align="center"method="post" action="edit.php">
        <button type="submit" class="btn">OK</button></form>';

}else{
	//Do a DB lookup to make sure the IP isnt in use?
	//Or a grep of the dir on shout to make sure the IP isnt in use

	$template = file_get_contents("macs_files/template.xml");
	$template = str_replace("##DISP##", $display, $template);
	$template = str_replace("##IMG##", $img, $template);
	$template = str_replace("##USER##", $user, $template);
	$template = str_replace("##PASS##", $pass, $template);
	$template = str_replace("##MAC##", strtoupper($mac), $template);
	file_put_contents($fileName, $template);
	chmod($fileName, 0775);
	echo copyConfig("$fileName");
	update_office_phones($mac, $pnumber, $display, $location,  $img);
	echo " <p class='lead' align='center'>Config succesfully copied to TFTP Server</p>";
	echo '<form class="navbar-form pull-left" name="OK" method="post" action="edit.php">
      	<button aling="center" type="submit" id="ok_btn" class="btn pull-center">OK</button></form>';
}
function genFileName($mac){
	return "macs_files/" . $mac . ".cfg";
}


function normaliseMac($m){
	$normal = str_replace(":", "", $m);
	$normal = str_replace("-", "", $normal);
	return strtolower($normal);
}


function checkMac($m){
	$colon = "/^([A-F0-9]{2}:){5}[A-F0-9]{2}$/i";
	$nodelim = "/^([A-F0-9]{2}){6}$/i"; 
	$dash = "/^([A-F0-9]{2}-){5}[A-F0-9]{2}$/i";
	if(preg_match($colon,$m) == 1){
		return true;
	}else if(preg_match($dash,$m) == 1){
		return true;
	}else if(preg_match($nodelim,$m) == 1){
		return true;
	}else{
		return false;
	}
}

function copyConfig($f){
	$status = exec("cp $f /home/tftpboot");
	return $status;
}

?>

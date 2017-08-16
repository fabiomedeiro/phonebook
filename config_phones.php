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
$status = "Active";

echo  $display;
echo $img;
echo $mac;
echo $location;
echo $pnumber;
/*if($display == "" || $mac == "" || $user == "" || $pass == ""){
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
update_office_phones($mac, $pnumber, $display, $location,  $status);
echo " <p class='lead'>Config succesfully copied to TFTP Server</p>";
echo '<form class="navbar-form pull-left" name="OK" method="post" action="edit.php">
      <button type="submit" id="ok_btn" class="btn pull-right">OK</button></form>';
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
*/
?>

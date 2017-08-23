<?php
include 'functions.php';
$api = new PoxnoraAPI(); 
$cookie=$api->login('journal', '8DFG10AGnr4L');
$url[0] = "https://portal.blueface.com/ie/pbxgui/provisioning.aspx?method=getsip&customerid=28beb3b7-cee0-4f5e-b88f-17950d9b6fd9";
$url[1] = "https://portal.blueface.com/ie/pbxgui/pbxguixml.aspx?method=getvoicemail&simulate=false";
$url[2] = "https://portal.blueface.com/ie/pbxgui/pbxguixml.aspx?method=getnumbers&simulate=false";
for ($a = 0; $a < 3; $a++)
{
	$ch = curl_init($url[$a]);
	curl_setopt($ch, CURLOPT_COOKIEJAR,      $cookie);
	curl_setopt($ch, CURLOPT_COOKIEFILE,     $cookie);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result = curl_exec($ch);
	$pwd = "blueface/file" .$a . ".xml";
	$file = fopen($pwd,"w");
	fwrite($file,$result);
	fclose($file);
	curl_close($ch);
	$xml[$a]=simplexml_load_file($pwd) or die("Error: Cannot create object");
}

if ($xml[0]->error)
{
	echo $xml[0]->error;
}else{
	for ($a = 0; $a < count($xml[2]->numbers->number); $a++)
	{
		$numbers = substr($xml[2]->numbers->number[$a]['id'],3);
		$account = substr($xml[2]->numbers->number[$a]->route->normal->first,4);
		$mailbox = $xml[2]->numbers->number[$a]->route->voicemail->mailbox;
		for ($b= 0; $b < count($xml[0]->sipaccounts->sipaccount); $b++)
		{
	      		if($xml[0]->sipaccounts->sipaccount[$b]->accountname == substr($xml[2]->numbers->number[$a]->route->normal->first,4))
               		{
				$password = $xml[0]->sipaccounts->sipaccount[$b]->secret;
				$b = count($xml[0]->sipaccounts->sipaccount);
			}
	 	}
		if (intval($mailbox) ==  NULL)
		{
			$name = NULL;
                	$pin = NULL;
               		$mail = NULL;
		}else{
	 		for ($c = 0; $c < count($xml[1]->voicemailaccounts->voicemailaccount); $c++)
	 		{
				if(intval($xml[1]->voicemailaccounts->voicemailaccount[$c]->mailbox) == $xml[2]->numbers->number[$a]->route->voicemail->mailbox)
				{
					$name = $xml[1]->voicemailaccounts->voicemailaccount[$c]->name;
        				$pin = $xml[1]->voicemailaccounts->voicemailaccount[$c]->pin;
        				$mail = $xml[1]->voicemailaccounts->voicemailaccount[$c]->emailaddress;
				}
			}
		}
		update_blueface_data($numbers, $account, $password, $mailbox, $pin, $name, $mail);
	}
}
?>

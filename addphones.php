<?php
require ("main.php");
if(isset($_SESSION['user'])){

}else{
  exit("You must be logged in to view this page");
}
$display = $_POST['disp'] ;
$img = $_POST['img'] ;
$mac = $_POST['mac'];
$location = $_POST['department'];
$pnumber = $_POST['numbers'];

?>
<html>

<head>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">

</head>

<body>
   <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
 <?php
if ($display == NULL)
{
   echo' <div class="page-header">
          <h1>Journalizer</h1>
        </div>
        <p class="lead">This tool generates configs for the Linksys SPA942G / Cisco 502G phones.</p>
        <p class= "lead">Features</p>
        <dl class="dl-horizontal">
          <dt>Mac Validation</dt>
          <dd>Checks that mac addresses are valid, examples of valid macs
            <ul>
              <li>000E08D06A63</li>
              <li>00:0E:08:D0:6A:63</li>
              <li>00-0E-08-D0-6A-63</li>
              <li>000e08d06a63</li>
            </ul>
          </dd>
       <dt>Config Installation</dt>
          <dd>Names the config correctly and copies it to the TFTP Server</dd>
        </dl>';
        echo '<form action="config_phones.php" method="post">
		<fieldset>
           		<legend>Create / Alter Config</legend>
            		<label>Display Name</label>
            		<input type="text" name="disp" placeholder="e.g Journal23">
			<label>Image Name</label>
            		<input type="text" name="img" placeholder="42, DE or jrnl">
			<label>Mac</label>
            		<input type="text" name="mac" placeholder="e.g 000E08D06A63 ">
           		 <label>Department</label>
            		<input type="text" name="department" placeholder="e.g The Journal">
            		<label>Phone Number</label>
	    		<select name="numbers">';
			$result = consult_db("blueface_data","*");
			for ($a = 0; $a < count($result); $a++)
			{
				echo "<option value=". $result[$a]['pnumber'] .">". $result[$a]['pnumber'] ."</option>";
			}
	    echo '</select>
	   		<span class="help-block">Clicking Generate Config will copy the config to the tftpserver</span>
           		 <button type="submit" class="btn">Generate Config</button>
          	</fieldset>
        	</form>';
}else{
       echo  '<dt>Delete Phone</dt>';
       echo'<form action="delphones.php" method="post">
        	<fieldset>
            		<label>Display Name</label>';
        echo '<input type="text" name="disp" value='. $result[0]['users'] .'>';
        echo '<label>Image Name</label>
               <input type="text" name="img" placeholder="42, DE or jrnl">
            <label>Mac</label>';
        echo '<input type="text" name="mac" value='. $result[0]['mac'] .'>';
        echo'    <label>Department</label>';
        echo '<input type="text" name="department" value='. $result[0]['location'] .'>';
        echo '<label>Phone Number</label>';
        echo '<input type="text" name="numbers" value='. $result[0]['pnumber'] .'>';
        echo'   <button type="submit" class="btn">Delete</button>
          </fieldset>
         </form>';

}
?>
      </div>

      <div id="push"></div>
      
      </div>

    <div id="footer">
      <div class="container">
        <p class="muted credit">Conor Maher - 2013</p>
      </div>
    </div>

</body>

</html>


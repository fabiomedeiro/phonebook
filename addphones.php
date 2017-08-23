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
      <div class="container" align="center">
   <div class="page-header">
          <h1>Journalizer</h1>
        </div>
        <p class="lead">This tool generates configs for the Linksys SPA942G / Cisco 502G phones.</p>
        <p class= "lead">Features</p>
          <dt>Mac Validation</dt>
          <dd>Checks that mac addresses are valid, examples of valid macs
            
              <dd>000E08D06A63</dd>
              <dd>00:0E:08:D0:6A:63</dd>
              <dd>00-0E-08-D0-6A-63</dd>
              <dd>000e08d06a63</dd>
            
          </dd>
       <dt>Config Installation</dt>
          <dd>Names the config correctly and copies it to the TFTP Server</dd>
        <form action="config_phones.php" method="post">
		<fieldset>
           		<legend>Create / Alter Config</legend>
            		<label>Display Name</label>
            		<input type="text" name="disp" placeholder="e.g Journal23">
			<label>Image Name</label>
              			<select name="img">
                        		<option value="jrnl">jrnl</option>
                        		<option value="DE">DE</option>
                       			<option value="42">42</option>
					<option value="jmedia">Jmedia</option>
					<option value="fora">Fora</option>
               			</select>

			<label>Mac</label>
            		<input type="text" name="mac" placeholder="e.g 000E08D06A63 ">
           		 <label>Department</label>
            			<select name="department">
                                        <option value="The Journal">The Journal</option>
                                        <option value="Daily Edge">The Daily Edge</option>
                                        <option value="The 42"> The 42</option>
					<option value="The Jmedia">The Jmedia</option>
					<option value="Tech">Tech</option>
                                </select>
			<label>Phone Number</label>
	    		<select name="numbers">
			<?php
				$result = consult_db("blueface_data","*");
				for ($a = 0; $a < count($result); $a++)
				{
					echo "<option value=". $result[$a]['pnumber'] .">". $result[$a]['pnumber'] ."</option>";
				}
			?>
	    </select>
	   	<span class="help-block">Clicking Generate Config will copy the config to the tftpserver</span>
           	<button type="submit" class="btn">Generate Config</button>
          	</fieldset>
        	</form>
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


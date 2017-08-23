<?php
require ("main.php");


$result = $_POST['edit'] ;
$result = consult_db("office_phones", $result);
?>
<div class="container" align="center">
	<form action="config_phones.php" method="post">
	<fieldset>
            <label>Display Name</label>
	    <?php
            	echo '<input type="text" name="disp" value="'. $result[0]['users'] .'">';
            ?>
            <label>Image Name</label>
              <select name="img">
		<?php echo "<option selected=". $result[0]['img'] .">". $result[0]['img'] ."</option>";?>
			<option value="jrnl">jrnl</option>
			<option value="DE">DE</option>
			<option value="42">42</option>
			<option value="jmedia">Jmedia</option>
			<option value="fora">Fora</option>
	       </select>
	    <label>Mac</label>
	    <?php
	    	echo '<input type="text" name="mac" value="'. $result[0]['mac'] .'">';
            ?>
            <label>Department</label>
	    <select name="department">
                          <?php echo "<option selected=". $result[0]['location'] .">". $result[0]['location'] ."</option>";?> 
					<option value="The Journal">The Journal</option>
                                        <option value="The Daily Edge">the Daily Edge</option>
                                        <option value="The 42">The 42</option>
					<option value="Fora">Fora</option>
                                        <option value="The Jmedia">The Jmedia</option>
                                        <option value="Tech">Tech</option>
                                </select>

            <label>Phone Number</label>
	    <?php
            	echo '<select name="numbers">';
               		echo "<option selected=". $result[0]['pnumber'] .">". $result[0]['pnumber'] ."</option>";
                        $result = consult_db("blueface_data","*");
                        for ($a = 0; $a < count($result); $a++)
                        {
                                echo "<option value=". $result[$a]['pnumber'] .">". $result[$a]['pnumber'] ."</option>";
                        }
                ?>
            </select>
	   <br>
	   <button type="submit" class="btn">Save</button>
          </fieldset>
	 </form>
</div>

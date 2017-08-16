<?php
require ("main.php");


$result = $_POST['edit'] ;
$result = consult_db("office_phones", $result);
function action($a)
{
	echo $a;
}
?>
<div class="container">
	<form action="addphones.php" method="post">
	<fieldset>
            <label>Display Name</label>
	    <?php
            	echo '<input type="text" name="disp" value='. $result[0]['users'] .'>';
            ?>
            <label>Image Name</label>
               <input type="text" name="img" placeholder="42, DE or jrnl">
	    <label>Mac</label>
	    <?php
	    	echo '<input type="text" name="mac" value='. $result[0]['mac'] .'>';
            ?>
            <label>Department</label>
	    <?php
            	echo '<input type="text" name="department" value='. $result[0]['location'] .'>';
 	    ?>
            <label>Phone Number</label>
	    <?php
            	echo '<select name="numbers" value='. $result[0]['pnumber'] .'>';
               
                        $result = consult_db("blueface_data","*");
                        for ($a = 0; $a < count($result); $a++)
                        {
                                echo "<option value=". $result[$a]['pnumber'] .">". $result[$a]['pnumber'] ."</option>";
                        }
                ?>
            </select>
	   <button type="submit" class="btn">Save</button>
          </fieldset>
	 </form>
</div>

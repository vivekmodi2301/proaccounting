<?php
	if(isset($_FILES['restorefile']['name'])){
		global $id;
		$tables = 'company';
		$tables = is_array($tables) ? $tables : explode(',',$tables);
		
	foreach($tables as $table)
	{
		//echo "hi";	
	@	mysqli_query($con,'delete  FROM '.$table);
	}
	function check_input($value)
	{
			//echo $value;exit;
	  		$value = mysql_real_escape_string(trim($value));
		return $value;
	}
	
	
	@header('Content-type: text/html; charset=utf-8');
	$link = mysql_connect('localhost','root') or die('Cannot connect to the DB');// Database connection
	mysql_select_db('proaccounting',$link) or die('Cannot select the DB');	
	mysql_query("SET NAMES 'utf8'"); 
	//$cname=mysqli_fetch_assoc(mysqli_query($con,"select name from company where id=$id"));
	//$cname=$cname['name'];
// Name of the file
$filename ="data/compbackup/".$_FILES['restorefile']['name'];
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'proaccounting';

// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";
 ?>
 	<script>
		location.href="index.php";
	</script>
 <?php
	}
?>
<form method="post" enctype="multipart/form-data">
	<table border="1px" width="100%" cellspacing="0">
    	<tr>
        	<td colspan="2">Restore Company Data</td>
        </tr>
        <tr>
        	<td>Select File:</td>
            <td><input type="file" name="restorefile"></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" value="Submit"></td>
        </tr>
    </table>
</form>
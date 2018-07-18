<?php
//backup_tables('localhost','root','','a');

// backup the db OR just a table 
/*function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	$tables = 'cash,client,edition,invoice,payment,releaseorder';
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			if($row[0]=='company') continue;
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//echo '<pre>';
	//print_r($tables);
	global $return;
	
	//print_r($tables);exit;
	//cycle through
	foreach($tables as $table)
	{	
		$result = mysql_query('SELECT * FROM '.$table.' WHERE coid = 1');
		$num_fields = mysql_num_fields($result);
		
		//$return.= 'DROP TABLE IF EXISTS '.$table.';';
		//$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		//$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					//$row[$j] = @preg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
			
		
		}
		$return.="\n\n\n";
	}
	
	//echo $return;exit;	
	
	//save file
	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}
*/


	function check_input($value)
	{
			echo $value;exit;
	  		$value = mysql_real_escape_string(trim($value));
		return $value;
	}
	
	
	@header('Content-type: text/html; charset=utf-8');
	$link = mysql_connect('localhost','root') or die('Cannot connect to the DB');// Database connection
	mysql_select_db('proaccounting',$link) or die('Cannot select the DB');	
	mysql_query("SET NAMES 'utf8'"); 

// Name of the file
$filename = 'db-backup-1477379265-1bcd0c29e0ca3915c4cff311477808b2.sql';
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
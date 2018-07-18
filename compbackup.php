<?php
backup_tables('localhost','root','','proaccounting');

function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	$tables = 'company';
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
		$id=$_GET['id'];
		$result = mysql_query('SELECT * FROM '.$table);
		//echo 'SELECT * FROM '.$table.' WHERE coid = '.$id;exit;
		@$num_fields = mysql_num_fields($result);
		
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
	include "config.php";
	include "function.php";
	//save file
	$cname=mysqli_fetch_assoc(mysqli_query($con,"select name from company where id=$_GET[id]"));
	$cname=$cname['name'];
	$handle = fopen("data/compbackup/db-backup-".time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);

?>
<script>
	location.href="index.php";
</script>
<?php
}?>
<?php

class DBExport
{
	function __construct()
	{
		mysql_connect("localhost","root","");
		mysql_select_db("bharatcode");		
	}

	function Export($structureonly=1)
	{
		$this->table_array = array();
		$table_query = mysql_query("SHOW TABLES");
		if(mysql_num_rows($table_query)>0)
		{
			while($data=mysql_fetch_array($table_query))
			{
				$query2 = mysql_query("SHOW CREATE TABLE ".$data[0]);
				$this->table_array[] = mysql_fetch_assoc($query2);
			}

			$file_content = "";
			foreach ($this->table_array as $key => $value) {
				$file_content.=$value['Create Table'].";\n\n";
				if($structureonly!=1){
					$tabledata = array();
					$query3 = mysql_query("select * from ".$value['Table']);
					while($data3 = mysql_fetch_assoc($query3)){
						//$file_content.=$this->InsertRecordQuery($value['Table'],$data3);
						$tabledata[] = $data3;
					}
					if(!empty($tabledata)) {
						$file_content.=$this->InsertRecordQuery($value['Table'],$tabledata);
					}
				}
			}

			if($file_content!="")
			{
				$myfile = fopen("dbexport.sql", "w") or die("Unable to open file!");
				fwrite($myfile, $file_content);
				fclose($myfile);
			}
		}

		if(file_exists("dbexport.sql") && !empty($file_content)) {
			header("location:download.php");
			exit;
		}

	}

	function InsertRecordQuery($tablename,$array)
	{
		$query_string = "insert into ".$tablename." (";
		foreach ($array[0] as $key => $value) 
		{
			$query_string.="`".$key."` ,";
		}
				
		$query_string = trim($query_string," ,");

		$query_string.=" ) values ";
		foreach ($array as $key => $value) 
		{
			$query_string.=" ( ";
			foreach ($value as $k => $v) 
			{
				$query_string.="'".mysql_real_escape_string($v)."' ,";	
			}

			$query_string=trim($query_string," ,")." ) ,";
			
		}
		return trim($query_string," ,").";\n\n";
	}

}
?>
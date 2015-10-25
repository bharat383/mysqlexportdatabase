# Export MySQL Database and Download
You can Export the MySQL Database and Download the SQL File. Very short code to use the script.

# Developed By : 
Bharat Parmar

# Version : 
1.0

# File Structure :
1) example.php  : Example Script file to export the Database
2) download.php : Download Database File Script
3) DBExport.class.php : Class file which includes all the methods to Export the MySQL Database and Download the File. Require to set the database details here.

# Requirements : 
1) PHP Version : 3.0 and above


# Script Details :

1) Export(0) :
Parameter :
0 => Data with Structure All Tables.
1 => Structure only All Tables. 

Use : 
<?php
$obj = new DBExport();
//parameter value : 1 for stucture only. 0 for data with structure.
$obj->Export(0);
?>

You must need to set the Database Details in the DBExport.class.php file.

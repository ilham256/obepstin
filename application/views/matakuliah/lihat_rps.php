<?php
// CONECT DATABASE
 
$id = $_REQUEST['id'];
$query = "SELECT * FROM `rps` WHERE `id_rps`='".$id."' LIMIT 1";
$qu = mysql_query($query);
$num = mysql_numrows($qu);
if($num > 0) {
	$result=mysql_fetch_object($qu);
	header("Content-Disposition: attachment; filename=".jin_gfile($result->file_name.""));
	header("Content-length: ".$result->file_size."");
	header("Content-type: ".$result->file_type."");
	echo $result->file_content;
} else {
	echo "File tidak valid!";
}
?>
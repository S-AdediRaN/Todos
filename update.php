<?php 

include "config.php";

$field = $_POST['field'];
$value = $_POST['value'];
$editid = $_POST['id'];

$qry = mysqli_query($mysqli,"UPDATE todolist SET ".$field."='".$value."' WHERE id=".$editid;);



?>


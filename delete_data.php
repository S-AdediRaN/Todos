<?php
require_once "config.php";
$id = $_POST["delete_id"];
$qry = mysqli_query($mysqli,"DELETE FROM todolist WHERE id = '".$id."'");
?>
		
		
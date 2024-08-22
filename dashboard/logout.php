<?php 
    session_start();
    session_destroy();
	$msg = '<span class="alert alert-success">Successfully Logout!!</span>';
	header('Location:../index.php?msg='.$msg);
	

?>
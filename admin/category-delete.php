<?php require_once('header.php'); ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['cat_id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_categories WHERE cat_id=?");
	$statement->execute(array($_REQUEST['cat_id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php

	// Delete from tbl_category
	$statement = $pdo->prepare("DELETE FROM tbl_categories WHERE cat_id=?");
	$statement->execute(array($_REQUEST['cat_id']));

	header('location: categories.php');
?>
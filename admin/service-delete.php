<?php require_once('header.php'); ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['srvs_id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_services WHERE srvs_id=?");
	$statement->execute(array($_REQUEST['srvs_id']));
	$total = $statement->rowCount();
	$result = $statement->fetch();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	
	$photo = $result['srvc_photo'];
	// Unlink the photo
	if($photo!='') {
		unlink('assets/services/'.$photo);	
	}

	// Delete from tbl_category
	$statement = $pdo->prepare("DELETE FROM tbl_services WHERE srvs_id=?");
	$statement->execute(array($_REQUEST['srvs_id']));

	header('location: services.php');
?>
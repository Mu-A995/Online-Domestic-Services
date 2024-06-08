<?php include 'header.php'; ?>

<?php

if(!isset($_REQUEST['srvs_id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not

	$statement = $pdo->prepare("SELECT * FROM tbl_services WHERE srvs_id=?");
    $statement->execute(array($_REQUEST['srvs_id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}

if (isset($_REQUEST['srvs_id'])) {
    $srvs_id = $_REQUEST['srvs_id'];

    $srvc_statement = $pdo->prepare('SELECT * FROM tbl_services WHERE srvs_id =?');
    $srvc_statement->execute(array($srvs_id));
    $srvc_statement_result = $srvc_statement->fetch();
}


// Category Update Start

$alert_msg = '';

if (isset($_POST['form_service_update'])) {

    $valid = 1;

    $srvs_id = $_REQUEST['srvs_id'];

    $inputServiceTitle = $_POST['inputServiceTitle'];
    $inputServiceOverview = $_POST['inputServiceOverview'];
    $inputServicePackage = $_POST['inputServicePackage'];
    $inputServicePrice = $_POST['inputServicePrice'];
    $inputServiceStatus = $_POST['inputServiceStatus'];
    $inputServiceCategory = $_POST['inputServiceCategory'];

    $statements = $pdo->prepare('SELECT * FROM tbl_services WHERE srvs_id =?');
    $statements->execute(array($srvs_id));
    $counts = $statements->rowCount();
    $results = $statements->fetch();

    if (empty($inputServiceTitle)) {
         $alert_msg = "Service title is missing";
    } elseif (empty($inputServiceOverview)) {
        $alert_msg = "Service Overview is missing";
    } elseif (empty($inputServicePackage)) {
        $alert_msg = "Service Package detail is missing";
    } elseif (empty($inputServicePrice)) {
        $alert_msg = "Service price is missing";
    } elseif (empty($inputServiceStatus)) {
        $alert_msg = "Service status is missing";
    }  else {
       
        if ($counts > 0) {

            // current Post title that is in the database

            $statement = $pdo->prepare("SELECT * FROM tbl_services WHERE srvc_title=? and srvc_title!=?");
            $statement->execute(array($inputServiceTitle,$results['srvc_title']));
            $total = $statement->rowCount();                            
            
            if($total) {
                $valid = 0;
                $alert_msg .= 'Service title already exists<br>';
            }

            // photo
                $path = $_FILES['photo']['name'];
                $path_tmp = $_FILES['photo']['tmp_name'];

                $previous_photo = $_POST['previous_photo'];

                if($path!='') {
                    $ext = pathinfo( $path, PATHINFO_EXTENSION );
                    $file_name = basename( $path, '.' . $ext );
                    if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                        $valid = 0;
                        $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
                    }
                }
            // photo

            if($valid == 1) {

            // photo
            // If previous image not found and user do not want to change the photo
            if($previous_photo == '' && $path == '') {
                $statement = $pdo->prepare("UPDATE tbl_services SET srvc_title=?, srvc_overview=?, srvc_package=?, srvc_price=?, srvc_status=?, svrc_category=? WHERE srvs_id=?");
                $statement->execute(array($inputServiceTitle,$inputServiceOverview,$inputServicePackage,$inputServicePrice,$inputServiceStatus,$inputServiceCategory,$srvs_id));
            }

            // If previous image found and user do not want to change the photo
            if($previous_photo != '' && $path == '') {
                $statement = $pdo->prepare("UPDATE tbl_services SET srvc_title=?, srvc_overview=?, srvc_package=?, srvc_price=?, srvc_status=?, svrc_category=? WHERE srvs_id=?");
                $statement->execute(array($inputServiceTitle,$inputServiceOverview,$inputServicePackage,$inputServicePrice,$inputServiceStatus,$inputServiceCategory,$srvs_id));
            }


            // If previous image not found and user want to change the photo
            if($previous_photo == '' && $path != '') {

                $final_name = 'services-'.$_REQUEST['srvs_id'].'.'.$ext;
                move_uploaded_file( $path_tmp, '../admin/assets/services/'.$final_name );

                $statement = $pdo->prepare("UPDATE tbl_services SET srvc_title=?, srvc_overview=?, srvc_package=?, srvc_price=?, srvc_photo=?, srvc_status=?, svrc_category=? WHERE srvs_id=?");
                $statement->execute(array($inputServiceTitle,$inputServiceOverview,$inputServicePackage,$inputServicePrice,$final_name,$inputServiceStatus,$inputServiceCategory,$srvs_id));
            }

            
            // If previous image found and user want to change the photo
            if($previous_photo != '' && $path != '') {

                unlink('../admin/assets/services/'.$previous_photo);

                $final_name = 'services-'.$_REQUEST['srvs_id'].'.'.$ext;
                move_uploaded_file( $path_tmp, '../admin/assets/services/'.$final_name );

                $statement = $pdo->prepare("UPDATE tbl_services SET srvc_title=?, srvc_overview=?, srvc_package=?, srvc_price=?, srvc_photo=?, srvc_status=?, svrc_category=? WHERE srvs_id=?");
                $statement->execute(array($inputServiceTitle,$inputServiceOverview,$inputServicePackage,$inputServicePrice,$final_name,$inputServiceStatus,$inputServiceCategory,$srvs_id));
            }

            $alert_msg = 'Post is updated successfully!';

            // photo

            // $statement = $pdo->prepare("UPDATE tbl_services SET srvc_title=?, srvc_overview=?, srvc_package=?, srvc_price=?, srvc_status=? WHERE srvs_id=?");
            // $statement->execute(array($inputServiceTitle,$inputServiceOverview,$inputServicePackage,$inputServicePrice,$inputServiceStatus,$srvs_id));

            // // $alert_msg = "Updated.";
                
            header('location: services.php');
             }
        } else {
                
            $alert_msg = "Error: Service is not exist.";
        }  
    }
   
}

// Category Update End
?>


<div class="container-fluid">
    <!-- <h1 class="mt-4">My Profile</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item">Services</li>
    </ol>

    <div class="row ">
        <div class="col-lg-7 mb-4">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">Edit Service</h5>
                </div>
                <div class="card-body">
                
                    <?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>
                
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">

                            <input  name="srvs_id" value="<?php echo $srvc_statement_result['srvs_id']; ?>" type="hidden" />

                            <label class="small mb-1" for="inputServiceTitle">Service Title</label>
                            <input class="form-control py-4" id="inputServiceTitle" name="inputServiceTitle" value="<?php echo $srvc_statement_result['srvc_title']; ?>" type="text" placeholder="Enter Service Name" />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputServiceOverview">Service Overview</label>
                            <input class="form-control py-4" id="inputServiceOverview" value="<?php echo $srvc_statement_result['srvc_overview']; ?>" name="inputServiceOverview" type="text" placeholder="Enter Service Overview" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="inputServicePackage">Service Package (Offers)</label>
                            <input class="form-control py-4" id="inputServicePackage" name="inputServicePackage" value="<?php echo $srvc_statement_result['srvc_package']; ?>" type="text" placeholder="Package Details" />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputServicePrice">Service Price</label>
                            <input class="form-control py-4" id="inputServicePrice" value="<?php echo $srvc_statement_result['srvc_price']; ?>" name="inputServicePrice" type="number" placeholder="Enter Price" />
                        </div>
                        
                        <div class="form-group">
                          <label class="small mb-1" for="inputServiceCategory">Select Category</label>
                          <select class="form-control" name="inputServiceCategory" id="inputServiceCategory">
                            <option value="">Select Top Level Category</option>
                                <?php
                                    $statement = $pdo->prepare("SELECT * FROM tbl_categories");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);   
                                    foreach ($result as $row) {
                                        ?>
                                        <option value="<?php echo $row['cat_id']; ?>" <?php if($row['cat_id'] == $srvc_statement_result['svrc_category']){echo 'selected';} ?>><?php echo $row['cat_name']; ?></option>
                                        <?php
                                    }
                                ?>
                          </select>
                        </div>
                        
                        <div class="form-group">
                            <div  style="padding-top:6px;">
                                <?php
                                if($srvc_statement_result['srvc_photo'] == '') {
                                    echo 'No photo found';
                                } else {
                                    echo '<img src="../admin/assets/services/'.$srvc_statement_result['srvc_photo'].'" class="existing-photo" style="width:200px;">';    
                                }
                                ?>
                                <input type="hidden" name="previous_photo" value="<?php echo $srvc_statement_result['srvc_photo']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <label for=""  control-label">New Photo</label> -->
                            <div  style="padding-top:6px;">
                                <input type="file" name="photo">
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="radio-inline"><input value="active" <?php if($srvc_statement_result['srvc_status'] == 'active'){echo 'checked';}?> type="radio" name="inputServiceStatus"> Active</label>
                            <label class="radio-inline"><input value="inactive" <?php if($srvc_statement_result['srvc_status'] == 'inactive'){echo 'checked';}?> type="radio" name="inputServiceStatus" > Inactive</label>
                            
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between mt-1 mb-0">
                            <input type="submit" value="Submit" class="btn btn-primary" name="form_service_update">
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">Note</h5>
                </div>
                <div class="card-body">
                   
                    <p>Note will goes here...</p>
                </div>
                
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>
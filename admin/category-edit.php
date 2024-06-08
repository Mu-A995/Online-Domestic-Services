<?php include 'header.php'; ?>

<?php

if(!isset($_REQUEST['cat_id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not

	$statement = $pdo->prepare("SELECT * FROM tbl_categories WHERE cat_id=?");
    $statement->execute(array($_REQUEST['cat_id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}

if (isset($_REQUEST['cat_id'])) {
    $cat_id = $_REQUEST['cat_id'];

    $cat_statement = $pdo->prepare('SELECT * FROM tbl_categories WHERE cat_id =?');
    $cat_statement->execute(array($cat_id));
    $cat_statement_result = $cat_statement->fetch();
}

// Category Update Start

$alert_msg = '';

if (isset($_POST['form_category_update'])) {
    
    $valid = 1;

    $inputCatname = $_POST['inputCatname'];
    $inputCaticon = $_POST['inputCaticon'];
    $inputCatStatus = $_POST['inputCatStatus'];
    $cat_id = $_POST['cat_id'];


    $statements = $pdo->prepare('SELECT * FROM tbl_categories WHERE cat_id =?');
    $statements->execute(array($cat_id));
    $counts = $statements->rowCount();
    $results = $statements->fetch();

    if (empty($inputCatname)) {
         $alert_msg = "Category Name is missing";
    } elseif (empty($inputCaticon)) {
        $alert_msg = "Category Icon is missing";
    } elseif (empty($inputCatStatus)) {
        $alert_msg = "Category Status is missing";
    } else {
       
        $statement = $pdo->prepare("SELECT * FROM tbl_categories WHERE cat_name=? and cat_name!=?");
        $statement->execute(array($inputCatname,$results['cat_name']));
        $total = $statement->rowCount();                            
        if($total) {
            $valid = 0;
            $alert_msg .= 'Category name already exists';
        }

        if ($valid == 1) {
           $statement = $pdo->prepare("UPDATE tbl_categories SET cat_name=?, cat_icon=?, cat_status=?WHERE cat_id=?");
            $statement->execute(array($inputCatname,$inputCaticon,$inputCatStatus,$cat_id));

            // $alert_msg = "Updated.";
                
            header('location: categories.php');
        } 
    }
   
}

// Category Update End
?>


<div class="container-fluid">
    <!-- <h1 class="mt-4">My Profile</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item">Categories</li>
    </ol>

    <div class="row ">
        <div class="col-lg-7 mb-4">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">Edit Category</h5>
                </div>
                <div class="card-body">
                
                    <?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>
                
                    <form method="post" action="">
                        <div class="form-group">

                            <input  name="cat_id" value="<?php echo $cat_statement_result['cat_id']; ?>" type="hidden" />
                            
                            <label class="small mb-1" for="inputCatname">Category Name</label>
                            <input class="form-control py-4" value="<?php echo $cat_statement_result['cat_name']; ?>" id="inputCatname" name="inputCatname"  type="text" placeholder="Enter Category Name" />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputCaticon">Category Icon</label>
                            <input class="form-control py-4" value="<?php echo $cat_statement_result['cat_icon']; ?>" id="inputCaticon"  name="inputCaticon" type="text" placeholder="Enter Category Icon i.e: fa fa-user" />
                        </div>
                           
                        <div class="form-group">

                            <label class="radio-inline"><input value="active" type="radio" name="inputCatStatus" <?php if($cat_statement_result['cat_status'] == 'active'){echo 'checked';}?>> Active</label>
                            <label class="radio-inline"><input value="inactive" type="radio" name="inputCatStatus" <?php if($cat_statement_result['cat_status'] == 'inactive'){echo 'checked';}?>> Inactive</label>
                            
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between mt-1 mb-0">
                            <input type="submit" value="Update" class="btn btn-primary" name="form_category_update">
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
                   
                    <p>Icons is available <a target="_blank" href="https://fontawesome.com/v4/icons/">here...</a></p>
                </div>
                
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>
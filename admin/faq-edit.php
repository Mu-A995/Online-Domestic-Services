<?php include 'header.php'; ?>

<?php

if(!isset($_REQUEST['faq_id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not

	$statement = $pdo->prepare("SELECT * FROM tbl_faqs WHERE faq_id=?");
    $statement->execute(array($_REQUEST['faq_id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}

if (isset($_REQUEST['faq_id'])) {
    $faq_id = $_REQUEST['faq_id'];

    $faq_statement = $pdo->prepare('SELECT * FROM tbl_faqs WHERE faq_id =?');
    $faq_statement->execute(array($faq_id));
    $faq_statement_result = $faq_statement->fetch();
}

// Category Update Start

$alert_msg = '';

if (isset($_POST['form_faq_update'])) {
    
    $valid = 1;

    $inputFAQQ = $_POST['inputFAQQ'];
    $inputFAQA = $_POST['inputFAQA'];
    $inputFAQStatus = $_POST['inputFAQStatus'];
    $faq_id = $_POST['faq_id'];


    $statements = $pdo->prepare('SELECT * FROM tbl_faqs WHERE faq_id =?');
    $statements->execute(array($faq_id));
    $counts = $statements->rowCount();
    $results = $statements->fetch();

    if (empty($inputFAQQ)) {
         $alert_msg = "Question is missing";
    } elseif (empty($inputFAQA)) {
        $alert_msg = "Answer is missing";
    } elseif (empty($inputFAQStatus)) {
        $alert_msg = "FAQ Status is missing";
    } else {
       
        $statement = $pdo->prepare("SELECT * FROM tbl_faqs WHERE faq_question=? and faq_question!=?");
        $statement->execute(array($inputFAQQ,$results['faq_question']));
        $total = $statement->rowCount();                            
        if($total) {
            $valid = 0;
            $alert_msg .= 'Question is already exists';
        }

        if ($valid == 1) {
           $statement = $pdo->prepare("UPDATE tbl_faqs SET faq_question=?, faq_answer=?, faq_status=? WHERE faq_id=?");
            $statement->execute(array($inputFAQQ,$inputFAQA,$inputFAQStatus,$faq_id));

            // $alert_msg = "Updated.";
                
            header('location: faqs.php');
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

                            <input  name="faq_id" value="<?php echo $faq_statement_result['faq_id']; ?>" type="hidden" />
                            
                            <label class="small mb-1" for="inputFAQQ">Question</label>
                            <input class="form-control py-4" value="<?php echo $faq_statement_result['faq_question']; ?>" id="inputFAQQ" name="inputFAQQ"  type="text" placeholder="Enter Question" />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputFAQA">Answer</label>
                            <input class="form-control py-4" value="<?php echo $faq_statement_result['faq_answer']; ?>" id="inputFAQA"  name="inputFAQA" type="text" placeholder="Enter Answer" />
                        </div>
                           
                        <div class="form-group">

                            <label class="radio-inline"><input value="active" type="radio" name="inputFAQStatus" <?php if($faq_statement_result['faq_status'] == 'active'){echo 'checked';}?>> Active</label>
                            <label class="radio-inline"><input value="inactive" type="radio" name="inputFAQStatus" <?php if($faq_statement_result['faq_status'] == 'inactive'){echo 'checked';}?>> Inactive</label>
                            
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between mt-1 mb-0">
                            <input type="submit" value="Update" class="btn btn-primary" name="form_faq_update">
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
                   
                    <p>Instructions will goes here...</p>
                </div>
                
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>
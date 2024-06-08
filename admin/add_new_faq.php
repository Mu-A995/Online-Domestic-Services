<?php include 'header.php'; ?>

<?php

// Insert New FAQ Start

$alert_msg = '';

if (isset($_POST['form_faq_insert'])) {

    // $u_id = $_POST['u_id'];

    $inputFAQQ = $_POST['inputFAQQ'];
    $inputFAQA = $_POST['inputFAQA'];
    $inputFAQStatus = $_POST['inputFAQStatus'];
    $created_at = date("d/m/Y");

    $statements = $pdo->prepare('SELECT * FROM tbl_faqs WHERE faq_question =?');
    $statements->execute(array($inputFAQQ));
    $counts = $statements->rowCount();
    // $results = $statements->fetch();

    if (empty($inputFAQQ)) {
         $alert_msg = "Question Field is missing";
    } elseif (empty($inputFAQA)) {
        $alert_msg = "Answer Field is missing";
    } elseif (empty($inputFAQStatus)) {
        $alert_msg = "Status Field is missing";
    } else {

        if ($counts > 0) {
            $alert_msg = "Question is already exist.";
        } else {
            
            $statement = $pdo->prepare("INSERT INTO tbl_faqs (faq_question,faq_answer,faq_status,created_at) VALUES (?,?,?,?)");
            $statement->execute(array($inputFAQQ,$inputFAQA,$inputFAQStatus,$created_at));

            $alert_msg = "FAQ Inserted.";
                
            header('location: faqs.php');

        }
       
        
              
    }
   
}

// Insert New FAQ End

?>


<div class="container-fluid">
    
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item">FAQs</li>
    </ol>

    <div class="row ">
        <div class="col-lg-7 mb-4">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">Add New FAQ</h5>
                </div>
                <div class="card-body">
                
                    <?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>
                
                    <form method="post" action="">
                        <div class="form-group">

                            
                            <label class="small mb-1" for="inputFAQQ">Question</label>
                            <input class="form-control py-4" id="inputFAQQ" name="inputFAQQ"  type="text" placeholder="Enter Question" />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputFAQA">Answer</label>
                            <input class="form-control py-4" id="inputFAQA"  name="inputFAQA" type="text" placeholder="Enter Answer" />
                        </div>
                           
                        <div class="form-group">

                            <label class="radio-inline"><input value="active" checked type="radio" name="inputFAQStatus"> Active</label>
                            <label class="radio-inline"><input value="inactive" type="radio" name="inputFAQStatus" > Inactive</label>
                            
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between mt-1 mb-0">
                            <input type="submit" value="Submit" class="btn btn-primary" name="form_faq_insert">
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
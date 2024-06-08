<?php include 'header.php'; ?>

<?php

// Insert New Category Start

$alert_msg = '';

if (isset($_POST['form_category_insert'])) {

    // $u_id = $_POST['u_id'];

    $inputCatname = $_POST['inputCatname'];
    $inputCaticon = $_POST['inputCaticon'];
    $inputCatStatus = $_POST['inputCatStatus'];
    $created_at = date("d/m/Y");

    $statements = $pdo->prepare('SELECT * FROM tbl_categories WHERE cat_name =?');
    $statements->execute(array($inputCatname));
    $counts = $statements->rowCount();
    // $results = $statements->fetch();

    if (empty($inputCatname)) {
         $alert_msg = "Category Name is missing";
    } elseif (empty($inputCaticon)) {
        $alert_msg = "Category Icon is missing";
    } elseif (empty($inputCatStatus)) {
        $alert_msg = "Category status is missing";
    } else {

        if ($counts > 0) {
            $alert_msg = "Category Name is already exist";
        } else {
            
            $statement = $pdo->prepare("INSERT INTO tbl_categories (cat_name,cat_icon,cat_status,created_at) VALUES (?,?,?,?)");
            $statement->execute(array($inputCatname,$inputCaticon,$inputCatStatus,$created_at));

            $alert_msg = "Inserted.";
                
            // header('location: users.php');

        }
       
        // $statements = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? AND email != ?');
        // $statements->execute(array($up_email,$results['email']));
        // $countss = $statements->rowCount();
        
        // if ($countss > 0) {
        //    $alert_msg = "this email already used.";
        // } else {
        //     $statement = $pdo->prepare("UPDATE tbl_users SET fullname=?, email=?, mobile_no=?, gender=?, status=? WHERE id=?");
        //     $statement->execute(array($up_fullname,$up_email,$up_mobile_no,$up_gender,$up_status,$u_id));

        //     $alert_msg = "Updated.";
                
        //     header('location: users.php');
        // }
              
    }
   
}

// Insert New Category End

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
                    <h5 class="font-weight-light">Add New Category</h5>
                </div>
                <div class="card-body">
                
                    <?php
                        if (!empty($alert_msg)) {
                            echo '<div class="alert alert-danger">'.$alert_msg.'</div>'; 
                        }
                    ?>
                
                    <form method="post" action="">
                        <div class="form-group">

                            
                            <label class="small mb-1" for="inputCatname">Category Name</label>
                            <input class="form-control py-4" id="inputCatname" name="inputCatname"  type="text" placeholder="Enter Category Name" />
                        </div>
                        
                        <div class="form-group">
                            <label class="small mb-1" for="inputCaticon">Category Icon</label>
                            <input class="form-control py-4" id="inputCaticon"  name="inputCaticon" type="text" placeholder="Enter Category Icon i.e: fa fa-user" />
                        </div>
                           
                        <div class="form-group">

                            <label class="radio-inline"><input value="active" checked type="radio" name="inputCatStatus"> Active</label>
                            <label class="radio-inline"><input value="inactive" type="radio" name="inputCatStatus" > Inactive</label>
                            
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between mt-1 mb-0">
                            <input type="submit" value="Submit" class="btn btn-primary" name="form_category_insert">
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
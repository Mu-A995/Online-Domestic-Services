<?php include 'header.php';?>

<?php

    if (isset($_POST['form_pay'])) {

        $item_name = $_POST['item_name'];
        $item_number = $_POST['item_number'];
        $item_price = $_POST['amount'];
        $ordered_By =  $_POST['custom'];

        $inputAddress =  $_POST['inputAddress'];
        $inputTime =  $_POST['inputTime'];
        $inputDate =  $_POST['inputDate'];
        $inputperson =  $_POST['inputperson'];
        $inputPaymentMethod =  $_POST['inputPaymentMethod'];
        // $user_id = $_SESSION['user']['id'];

        $created_at = date("d/m/Y");

        //image uploading
        $path = $_FILES['inputFile']['name'];
        $path_tmp = $_FILES['inputFile']['tmp_name'];

        if($path!='') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg') {
                
                $alert_msg = 'You have not permission to upload file with <b>.'.$ext.'</b> extention';
                
            }
        } 

        $random = md5(rand());
        $random_name = substr($random, 0, 6);

        $inputFile = 'booking_'.$random_name.'.'.$ext;
        move_uploaded_file( $path_tmp, 'assets/images/bookings/'.$inputFile);
        //image uploading
        
        $statement = $pdo->prepare('INSERT INTO tbl_payment(item_number,item_name,payment_status,payment_amount,inputTime,inputperson,inputDate,inputPaymentMethod,payment_attachment,user_id,address,created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
                $statement->execute(array($item_number,$item_name,'pending',$item_price,$inputTime,$inputperson,$inputDate,$inputPaymentMethod,$inputFile,$ordered_By,$inputAddress,$created_at));

        $alert_msg = "Order successfully placed !!";

    }

?>

<?php

if(!isset($_REQUEST['single_service'])) {
    header('location: index.php');
    exit;
} else {
    // Check the id is valid or not

    $srvc_statement = $pdo->prepare("SELECT * FROM tbl_services WHERE srvs_id=?");
    $srvc_statement->execute(array($_REQUEST['single_service']));
    $srvc_statement_total = $srvc_statement->rowCount();
    $srvc_statement_result = $srvc_statement->fetch(PDO::FETCH_ASSOC);
    if( $srvc_statement_total == 0 ) {
        header('location: index.php');
        exit;
    }
}

// if (isset($_REQUEST['single_service'])) {
//     $category_id = $_REQUEST['single_service'];

//     // Get Category Name
//     $cat_statement = $pdo->prepare('SELECT * FROM tbl_services WHERE srvs_id=?');
//     $cat_statement->execute(array($category_id));
//     // $count = $statement->rowCount();
//     $cat_statement_result = $cat_statement->fetch();

    
// }

?>
<?php

if (isset($_POST['login_form'])) {
    
    // filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $username = $_POST['username'];
    $password = $_POST['password'];

    // recaptcha
    if ($setting_statement_results['g_recaptcha_status'] == "active") {

        $response = $_POST['g-recaptcha-response'];
         
        $secret = $setting_statement_results['g_recaptcha_secret_key'];

        $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
        $captcha_success=json_decode($verify);


        if ($captcha_success->success==false) {
         $alert_msg = "Google recaptcha is not verified.";
        }
        else if ($captcha_success->success==true) {
            $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? && password=?');
            $statement->execute(array($username,md5($password)));
            $count = $statement->rowCount();
            $result = $statement->fetch();

            if ($count > 0) {

                if ($result['status'] !== 'active') {
                    $alert_msg = "Your account is ".$result['status'];
                } elseif ($result['role'] !== 'user') {
                    $alert_msg = "Your are not permitted to login as Admin.";
                } else {
                    $_SESSION['user'] = $result;
                    header('location: index.php');
                }
                
                
            } else {
                $alert_msg = "Login detail is not correct";
            }
        }
    } else {
        // echo "not active";
        $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? && password=?');
        $statement->execute(array($username,md5($password)));
        $count = $statement->rowCount();
        $result = $statement->fetch();

        if ($count > 0) {
            
            if ($result['status'] !== 'active') {
                $alert_msg = "Your account is ".$result['status'];
            } elseif ($result['role'] !== 'user') {
                $alert_msg = "Your are not permitted to login as User.";
            } else {

                $_SESSION['user'] = $result;
                $url.= $_SERVER['REQUEST_URI'];           
                Header("Location: ".$url);
                
            }
        } else {
            $alert_msg = "Login detail is not correct";
        }
    }
    // recaptcha

    
}

?>
<!-- start page-title -->
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <h2> <?php echo $srvc_statement_result['srvc_title'];?> </h2>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>        
<!-- end page-title -->

<?php
    if (!empty($alert_msg)) {
        echo '<div class="alert alert-danger text-center">'.$alert_msg.'</div>'; 
    }
?>

<!-- start service-single-section -->
<section class="service-single-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col col-md-9 col-md-push-3">
                <div class="service-single-content">
                    <div class="service-single-img">
                        <img src="admin/assets/services/<?php echo $srvc_statement_result['srvc_photo'];?>" alt>
                    </div>
                    
                    
                    <div class="service-single-tab">
                        <ul class="nav">
                            <li class="active">
                                <a href="#overview" data-toggle="tab">Overview</a>
                            </li>
                            <li>
                                <a href="#package" data-toggle="tab">What you will get</a>
                            </li>
                            <li>
                                <a href="#price" data-toggle="tab">Service Charges (Price)</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="overview">
                                <p><?php echo $srvc_statement_result['srvc_overview'];?></p>
                            </div>
                            <div class="tab-pane fade" id="package">
                                <p><?php echo $srvc_statement_result['srvc_package'];?></p>
                            </div>
                            <div class="tab-pane fade" id="price">
                                <div class="pricing-header">

                                    <?php
                                    $basicprice = $srvc_statement_result['srvc_price'];
                                    $dollar_rate = $setting_statement_results['dollar_exchange_rate'];

                                    $final_price_in_usd = round(($basicprice / $dollar_rate), 2);
                                    ?>
                                    <h5>Basic price</h5>
                                    <h3><?php echo $srvc_statement_result['srvc_price'];?> <?php echo $setting_statement_results['web_currency']; ?> <span>/Per Service</span> - <small>(<?php echo $final_price_in_usd;?> USD)</small></h3>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['user'])) { ?>
                        
                        <a href="#" data-toggle="modal" data-target="#modalPayAmount" class="theme-btn">Get the service</a> 
                         

                    <?php } else { ?>
                        <a href="#" data-toggle="modal" data-target="#modalBookService" class="theme-btn">Get the service</a> 
                    <?php } ?>
                                               
                </div>
            </div>
            <div class="col col-md-3 col-md-pull-9">
                <div class="service-sidebar">
                    <div class="widget service-list-widget">
                        <!-- <div class="widget category-widget"> -->
                        <!-- <h4>All Categories</h4> -->
                        <ul>
                            <?php

                            $statement = $pdo->prepare('SELECT * FROM tbl_categories WHERE cat_status=?');
                            $statement->execute(array('active'));
                            $count = $statement->rowCount();
                            $result = $statement->fetchAll();

                            foreach ($result  as $key) { ?>

                            <li>
                                <a href="service-list.php?category=<?php echo $key['cat_id'];?>">
                                    <i class="<?php echo $key['cat_icon'];?>"></i> <?php echo $key['cat_name'];?> <span>(<?php
                                            $statement = $pdo->prepare('SELECT * FROM tbl_services WHERE svrc_category=?');
                                            $statement->execute(array($key['cat_id']));
                                            echo $statement->rowCount();
                                        ?>)</span>
                                </a>
                            </li>

                            <?php }

                            ?>
                        </ul>
                    <!-- </div> -->
                    </div>
                    <div class="widget contact-widget">
                        <div>
                            <h5>We are clearing <span>Experts</span></h5>
                            <a href="contact.php">Contact with us</a>
                        </div>
                    </div>
                    <div class="widget download-widget">
                        <ul>
                            <li><a href="meet-team.php"><i class="ti-zip"></i>Meet Our Team</a></li>
                        </ul>
                    </div>
                </div>                    
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end service-single-section -->

<?php if (!isset($_SESSION['user'])) { ?>
                        
<div id="modalBookService" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Book Service</h3>
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
      </div>
      <form method="post" action="">
          <div class="modal-body">
            <p class="text text-danger">Login First to continue..</p>
            
                <div class="content-area">
                    <div class="contact-form">
                           
                        <div class="card-body">
                            
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                    <input class="form-control input-lg py-4" id="inputEmailAddress" type="text" name="username" placeholder="Enter email address" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input class="form-control input-lg py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                </div>
                                <?php if ($setting_statement_results['g_recaptcha_status'] == "active") { ?>
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="<?php echo $setting_statement_results['g_recaptcha_site_key'];?>"></div>
                                    </div>
                                <?php }
                                ?>
                                
                        </div>
                                    
                        
                    </div>                            
                </div>
            
          </div>
        
          <div class="modal-footer">
            <!-- <input class="btn btn-primary" type="submit" name="form_password_update" value="Update Password"> -->
            <!-- <a href="#" class="theme-btn">Login</a> -->
            <input type="submit" class="theme-btn" name="login_form" value="Login">
            <!-- <a href="#" class="theme-btn">0Get the service</a> -->
            <button type="button" class="theme-btn" data-dismiss="modal">Close</button>
          </div>
    </form>
    </div>

  </div>
</div>

<?php } else { ?>
                               
<div id="modalPayAmount" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Pay Amount</h3>
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
      </div>
      <form method="post" action="" id="frmPayNow" name="frmPayNow" enctype="multipart/form-data">
     
          <div class="modal-body">
            <p class="text text-danger"> Service: <?php echo $srvc_statement_result['srvc_title'];?></p>
            
                <div class="content-area">
                    <div class="contact-form">
                           
                        <div class="card-body">
                            
                            <input type="hidden" name="item_name" value="<?php echo $srvc_statement_result['srvc_title'];?>">
                            <input type="hidden" name="item_number" value="<?php echo $srvc_statement_result['srvs_id'];?>">
                            <input type="hidden" name="amount" value="<?php echo $final_price_in_usd;?>">
                            <input type="hidden" name="custom" value="<?php echo $_SESSION['user']['id']; ?>">
                            
                            <div class="form-group">
                                <div class="pricing-header">
                                    
                                    <h3>
                                        <small>Basic price: </small><?php echo $srvc_statement_result['srvc_price'];?> <?php echo $setting_statement_results['web_currency']; ?> - 
                                        
                                        <small>(<?php echo $final_price_in_usd;?> USD)</small>
                                    </h3>
                                    
                                    
                                </div>
                            </div
                            <div class="form-group">
                                <label class="small mb-1" for="inputAddress">Address</label>
                                <input class="form-control input-lg py-4" id="inputAddress" type="text" name="inputAddress" placeholder="Enter Address" />
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="inputTime">Time</label>
                                <input class="form-control input-lg py-4" id="inputTime" type="time" name="inputTime" placeholder="Enter Time" />
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="inputperson">Person</label>
                                <input class="form-control input-lg py-4" id="inputperson" type="text" name="inputperson" placeholder="Name" />
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="inputDate">Date</label>
                                <input class="form-control input-lg py-4" id="inputDate" type="date" name="inputDate" placeholder="Enter Date" />
                            </div>

                            <div class="form-group">
                                <label class="radio-inline">
                                    <input value="jazzcash" type="radio" name="inputPaymentMethod"> JazzCash</label>
                                <label class="radio-inline">
                                    <input value="easypaisa" type="radio" name="inputPaymentMethod" checked=""> EasyPaisa</label>
                                <label class="radio-inline">
                                    <input value="cash" type="radio" name="inputPaymentMethod" checked=""> Cash</label>
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="inputFile">File</label>
                                <input type="file" name="inputFile">
                                
                            </div>
                            
                                
                        </div>
                                    
                        
                    </div>                            
                </div>
            
          </div>
        
          <div class="modal-footer">
            <input class="theme-btn" type="submit" name="form_pay" value="Pay">
            <!-- <a href="#" class="theme-btn">Login</a> -->
            <!-- <button class="theme-btn" href="#">Paypal</button> -->
            <!-- <a href="#" class="theme-btn">0Get the service</a> -->
            <button type="button" class="theme-btn" data-dismiss="modal">Close</button>
          </div>
    </form>
    </div>

  </div>
</div>
<?php } ?>

<?php include 'footer.php'; ?>

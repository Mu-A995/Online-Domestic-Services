<?php

include 'autoloader.php';

if (isset($_SESSION['user'])) {
    // Trace user start
    $u_id = $_SESSION['user']['id'];
    $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE id=?');
    $statement->execute(array($u_id));
    // $count = $statement->rowCount();
    $user_result = $statement->fetch();

    if ($user_result['status'] != $_SESSION['user']['status']) {
        header('location: logout.php');
        exit();
    }
    // Trace user end
}


// Update Password Start
// $alert_msg = '';
// $alert_msg_upload = '';

// if (isset($_POST['form_password_update'])) {

//     $up_old_password = $_POST['inputOldPassword'];
//     $up_new_password = $_POST['inputPassword'];
//     $up_new_confirm_password = $_POST['inputConfirmPassword'];
    
//     $user_id = $_SESSION['user']['id'];

//     if (empty($up_old_password)) {
//          $alert_msg_pass = "Old Password is missing";
//     } elseif (empty($up_new_password)) {
//         $alert_msg_pass = "New Password is missing";
//     } elseif (empty($up_new_confirm_password)) {
//         $alert_msg_pass = "New Confirm Password is missing";
//     } elseif ($up_new_password != $up_new_confirm_password) {
//         $alert_msg_pass = "New Password & Confirm Password are not matched.";
//     } elseif (md5($up_old_password) != $user_result['password']) {
//         $alert_msg_pass = "Old password is not matched.";
//     } else {
        
        
//         $statement = $pdo->prepare("UPDATE tbl_users SET password=? WHERE id=?");
//         $statement->execute(array(md5($up_new_password),$user_id));

//         $alert_msg_pass = "Updated.";
            
//         header('location: logout.php');
//         exit();
        
//     }

// }

// Update Password Start

?>
<?php

if (isset($_POST['form_subscriber'])) {
    
    $inputEmailAddress = $_POST['inputEmailAddress'];

    $created_at = date("d/m/Y");

    if (empty($inputEmailAddress)) {
        echo "<script type='text/javascript'>alert('Email Address is missing.');</script>";
    } else {

        $statement = $pdo->prepare('SELECT * FROM tbl_subscribers WHERE email=?');
        $statement->execute(array($inputEmailAddress));
        $count = $statement->rowCount();
        $result = $statement->fetch();

        if ($count > 0) {

           echo "<script type='text/javascript'>alert('ALready Subscribed...');</script>";
        } else {

            $statement = $pdo->prepare('INSERT INTO tbl_subscribers(email,created_at) VALUES(?,?)');
            $statement->execute(array($inputEmailAddress,$created_at));
            echo "<script type='text/javascript'>alert('Successfully Subsribed.');</script>";
        }

        
    } 
    
}

?>
<?php include 'top_menu.php'; ?>


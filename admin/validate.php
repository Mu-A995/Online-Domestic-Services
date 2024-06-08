<?php

include 'autoloader.php';


if(!isset($_REQUEST['token_validation']))
{ 
    echo "Bypass is not allowed.";
} elseif ($_REQUEST['token_validation'] == ""){
    echo "need valid token value";
} else
{

    //FORGOT TOKEN
    $statement = $pdo->prepare("SELECT * FROM tbl_users WHERE forget_token=?");
    $statement->execute(array($_REQUEST['token_validation']));
    $total = $statement->rowCount();    
    $result = $statement->fetch(PDO::FETCH_ASSOC);   

    if($total < 1) {

        echo "Token is not found / correct";

    } else {

        $new_pass = rand();

        //MAIL

        $mail = new PHPMailer(); 
        $mail->IsSMTP();                              // send via SMTP
        $mail->Host = $smtp_statement_results['smtp_secure']."://".$smtp_statement_results['smtp_host'];
        $mail->SMTPAuth = true;                       // turn on SMTP authentication
        $mail->Username = $smtp_statement_results['smtp_username'];        // SMTP username
        $mail->Password = $smtp_statement_results['smtp_password'];               // SMTP password
        $webmaster_email = $smtp_statement_results['smtp_username'];       //Reply to this email ID
        $email= $result['email'];                // Recipients email ID
        $name=$setting_statement_results['site_title'];                              // Recipient's name
        $mail->From = $webmaster_email;
        $mail->Port = $smtp_statement_results['smtp_port'];
        $mail->FromName = $setting_statement_results['site_title'];
        $mail->AddAddress($email,$name);
        $mail->AddReplyTo($webmaster_email,$setting_statement_results['site_title']);
        $mail->WordWrap = 50;                         // set word wrap
        $mail->IsHTML(true);                          // send as HTML
        $mail->Subject = "New Password - ".$setting_statement_results['site_title'];

        
        $mail->Body = "Hi,
        your new password is: ".$new_pass;                   //HTML Body 
        $mail->AltBody = "This is the body when user views in plain text format"; //Text Body 

        if(!$mail->Send())
        {
        echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
        // echo "Message has been sent";

            $statement = $pdo->prepare("UPDATE tbl_users SET password=?,forget_token=? WHERE email=?");
            $statement->execute(array(md5($new_pass),"",$result['email']));
            
            echo "Congratulats ! Your new password has been sent on <u>".$result['email']."</u> email address.";
            
            
        }
        // MAIL


    }

}

?>



      
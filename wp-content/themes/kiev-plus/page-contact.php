<?php
/*
Template Name: Contact
*/
?>

<?php
if(isset($_POST['submitted'])) {
    if(trim(isset($_POST['name'])) === '') {
        $nameError = 'Please enter your name.';
        $hasError = true;
    } else {
        $name = trim($_POST['name']);
    }

    /*if(trim(isset($_POST['email'])) === '')  {
        $emailError = 'Please enter your email address.';
        $hasError = true;
    } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
        $emailError = 'You entered an invalid email address.';
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }*/

    if(trim(isset($_POST['phone'])) === '')  {
        $emailError = 'Please enter your email address.';
        $hasError = true;
    } else if (!preg_match("/^[\+0-9\-\(\)\s]*$/", trim($_POST['phone']))) {
        $emailError = 'You entered an invalid email address.';
        $hasError = true;
    } else {
        $phone = trim($_POST['phone']);
    }

    if(trim($_POST['msg']) === '') {
        $commentError = 'Please enter a message.';
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['msg']));
        } else {
            $comments = trim($_POST['msg']);
        }
    }

    if(!isset($hasError)) {
        $emailTo = get_option('tz_email');
        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = get_option('admin_email');
        }
        $subject = 'Kiev Plus '.$name;
        $body = "Имя: $name \n\nEmail: $phone \n\nКоментарий: $comments";
        $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $phone;

        wp_mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }

} ?>
<?php //get_header(); ?>
    <div id="container">
        <div id="content">

            Email Sent success
          <?php header("Location: http://kiev-plus.com"); ?>
        </div><!-- #content -->
    </div><!-- #container -->

<?php //get_footer(); ?>
<?php

// Function for email address validation
function isEmail($verify_email) {

    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$verify_email));

}

$error_name = false;
$error_email = false;
$error_phone = false;
$error_prj_type = false;
$error_prj_description = false;
$error_budget = false;

if (isset($_POST['submit'])) {
    // Initialize the variables
    $name = '';
    $email = '';
    $phone = '';
    $type = '';
    $description = '';
    $budget = '';
    $msg = '';

    // Get the name
    if (trim($_POST['name']) === '') {
        $error_name = true;
    } else {
        $name = trim($_POST['name']);
    }

    // Get the email
    if (trim($_POST['email']) === '' || !isEmail($_POST['email'])) {
        $error_email = true;
    } else {
        $email = trim($_POST['email']);
    }

    // Get the phone number
    if (trim($_POST['phone']) === '') {
        $error_phone = true;
    } else {
        $phone = trim($_POST['phone']);
    }

    // Get the project type
    if (trim($_POST['quote-project-type']) === '0') {
        $error_prj_type = true;
    } else {
        $type = trim($_POST['quote-project-type']);
    }

    // Get the project description
    if (trim($_POST['quote-project-description']) === '') {
        $error_prj_description = true;
    } else {
        $description = stripslashes(trim($_POST['quote-project-description']));
    }

    // Get the budget
    if (trim($_POST['quote-msg']) === '') {
        $error_budget = true;
    } else {
        $budget = trim($_POST['msg']);
    }

    // Check if we have errors
    if (!$error_name && !$error_email && !$error_phone && !$error_prj_type && !$error_prj_description && !$error_budget) {
        // Get the receiver email from the WP admin panel
        $receiver_email = get_option('admin_email');

        $subject = "Quote request from $name";
        $body = "You have a new quote request from $name. Project details:" . PHP_EOL . PHP_EOL;
        $body .= "Project type: $type" . PHP_EOL;
        $body .= "Project description: $description" . PHP_EOL . PHP_EOL;
        $body .= "Available budget: $budget" . PHP_EOL . PHP_EOL;
        $body .= "You can contact $name via email at $email or via phone at $phone.";
        $body .= PHP_EOL . PHP_EOL;

        $headers = "From: $email" . PHP_EOL;
        $headers .= "Reply-To: $email" . PHP_EOL;
        $headers .= "MIME-Version: 1.0" . PHP_EOL;
        $headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
        $headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

        // If all is good, we send the email
        if (mail($receiver_email, $subject, $body, $headers)) {
            $email_sent = true;
        } else {
            $email_sent_error = true;
        }
    }
}

?>
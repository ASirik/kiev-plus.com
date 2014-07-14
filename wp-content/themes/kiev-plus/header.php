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
        if($emailSent == true){
            header("Location: http://kiev-plus.com");
            ?>
            <!--<script>//jQuery(document).ready(function($){
                    window.location.href('http://kiev-plus.com');
                    email();
                //})
            </script>-->
        <?php }
    }

} ?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta <?php bloginfo('charset') ?> />
    <title><?php wp_title('|', true, 'right') ?><?php bloginfo('name') ?></title>
    <meta name="description" content="<?php bloginfo('description') ?>"/>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?> "/>
    <?php wp_head() ?>
</head>
<body class="<?php body_class() ?>">



<header class="main-header">
    <section class="header-small"></section>
    <div class="content-wrapper">
        <div class="header-wrapper">
            <div class="logo">
                <h1 class="logo-wrapper">
                    <strong>Kiev-Plus</strong>
                    <a href="<?php echo home_url() ?>" class="logo"></a>
                </h1>
            </div>
            <section class="contact-information right">
                <p class="back-call cups left">
                    <a id="back-call">Обратный звонок</a>
                </p>
                <div class="numbers right">
                    <p class="number bold">(044)&nbsp; 355-63-36</p>
                    <p class="number bold">(044)&nbsp; 97-57-575</p>
                </div>
                <h2 class="cups">Бесплатная доставка по всей Украине</h2>
            </section>
        </div>
    </div>

    <div class="back-call pop-up" style="display:none">
        <?php require_once 'back-call.php' ?>
        <div class="content-wrapper-smaller">
            <div class="close right">X</div>
            <div class="content">
                <?php
                $page = get_post(9);
                ?>
                <?php get_the_content($page); ?>


                    <form action="<?php bloginfo('url'); ?>" method="POST">
                        <div class="call-back-form">
                            <p class="short-msg right">
                                Оставьте Ваш телефон и укажите Ваш вопрос, наши менеджеры
                                свяжутся с Вами.
                            </p>
                            <div class="clearfix"></div>
                            <p>
                                <label for="name">Ваше имя:</label>
                                <input type="text" id="name" name="name"/>
                            </p>
                            <p>
                                <label for="phone">Телефон</label>
                                <input type="text" name="phone" id="phone"/>
                            </p>
                            <p>
                                <label for="msg">Ваше <br/> сообщение</label>
                                <textarea name="msg" id="msg" cols="30" rows="10"></textarea>
                            </p>
                            <p class="submit-wrapper">
                                <input class="submit" type="submit" value="Отправить"/>
                                <input type="hidden" name="submitted" id="submitted" value="true" />
                            </p>
                            <div class="clearfix"></div>
                        </div>
                    </form>
            </div>
        </div>
    </div>


    <div class="contacts pop-up" style="display:none">
        <div class="content-wrapper-smaller">

            <div class="close right">X</div>
            <div class="content">
                <h1>Контакты</h1>
                <p>Адрес: г. Чернигов, ул. Толстого, 15, офис 201</p>
                <p>Ваш e-mail: kiev-plus@ukr.net</p>
                <p>Контактные тел: (044) 355-63-36 (063) 000-00-00</p>

                <div class="map">

                </div>
            </div>
        </div>
    </div>
</header>
<footer>
    <div class="content-wrapper">
        <div class="menu left">
            <p><a class="cups" href="#">Обратная Связь</a></p>
            <p><a class="cups" href="#">Обратный Звонок</a></p>
        </div>
        <div class="contacts left">
            <a class="cups" id="contact">Контакты</a>
            <p class="address">г. Чернигов <br/> kiev-plus@ukr.net</p>
        </div>
        <div class="phones left">
            <p>(044) 355-63-36</p>
            <p>(063) 97-57-575</p>
        </div>
        <div class="logo logo-small right static">
            <h1 class="logo-wrapper">
                <strong>Kiev-Plus</strong>
                <p><a href="<?php echo home_url() ?>" class="logo"></a></p>
            </h1>
        </div>

    </div>
    <section class="header-small-wrapper clearfix">
        <div class="header-small-content">
            <p class="left cups">Изготовление пластиковы карт</p>
            <p class="right cups">Бесплатная доставка по всей Украине</p>
        </div>
    </section>
</footer>
<script type="text/javascript">
    function validateForm()
    {
        /* Validating name field */
        var x=document.forms["myForm"]["name"].value;
        if (x==null || x=="")
        {
            alert("Name must be filled out");
            return false;
        }
        /* Validating email field */
        var x=document.forms["myForm"]["email"].value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
        {
            alert("Not a valid e-mail address");
            return false;
        }
    }
</script>
    <?php wp_footer() ?>
</body>
</html>
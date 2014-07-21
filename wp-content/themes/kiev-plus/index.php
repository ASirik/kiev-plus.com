<?php get_header(); ?>
    <section class="hero-image clearfix">
        <div class="content-wrapper">
        <?php
            $page = get_post(5);
        ?>
            <?php echo $page->post_content; ?>

            <div class="image-description left">
                <h1 class="text-right cups">
                    Выберите свою <br/> пластиковую карту
                </h1>
            </div>
        </div>
    </section>
    <section class="container main-content content-wrapper">
        <?php if(have_posts()):  ?>

        <div class="plastic-cards-slider">
            <ul class="bxslider">
                <?php while(have_posts()) : the_post(); ?>
                <li class="items" data-post-id="<?php echo $post->ID ?>">
                    <a href="#">
                        <?php if(has_post_thumbnail()): ?>
                        <div class="img-cart-small left">
                            <?php the_post_thumbnail() ?>
                        </div>
                        <?php endif ?>
                        <div class="cart-description left">
                            <?php the_title() ?>
                        </div>
                    </a>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <?php else : ?>
        <h1>Заполните все поля формы
            (044) 355-63-36
            (063) 97-57-575</h1>
        <?php endif; ?>

    </section>
<?php if(have_posts()):  ?>
    <?php while(have_posts()) : the_post(); ?>
    <div class="card-content" style="display: none" id="<?php  echo $post->ID ?>">
        <div class="content-wrapper-smaller">
            <div class="card">
                <?php the_content(); ?>
            </div>
            <div class="card-description">
        <?php echo htmlspecialchars_decode(get_post_meta($post->ID, 'SMTH_METANAME_VALUE' , true )) ;
            $b = $datta=htmlspecialchars($_POST['card_description']);
        ?>
            </div>
        </div>
    </div>
        <?php endwhile ?>
<?php endif; ?>
<?php get_footer(); ?>
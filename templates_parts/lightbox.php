<?php
while (have_posts()):
    the_post(); ?>
    <div class="lightbox">
        <button class="lightbox__close"></button>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="lightbox__container">
                    <img class="lightbox__image" src="" alt="Image">




            
            <div class ="lightbox__titredate">
            <p class="lightbox__titre"> </p>
            <p class="lightbox__date"> </p>
           
</div>
<img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/fleche_gauche.png" class="fleche-gauche" alt="Flèche gauche">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/fleche_droite.png" class="fleche-droite" alt="Flèche droite">

</div>
        </article><!-- #post-<?php the_ID(); ?> -->
    <?php endwhile; ?>
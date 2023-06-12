<?php
while (have_posts()):
    the_post(); ?>
    <div class="lightbox">
        <button class="lightbox__close"></button>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="lightbox__container">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/fleche_gauche.png"
                    class="fleche fleche-gauche" alt="Flèche gauche">
                <img class="lightbox__image" src="" alt="Image">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/fleche_droite.png"
                    class="fleche fleche-droite" alt="Flèche droite">
                <div class="lightbox__titre">
                    <p class="lightbox__titre"> </p>
                </div>
                <div class="lightbox__datecateg">
                    <p class="lightbox__date"> </p>
                    <p class="lightbox__categ"> </p>
                </div>
            </div>
    </div>
    </article><!-- #post-<?php the_ID(); ?> -->
<?php endwhile; ?>
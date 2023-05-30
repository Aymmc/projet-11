

<?php 
while (have_posts()):
            the_post(); ?>
<div class="lightbox">
<button class="lightbox__close"></button>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="lightbox__container">
                <img class="lightbox__image" src="" alt="Image">

            <p class ="lightbox__titre"> </p>
            <p class="lightbox__date">  </p>
        </div>
        </article><!-- #post-<?php the_ID(); ?> -->
        <?php endwhile; ?>
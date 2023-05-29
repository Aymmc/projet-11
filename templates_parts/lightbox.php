

<?php 
while (have_posts()):
            the_post(); ?>
<div class="lightbox">
<button class="lightbox__close"></button>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="lightbox__container">
                <img class="lightbox__image" src="" alt="Image">

            <div class ="titrephotolightbox"> </div>
            <div class="anneephotolightbox">  </div>
        </div>
        </article><!-- #post-<?php the_ID(); ?> -->
        <?php endwhile; ?>
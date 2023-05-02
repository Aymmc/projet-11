<?php
/**
* Template Name: Single
* Template Post Type: post
*/
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!-- <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                 -->
                <!-- .entry-header -->

                <?php if ( get_the_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div><!-- .post-thumbnail -->
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>

                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->

        <?php endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
<?php

/**
 * Template Name: Single
 * Template Post Type: post
 */
get_header() ?>

<div id="primary" class="contant">
    <main id="main" class="site-main">

        <?php while (have_posts()):
            the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="post_contant">
                    <div class="post_description">
                        <h1 class="entry-title">
                            <?php the_title(); ?>
                        </h1>
                        <p>REFERANCE :
                            <?php echo get_post_meta(get_the_ID(), 'reference', true); ?>
                        </p>
                        <p>CATÉGORIE :
                            <?php echo the_terms(get_the_ID(), 'categorie', false); ?>
                        </p>
                        <p>TYPE :
                            <?php echo get_post_meta(get_the_ID(), 'type', true); ?>
                        </p>
                        <p>FORMAT :
                            <?php echo the_terms(get_the_ID(), 'format', false); ?>
                        </p>
                        <p>ANNEE:
                            <?php $post_date = get_the_date('Y');
                            echo $post_date; ?>

                    </div>
                    <div class="post_separation">
                    </div>
                    <!-- .entry-header -->
                    <div class="post_image">
                        <?php if (has_post_thumbnail()): ?>
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>"
                                class="post-thumbnail" />
                        <?php endif; ?>
                        <?php the_content(); ?>
                    </div>
                </div>
            </article><!-- #post-<?php the_ID(); ?> -->
            <section>
                <div class="interesse">
                    <p> Cette photo vous intéresse ? </p>
                    <button id="myBtn2" class="contact contact_interesse"> Contact</button>
                    <?php
                    previous_post_link('<span class="left"> %link </span>');
                    next_post_link('<span class="right">%link </span>');
                    ?>
                <?php endwhile; ?>
    </main>
</div>

<?php get_footer(); ?>
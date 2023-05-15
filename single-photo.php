<?php

/**
 * Template Name: Single
 * Template Post Type: photo
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
                        <p class="ref">REFERANCE :
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

                    <div class="post_image">
                        <?php if (has_post_thumbnail()): ?>
                            <img src="<?php the_post_thumbnail_url(array(500,500)); ?>" alt="<?php the_title_attribute(); ?>"
                                class="post-thumbnail" />
                        <?php endif; ?>
                        <?php the_content(); ?>
                    </div>
                </div>
            </article><!-- #post-<?php the_ID(); ?> -->
            <section class="section_interesse">
                <div class="interesse">
                    <div class="btn_interesse">
                        <p> Cette photo vous intéresse ? </p>
                        <button id="myBtn2" class="contact contact_interesse"> Contact</button>
                    </div>
                    <div class="photo_choix">
                        <div class="photo_avant">
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();

                            if (!empty($prev_post)) {
                                $prev_image = get_the_post_thumbnail_url($prev_post->ID);
                                previous_post_link('<span class="left"><img src="' . $prev_image . '" alt="' . $prev_post->post_title . '" width="75" height="75"/> <a href="' . get_permalink($prev_post) . '" rel="prev"><img src="' . get_stylesheet_directory_uri() . '/asset/fleche_gauche.png"></a></span>', '%title', false);
                            }
                            ?>
                        </div>
                        <div class="photo_apres">
                            <?php
                            if (!empty($next_post)) {
                                $next_image = get_the_post_thumbnail_url($next_post->ID);
                                next_post_link('<span class="right"><img src="' . $next_image . '" alt="' . $next_post->post_title . '" width="75" height="75"/> <a href="' . get_permalink($next_post) . '" rel="next"><img src="' . get_stylesheet_directory_uri() . '/asset/fleche_droite.png"></a></span>', '%title', false);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php include_once "templates_parts/photo_block.php"; ?>
        <?php endwhile; ?>
        <div class="btntoutephoto"> <a href="http://localhost/motaphoto/" class="btn btn_toutephoto"> Toutes les photos </a>
                        </div>
    </main>
</div>

<?php get_footer(); ?>
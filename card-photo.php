<?php
// On place les critères de la requête dans un Array
$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => 2,
);
//On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
$query = new WP_Query($args);
?>

<?php if ($query->have_posts()): ?>


    <?php while ($query->have_posts()): ?>
        <?php $query->the_post(); ?>
        <div class="photo_unephoto">
            <a href="<?php the_permalink(); ?>"><?php the_content(); ?></p>
                <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail(); ?>

                </a>
                <div class="fadedbox">
                    <div class="title text">
                        <div class="titre">
                            <p>
                                <?php the_title(); ?>
                            </p>
                        </div>
                        <div class="categorie">
                            <p>
                                <?php echo the_terms(get_the_ID(), 'categorie', false); ?>
                            </p>
                        </div>
                    </div>
                    <div class="divoeil">
                        <a href="<?php the_permalink(); ?>"><img
                                src="<?php echo get_stylesheet_directory_uri(); ?> '/asset/oeil.png' " alt="oeil"></a>
                    </div>
                    <div class="divfullscreen">
                        <button class="buttonlightbox" data-titre="<?php the_title(); ?>" data-date="<?php $post_date = get_the_date('Y');
                          echo $post_date; ?>"
                            data-image="<?php echo esc_attr(get_the_post_thumbnail_url(get_the_ID())); ?>"></button>

                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>


<?php else: ?>
    <p>Désolé, aucun article ne correspond à cette requête</p>
<?php endif;
wp_reset_query();
?>
</div>
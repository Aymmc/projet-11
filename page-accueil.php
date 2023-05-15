<?php
/*
Template Name: Accueil
*/
?>
<?php get_header() ?>
<section class="accueil_aleatoire">
    <div class="accueil_aleatoire_photo">
        <?php query_posts(
            array(
                'post_type' => 'photo',
                'showposts' => 1,
                'orderby' => 'rand',
            )
        ); ?>
        <?php if (have_posts()):
            while (have_posts()):
                the_post(); ?>
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" <?php endwhile; endif; ?>
            </div>
</section>
<section>
    <div class="photo_filtre">
    </div>
    <div class="photo_toutephoto">
        <?php
        // On place les critères de la requête dans un Array
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'DESC',
             'paged' => 1,
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
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            

    <?php else: ?>
        <p>Désolé, aucun article ne correspond à cette requête</p>
    <?php endif;
        wp_reset_query();
        ?>
    </div>
    <div class="chargerplus"> 
        <a href= "#!" class="btn btn_chargezplus" id="load-more"> Charger plus </a>

</section>
<?php get_footer() ?>
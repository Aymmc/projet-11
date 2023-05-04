<section class="section_aimerezaussi">
    <h2> Vous aimerez aussi </h2>
    <?php
    // On place les critères de la requête dans un Array
    $cats = array_map(function ($terms) {
        return $terms->term_id;
    }, get_the_terms(get_post(), 'categorie'));
    $args = array(
        'post__not_in' => [get_the_ID()],
        'post_type' => 'photo',
        'tax_query' => [

            [
                'taxonomy' => 'categorie',
                'terms' => $cats,


            ]
        ]
    );
    //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
    $query = new WP_Query($args);
    ?>
    <div class="photo_aleatoire">
    <!-- //On vérifie si le résultat de la requête contient des articles -->
    <?php if ($query->have_posts()): ?>

            <!-- //On parcourt chacun des articles résultant de la requête -->
            <?php $count = 0; ?>
            <?php while ($query->have_posts()): ?>
                <?php $count++; ?>
                <?php $query->the_post(); ?>
                
                    <p>
                        <?php the_content(); ?>
                    </p>
                    <?php if (has_post_thumbnail()): ?>
                        <div class="photo_aimerezaussi">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <?php if ($count == 2) {
                            break; // sortir de la boucle si deux photos ont été traitées
                        } ?>
                    <?php endif; ?>

            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Désolé, aucun article ne correspond à cette requête</p>
    <?php endif;
    wp_reset_query();
    ?>
</section>
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
<?php
// $categories = isset($_GET['categ']) ? $_GET['categ'] : '';
// $format = isset($_GET['format']) ? $_GET['format'] : '';

// $args = array(); // Initialise le tableau $args

// if ($categories != '' && $categories !== '-1') {
//     $args['tax_query'][] = array(
//         'taxonomy' => 'categorie',
//         'field' => 'slug',
//         'terms' => $categories
//     );
// }

// if ($format != '' && $format !== '-1') {
//     $args['tax_query'][] = array(
//         'taxonomy' => 'format',
//         'field' => 'term_id',
//         'terms' => $format
//     );
// }
// ?>


<form class="js-filter-form" method="post">
    <?php
    $terms = get_terms('categorie');
    $select = "<div class='filtre'> <select name='categ' id='cat1' class='postform'>";
    $select .= "<option value='-1'>-- CATEGORIE --</option>";
    foreach ($terms as $term) {
        if ($term->count > 0) {
            $select .= "<option value='" . $term->slug . "'>" . $term->name . "</option>";
        }
    }
    $select .= "</select> </div>";
    echo $select;
    ?>

    <!-- <?php
    $terms = get_terms([
        'taxonomy' => 'format',
        'post_type' => 'photo',
        'hide_empty' => false,
    ]);
    $select = "<select name='format' id='format1' class='postform'>";
    $select .= "<option value='-1'>-- FORMAT --</option>";
    foreach ($terms as $format) {
        if ($format->count > 0) {
            $selected = (isset($_POST['format']) && $_POST['format'] === $format->slug) ? 'selected' : '';
            $select .= "<option value='" . $format->slug . "' $selected>" . $format->name . "</option>";
        }
    }
    $select .= "</select>";
    echo $select;
    ?> -->
</form>
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
        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post(); ?>
                <div class="photo_unephoto">
                    <a href="<?php the_permalink(); ?>"><?php the_content(); ?></p>
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail(); ?>

                        </a>
                    </div>
                <?php endif;
            endwhile; ?>


        <?php else: ?>
            <p>Désolé, aucun article ne correspond à cette requête</p>
        <?php endif;
        wp_reset_query();
        ?>
    </div>
    <div class="chargerplus">
        <a href="#!" class="btn btn_chargezplus" id="load-more"> Charger plus </a>

</section>
<?php get_footer() ?>
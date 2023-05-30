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
<div class="filtre">
    <div class="filtre_taxo">
        <div class="filtre_categ">
            <label for="categorie">CATEGORIES</label>
            <form class="js-filter-form" method="post">
                <?php
                $terms = get_terms('categorie');
                $select = "<div class='filtre'><select name='categorie' id='cat1' class='postform'>";
                $select .= "<option value='-1'></option>";
                foreach ($terms as $term) {
                    if ($term->count > 0) {
                        $select .= "<option value='" . $term->slug . "'>" . $term->name . "</option>";
                    }
                }
                $select .= "</select></div>";
                echo $select;
                ?>
            </form>
        </div>
        <div class="filtre_form">
            <label for="format">FORMAT</label>
            <form class="js-filter-form" method="post">
                <?php
                $terms = get_terms('format');
                $select = "<div class='filtre'><select name='format' id='format1' class='postform'>";
                $select .= "<option value='-1'></option>";
                foreach ($terms as $term) {
                    if ($term->count > 0) {
                        $select .= "<option value='" . $term->slug . "'>" . $term->name . "</option>";
                    }
                }
                $select .= "</select></div>";
                echo $select;
                ?>
            </form>
        </div>
    </div>
    <div class="filtre_date">
    <label for="date">Date</label>
    <form class="js-filter-form" method="post">
        <div class='date'>
            <select name='date' id='date1' class='postform'>
                <option value='-1'></option>
                <option value='nouveaute'>Nouveauté</option>
                <option value='anciens'>Les plus anciens</option>
            </select>
        </div>
    </form>
</div>
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
    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post(); ?>
            <div class="photo_unephoto">
                </p>
                <?php the_post_thumbnail(); ?>
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
                                src="<?php echo get_stylesheet_directory_uri(); ?> '/asset/oeil.png' " alt="oeil"> </a>
                    </div>
                    <div class="divfullscreen">
                        <button class="buttonlightbox" data-titre="<?php the_title(); ?>" data-date="<?php $post_date = get_the_date('Y');
                          echo $post_date; ?>"
                            data-image="<?php echo esc_attr(get_the_post_thumbnail_url(get_the_ID())); ?>"></button>

                    </div>
                </div>
            </div>
            <?php
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
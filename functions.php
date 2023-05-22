<?php add_action('admin_init', function () {
    if (!isset($_GET['updated'])) {
        return;
    }
    $nonce = $_GET['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'update-core')) {
        wp_die('Security check failed');
    }
}, 100);
?>

<?php
function assets()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/css/main.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'assets');

function script_modal()
{
    wp_enqueue_script('modal', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
    wp_enqueue_script('ajax', get_template_directory_uri() . '/js/ajax.js', array('jquery'), '1.0', true);
    wp_enqueue_script('ajaxfiltre', get_template_directory_uri() . '/js/ajaxfiltre.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'script_modal');
function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}
add_action('after_setup_theme', 'montheme_supports');
?>

<?php
function add_search_form($items, $args)
{
    if ($args->theme_location == 'footer') {
        $items .= '<li>TOUS DROITS RÉSERVÉS</li>';
    } else {
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);


function add_search_form2($items, $args)
{
    if ($args->theme_location == 'header') {
        $items .= '<button id="myBtn" class="myBtn contact header " > Contact</button>';
    } else {
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form2', 10, 2);
?>
<?php ini_set('zlib.output_compression', 'Off'); ?>


<?php add_filter('admin_init', 'my_admin_init');
function my_admin_init()
{
    add_filter('admin_notices', 'my_admin_notices');
}
function my_admin_notices()
{
    global $pagenow;
    if ($pagenow == 'plugins.php' && isset($_GET['deleted'])) {
        if ($_GET['deleted'] == 'true') {
            echo '<div class="notice notice-success is-dismissible"><p>Plugin has been successfully deleted!</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>There was an error deleting the plugin.</p></div>';
        }
    }
}

/* CHag */
function weichie_load_more()
{
    $ajaxposts = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'paged' => $_POST['paged'],
    ]);

    $response = '';

    if ($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()):
            $ajaxposts->the_post();
            $response .= get_template_part('card', 'photo');
        endwhile;
    } else {
        $response = '';
    }

    echo $response;
    exit;
}
add_action('wp_ajax_weichie_load_more', 'weichie_load_more');
add_action('wp_ajax_nopriv_weichie_load_more', 'weichie_load_more');

function wpb_rand_posts()
{

    $args = array(
        'post_type' => 'photo',
        'orderby' => 'rand',
        'posts_per_page' => 1,
    );

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {

        $string .= '<ul>';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $string .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $string .= '</ul>';
        /* Restore original Post Data */
        wp_reset_postdata();
    } else {

        $string .= 'aucun article disponible';
    }

    return $string;
}

add_shortcode('wpb-random-posts', 'wpb_rand_posts');
add_filter('widget-text', 'do_shortcode');

/* CHag */



function filter_post()
{
    // Récupère les catégories sélectionnées depuis la requête POST
    $cat = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';

    // Définit les arguments de la requête WP_Query
    $args = array(
        'post_type' => 'photo', // Type de publication : "photo"
        'posts_per_page' => 8, // Nombre de publications à afficher par page
        'paged' => 1, // Numéro de page
        'tax_query' => array( // Requête de taxonomie pour filtrer par catégorie
            array(
                'taxonomy' => 'categorie', // Taxonomie : "categorie"
                'field' => 'slug', // Champ utilisé pour la correspondance : slug
                'terms' => ($cat == -1 ? get_terms('categorie', array('fields' => 'slugs')) : $cat) // Termes de la catégorie à filtrer
            ),
            array(
                'taxonomy' => 'format', // Taxonomie : "format"
                'field' => 'slug', // Champ utilisé pour la correspondance : slug
                'terms' => ($format == -1 ? get_terms('format', array('fields' => 'slugs')) : $format) // Termes du format à filtrer
            )
        )
    );

    // Effectue la requête WP_Query avec les arguments définis
    $ajaxfilter = new WP_Query($args);

    // Vérifie si des publications ont été trouvées
    if ($ajaxfilter->have_posts()) {
        ob_start(); // Démarre la mise en mémoire tampon

        // Boucle while pour parcourir les publications
        while ($ajaxfilter->have_posts()) {
            $ajaxfilter->the_post();

            // Affiche le code HTML de chaque publication
            ?>
            <div class="nouveau_block" data-category="<?php echo esc_attr(implode(',', wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'slugs')))); ?>"data-format="<?php echo esc_attr(implode(',', wp_get_post_terms(get_the_ID(), 'format', array('fields' => 'slugs')))); ?>">
                <div class="photo_newunephoto">
                    <a href="<?php the_permalink(); ?>"><?php the_content(); ?>
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail(); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }

        wp_reset_query(); // Réinitialise la requête
        wp_reset_postdata(); // Réinitialise les données de publication

        $response = ob_get_clean(); // Récupère le contenu de la mise en mémoire tampon
    } else {
        $response = '<p>Aucun article trouvé.</p>'; // Aucune publication trouvée
    }

    echo $response; // Affiche la réponse
    exit; // Termine la fonction
}

add_action('wp_ajax_filter_post', 'filter_post');
add_action('wp_ajax_nopriv_filter_post', 'filter_post');

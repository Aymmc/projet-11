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

// Activation ajax natif wordpress

function filter_post()
{
    $query_args = array(
        'post_type' => 'photo',
        'posts_per_page' => 10,
        'paged' => 1,
        'tax_query' => array(
            'relation' => 'AND',
        ),
    );

    // Ajouter le filtre de catégorie
    if (isset($_POST['categorie']) && $_POST['categorie'] !== '') {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'term_id',
            'terms' => $_POST['categorie'],
        );
    }

    // Ajouter le filtre de format
    if (isset($_POST['format']) && $_POST['format'] !== '') {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'term_id',
            'terms' => $_POST['format'],
        );
    }

    // Ajouter le filtre de date
    if (isset($_POST['date']) && $_POST['date'] !== '') {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'format_date',
            'field' => 'term_id',
            'terms' => $_POST['date'],
        );
    }

    $ajaxfilter = new WP_Query($query_args);
    $response = '';

    if ($ajaxfilter->have_posts()) {
        while ($ajaxfilter->have_posts()) {
            $ajaxfilter->the_post();
            $response .= get_template_part('filtre', 'photo');
        }
    } else {
        $response = '';
    }

    echo $response;
    exit;
}

add_action('wp_ajax_filter_post', 'filter_post');
add_action('wp_ajax_nopriv_filter_post', 'filter_post');
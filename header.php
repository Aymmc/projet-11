<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500&family=Space+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <?php wp_head() ?>
    <script>
        $(document).ready(function () {
            var maref = "<?php echo get_post_meta(get_the_ID(), 'reference', true); ?>";
            $("#refphoto").val(maref);
        });
    </script>
</head>

<body>
    <header>

        <div class="menu_header">
            <a href="http://localhost/motaphoto/"><img src="<?php echo get_stylesheet_directory_uri(); ?> '/asset/logo.png' " alt="logo"> </a>
            <?php wp_nav_menu(['theme_location' => 'header', 'container' => false, 'menu_class' => 'header']) ?>
        </div>

        <?php include_once "templates_parts/modale.php"; ?>
    </header>
    <div class="container">
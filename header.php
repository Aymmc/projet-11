<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>
<body>
    <header> 
        <div class="menu_header">
            <img src="wp-content\themes\motaphoto\asset\logo.png" alt="logo"> 
            <?php wp_nav_menu(['theme_location' => 'header','container' => false,'menu_class' => 'header']) ?>
        </div>
    </header>
        <div class="container">
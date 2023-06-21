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
                            data-image="<?php echo esc_attr(get_the_post_thumbnail_url(get_the_ID())); ?>" data-categ="<?php
                               $categories = get_the_terms(get_the_ID(), 'categorie'); // Remplacez 'categorie' par le nom de votre taxonomie
                               if ($categories && !is_wp_error($categories)) {
                                   // Vérifie si la variable $categories existe et n'est pas une erreur de WordPress
                                   $category_names = array(); // Crée un tableau vide pour stocker les noms des catégories
                                   foreach ($categories as $category) {
                                       // Parcourt chaque terme de taxonomie dans $categories
                                       $category_names[] = $category->name;
                                       // Ajoute le nom de la catégorie courante au tableau $category_names
                                   }
                                   echo implode(', ', $category_names);
                                   // Concatène les noms des catégories avec une virgule comme séparateur
                               }
                               ?>"><img src="wp-content\themes\motaphoto\asset\fullscreen.png"></button>
                    </div>
                </div>
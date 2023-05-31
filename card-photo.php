
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
 <script> $(document).ready(function() {
  // Sélectionner l'élément de la lightbox
  var lightbox = document.querySelector('.lightbox');

  // Sélectionner le bouton de fermeture de la lightbox
  var spanlightbox = document.querySelector('.lightbox__close');

  // Sélectionner tous les boutons qui ouvrent la lightbox
  var buttonlightbox = document.querySelectorAll('.buttonlightbox');

  // Lorsque l'un des boutons est cliqué
  buttonlightbox.forEach(function(button, index) {
    button.addEventListener('click', function(e) {
      e.preventDefault();

      // Récupérer l'URL, le titre et la date de l'image associée au bouton
      var imageSrc = button.getAttribute('data-image');
      var imageTitre = button.getAttribute('data-titre');
      var imageDate = button.getAttribute('data-date');

      // Sélectionner l'élément de l'image dans la lightbox
      var lightboxImage = lightbox.querySelector('.lightbox__image');
      var lightboxTitre = lightbox.querySelector('.lightbox__titre');
      var lightboxDate = lightbox.querySelector('.lightbox__date');

      // Définir la source de l'image avec l'URL récupérée
      lightboxImage.setAttribute('src', imageSrc);

      // Définir le titre et la date de l'image dans la lightbox
      lightboxTitre.textContent = imageTitre;
      lightboxDate.textContent = imageDate;

      // Afficher la lightbox
      lightbox.style.display = 'block';

      // Enregistrer l'index du bouton cliqué pour la navigation
      lightbox.setAttribute('data-current-index', index);
    });
  });

  // Lorsque le bouton de fermeture est cliqué
  spanlightbox.onclick = function() {
    // Cacher la lightbox
    lightbox.style.display = 'none';
  };

  // Lorsque l'utilisateur clique en dehors de la lightbox
  window.onclick = function(event) {
    // Si l'élément cliqué est la lightbox elle-même
    if (event.target == lightbox) {
      // Cacher la lightbox
      lightbox.style.display = 'none';
    }
  };

  // Lorsque les flèches gauche et droite sont cliquées
  lightbox.querySelector('.fleche-gauche').addEventListener('click', function(e) {
    e.stopPropagation(); // Empêche la propagation de l'événement pour éviter la fermeture de la lightbox
    // parseInt permet de recuperer une chaine de caractères en entier 
    var currentIndex = parseInt(lightbox.getAttribute('data-current-index'));
    var previousButton = buttonlightbox[currentIndex - 1];
    if (previousButton) {
      previousButton.click();
      lightbox.setAttribute('data-current-index', currentIndex - 1);
    }
  });

  lightbox.querySelector('.fleche-droite').addEventListener('click', function(e) {
    e.stopPropagation(); // Empêche la propagation de l'événement pour éviter la fermeture de la lightbox

    var currentIndex = parseInt(lightbox.getAttribute('data-current-index'));
    var nextButton = buttonlightbox[currentIndex + 1];
    if (nextButton) {
      nextButton.click();
      lightbox.setAttribute('data-current-index', currentIndex + 1);
    }
  });
});

</script>
</div>
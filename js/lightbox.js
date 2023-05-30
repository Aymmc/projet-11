// Sélectionner l'élément de la lightbox
var lightbox = document.querySelector('.lightbox');

// Sélectionner le bouton de fermeture de la lightbox
var spanlightbox = document.querySelector('.lightbox__close');

// Sélectionner tous les boutons qui ouvrent la lightbox
var buttonlightbox = document.querySelectorAll('.buttonlightbox');

// Lorsque l'un des boutons est cliqué
buttonlightbox.forEach(button => {
  button.addEventListener('click', function(e) {
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
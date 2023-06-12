
// Recuperer Ref photo 
$(document).ready(function() {
    var maref = "<?php echo get_post_meta(get_the_ID(), 'reference', true); ?>";
    $("#email").val("maref");
  });

//   Modal

var modal = document.getElementById('myModal');
const btn = document.querySelectorAll('.myBtn')
btn.forEach(function(button ) {
    button.addEventListener('click', function(e){
      e.preventDefault();

      modal.style.display = "block";
    });
    
})

window.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});
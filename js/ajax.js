// console.log('zbi');
let currentPage = 1;
$('#load-more').on('click', function () {
  currentPage++; // Do currentPage + 1, because we want to load the next page

  $.ajax({
    type: 'POST',
    url: '/motaphoto/wp-admin/admin-ajax.php',
    dataType: 'html',
    data: {
      action: 'weichie_load_more',
      paged: currentPage,
    },
    success: function (res) {
      $('.photo_toutephoto').append(res);
    }
  });
});
console.log('test')







// Filtre Catégorie 

jQuery('#cat1,#format1').on('change', function () {
  var categorie = jQuery('#cat1').val();
  var format = jQuery('#format1').val();


  var data = {
    action: 'filter_post'
  };

  if (categorie) {
    data.categorie = categorie;
  }
    if (format) {
      data.format = format;
    }
    jQuery.ajax({
      type: 'POST',
      url: '/motaphoto/wp-admin/admin-ajax.php',
      data: data,
      success: function (res) {
        $('.photo_toutephoto').html(res);
      }
    });
  });

// Filtre format
// jQuery('#format1').on('change', function() {
//   var format = jQuery('#format1').val();
//   var data = {
//       action: 'filter_post'
//   };

//   if (format) {
//       data.format = format;
//   }

//   jQuery.ajax({
//       type: 'POST',
//       url: '/motaphoto/wp-admin/admin-ajax.php',
//       data: data,
//       success: function(res) {
//           $('.photo_toutephoto').html(res);
//       }
//   });
// });

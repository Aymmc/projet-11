// $(document).ready(function() {
//   $('.js-filter-form-categorie, .js-filter-form-format, .js-filter-form-date').on('change', function(e) {
//     e.preventDefault();
    
//     var categorie = $('.js-filter-form-categorie select').val();
//     var format = $('.js-filter-form-format select').val();
//     var date = $('.js-filter-form-date select').val();

//     $.ajax({
//       type: 'POST',
//       url: '/motaphoto/wp-admin/admin-ajax.php',
//       dataType: 'html',
//       data: {
//         action: 'filter_post',
//         categorie: categorie,
//         format: format,
//         date: date
//       },
//       success: function(res) {
//         $('.photo_toutephoto').empty();
//         $('.photo_toutephoto').append(res);
//       }
//     });
//   });
// });
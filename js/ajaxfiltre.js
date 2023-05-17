jQuery.post(
  ajaxurl, {
      'action': 'filter_post',
      'parametre': document.getElementById("liste").options[document.getElementById('liste').selectedIndex].text,
  },
  console.log('parametre'),
  function(response) {
      // Ca sera le retour (callback) de ta requête contenant les articles filtrés
      document.getElementById('id').innerHTML = response;
  }
);
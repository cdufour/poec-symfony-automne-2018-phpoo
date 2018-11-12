(function() {
  let minLength = 2;
  const category = document.querySelector('#category');
  const suggestions = document.querySelector('#suggestions');
  const proverbs = document.querySelector('#proverbs');


  category.addEventListener('keyup', e => {
    if (category.value.length >= minLength) {
      getSuggestions();
    } else {
      // nettoyage de la liste des suggestions dans le DOM
      suggestions.innerHTML = '';
      proverbs.innerHTML = '';
    }
  })

  function getSuggestions() {
    let url = 'suggest.php?search=' + category.value;
    fetch(url)
      .then(res => res.json())
      .then(categories => {
        // console.log(res);
        let html = '';
        categories.forEach(category => {
          html += '<li>' + category.name + '</li>';
        })
        suggestions.innerHTML = html;
        addEvents();

      })
  } // fin getSuggestions

  function addEvents() {
    let li = suggestions.querySelectorAll('li');
    li.forEach(item => {
      item.addEventListener('click', e => {
        // 1) affichage dans le champ de saisie
        // du texte de la suggestion cliquée
        category.value = e.target.innerText;

        // 2) Faire disparaître la liste des suggestions
        suggestions.innerHTML = '';

        // 3) Demander au serveur de nous envoyer les proverbes
        // liés à la catégorie choisie
        getProverbs();
      })
    })
  } // fin addEvents

  function getProverbs() {
    let url = 'proverbs.php?category=' + category.value;
    fetch(url)
      .then(res => res.json())
      .then(results => {

        let html = '';
        results.forEach(result => {
          html += '<article>'+ result.body +'</article>';
        })
        proverbs.innerHTML = html;

      })
  }

})()

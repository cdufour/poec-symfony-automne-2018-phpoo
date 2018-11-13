(function() {
  let minLength = 2;
  const category = document.querySelector('#category');
  const suggestions = document.querySelector('#suggestions');
  const proverbs = document.querySelector('#proverbs');

  let historySearch = [];


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

    if (historySearch.length > 0) {

      let history = historySearch
        .filter(s => s.value == category.value);

      // si history n'est pas vide, cela signifie
      // que la recherche en cours a déjà eu lieu (mise en cache)
      if (history.length != 0) {
        console.log('Affichage depuis le cache');
        showSuggestions(history[0].results);
      } else {
        // recherche non trouvée dans l'historique :
        // on interroge le serveur par requête ajax
        fetchSuggestions();
      }

    } else {
      // historique vide : requête ajax
      fetchSuggestions();
    }

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

  function showSuggestions(categories) {
    let html = '';
    categories.forEach(category => {
      html += '<li>' + category.name + '</li>';
    })
    suggestions.innerHTML = html;
    addEvents();
  }

  function fetchSuggestions() {
    let url = 'suggest.php?search=' + category.value;

    fetch(url)
      .then(res => res.json())
      .then(categories => {

        // mise à jour du DOM
        showSuggestions(categories);

        // mise en cache de la recherche
        let history = historySearch
          .filter(s => s.value == category.value);

        // si history vaut tableau vide, cela signifie
        // que la recherche en cours n'a jamais été mise en cache
        // dans ce cas, on ajoute la recherche à l'historique
        if (history.length == 0) {
          let search = {
            value: category.value,
            results: categories
          };
          historySearch.push(search);
        }

      }) // fin then
  }

})()

(function() {

  const moreFilters = document.querySelector('#moreFilters');
  const filterCategories = document.querySelector('#filterCategories');
  const thumbs = document.querySelectorAll('.thumb');

  filterCategories.style.display = 'none';

  moreFilters.addEventListener('click', e => {
    e.preventDefault();

    if (filterCategories.style.display == 'none') {
      filterCategories.style.display = 'block';
      moreFilters.innerText = 'Moins de filtres';
    } else {
      filterCategories.style.display = 'none';
      moreFilters.innerText = 'Plus de filtres';
    }
  })

  thumbs.forEach(thumb => {
    thumb.addEventListener('click', e => {
      let pop = parseInt(e.target.nextSibling.innerText);
      e.target.nextSibling.innerText = pop + 1;
      let id = e.target.dataset.id;

      fetch('advert/popularity.php?id=' + id)
        .then(res => res.text())
        .then(res => {
          console.log(res);
        });
    })
  })

})()

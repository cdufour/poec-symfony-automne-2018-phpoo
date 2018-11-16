(function() {

  const moreFilters = document.querySelector('#moreFilters');
  const filterCategories = document.querySelector('#filterCategories');

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

})()

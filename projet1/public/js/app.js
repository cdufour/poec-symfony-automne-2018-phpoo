(function() {

// ciblable du DOM
const playerForm = document.querySelector('#playerForm');
const name = playerForm.querySelector('#name');
const position = playerForm.querySelector('#position');
const submit = playerForm.querySelector('#submit');

submit.addEventListener('click', (e) => {
  e.preventDefault(); // bloque le requête http standard
  // provoquée par le click sur un input submit placé
  // dans une balise <form>
  let player = {
    name: name.value,
    position: position.value,
    team_id: 7
  };

  console.log(player);
})


})()

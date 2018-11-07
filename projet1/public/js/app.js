(function() {

// ciblable du DOM
const playerForm = document.querySelector('#playerForm');
const name = playerForm.querySelector('#name');
const position = playerForm.querySelector('#position');
const submit = playerForm.querySelector('#submit');
const teamId = playerForm.querySelector('#team_id');

submit.addEventListener('click', (e) => {
  e.preventDefault(); // bloque le requête http standard
  // provoquée par le click sur un input submit placé
  // dans une balise <form>
  let player = {
    name: name.value,
    position: position.value,
    team_id: teamId.value
  };

  // requête ajax
  fetch('../process_player.php', {
    headers: { 'Content-Type' : 'application/json' },
    method: 'post',
    body: JSON.stringify(player)
  })
  .then(res => res.text())
  .then(res => {
    console.log(res);
    // mettre à jour le dom, afin d'afficher le joueur
    // enregistré en base de données
  })

}) // fin eventListener


})()

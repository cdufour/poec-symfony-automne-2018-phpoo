(function() {

// ciblable du DOM
const playerForm = document.querySelector('#playerForm');
const name = playerForm.querySelector('#name');
const position = playerForm.querySelector('#position');
const submit = playerForm.querySelector('#submit');
const teamId = playerForm.querySelector('#team_id');
const playersTable =
  document.querySelector('#playersTable tbody');

let btnsEdit = null; // variable servant à collecter les boutons d'édition
let btnsDelete = null;


// mode insertion par défaut
// aucun joueur n'est pas en cours d'édition
let editedPlayerId = null;
let editedRow = null;

submit.addEventListener('click', e => {
  e.preventDefault(); // bloque le requête http standard
  // provoquée par le click sur un input submit placé
  // dans une balise <form>
  let player = {
    name: name.value,
    position: position.value
  };

  let url = '';
  if (editedPlayerId == null) {
    url = '../process_player.php';

    // ajout de l'identifiant de l'équipe associée au joueur
    // que l'on souhaite enregistré en DB
    player.team_id = teamId.value

  } else { // mode update
    url = 'player_update.php';
    player.id = editedPlayerId;
  }

  // requête ajax
  fetch(url, {
    headers: { 'Content-Type' : 'application/json' },
    method: 'post',
    body: JSON.stringify(player)
  })
  .then(res => res.text())
  .then(res => {
    // Mise à jour le DOMs
    if (editedPlayerId == null) {
        // mode insertion : on ajoute un ligne au tableau
        // dans ce mode, res correspond à l'identifiant
        // du dernier joueur enregistré en DB
      let html = playersTable.innerHTML;
      let tr = `
        <tr>
          <td>${player.name}</td>
          <td>${player.position}</td>
          <td>
            <button data-id="${res}" class="btnEdit btn btn-warning btn-sm">Editer</button>
            <button data-id="${res}" class="btnDelete btn btn-danger btn-sm">Supprimer</button>
          </td>
        </tr>
      `;
      html += tr; // concaténation du balisage html actuel
      // avec la nouvelle ligne
      playersTable.innerHTML = html; // mise à jour du DOM
      // cette affection remplace une partie du DOM
      // les écouteurs d'événements précédemment placés
      // sur ce DOM sont détruits. On doit remettre en place
      // l'écoute événementielle.
      // on rappelle la fonctionn addEventsToBtns() pour
      // réintroduire les écouteurs d'événements sur les boutons
      // Editer et supprimer
      addEventsToBtns();

    } else {
      // mode édition: on remplace les informations
      // du joueur édité dans le tableau

      editedRow.children[0].innerText = player.name;
      editedRow.children[1].innerText = player.position;

      clear();
    }

  })

}) // fin eventListener

function addEventsToBtns() {
  // on récupére l'ensemble des boutons Editer et Supprimer
  btnsEdit = playersTable.querySelectorAll('.btnEdit');
  btnsDelete = playersTable.querySelectorAll('.btnDelete');

  btnsEdit.forEach(btn => {
    btn.addEventListener('click', e => {
      editedRow = e.target.parentNode.parentNode;
      let tr = e.target.parentNode.parentNode;

      let player = {
        name: tr.children[0].innerText.trim(),
        position: tr.children[1].innerText.trim(),
        id: e.target.dataset.id
      }
      editedPlayerId = player.id;
      name.value = player.name;
      position.value = player.position;
      submit.value = 'Mettre à jour';
    }) // fin EventListener
  }) // fin forEach

  btnsDelete.forEach(btn => {
    btn.addEventListener('click', e => {
      fetch('player_delete.php?id=' + e.target.dataset.id)
        .then(res => res.text())
        .then(res => {

          // mettre à jour le DOM
          if (res == 1) {
            e.target.parentNode.parentNode.remove();
          }

        })
    }) // fin EventListener
  }) // fin forEach
} // fin addEventsToBtns


function clear() {
  editedPlayerId = null;
  editedRow = null;
  name.value = '';
  position.value = 'Gardien';
  submit.value = 'Enregistrer';
}

function init() {
  addEventsToBtns();
}

init();

})()

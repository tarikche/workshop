/*!
* Start Bootstrap - Personal v1.0.1 (https://startbootstrap.com/template-overviews/personal)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-personal/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project
document.addEventListener('DOMContentLoaded', function () {
    const conversationDiv = document.getElementById('conversation');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    

    sendButton.addEventListener('click', async function () {
        const message = messageInput.value;

        if (message) {
            // Ajoutez le message saisi à la conversation (côté droit)
            addMessageToConversation(message, 'user');

            // Effacez le champ de saisie après avoir envoyé le message
            messageInput.value = '';

            // Envoyez le message à l'API
            const response = await sendMessageToAPI(message);

            // Affichez la réponse de l'API dans la conversation (côté gauche)
            addMessageToConversation(response, 'api');
        }
    });

    function addMessageToConversation(message, messageType) {
        const messageElement = document.createElement('div');
        messageElement.textContent = message;
        messageElement.classList.add('message', messageType); // Ajoutez des classes pour styliser le message
        conversationDiv.appendChild(messageElement);

        // Faites défiler vers le bas pour afficher le dernier message
        conversationDiv.scrollTop = conversationDiv.scrollHeight;
    }

    async function sendMessageToAPI(message) {
      const requestData = {
        message: message, // Message to send to the Symfony route
      };
      fetch('/request', {
      method: 'POST', // or 'POST' if your Symfony action requires POST
      headers: {
          'Content-Type': 'application/json',
      },
      body: JSON.stringify(requestData),
      
  })
  .then(response => response.json())
  .then(data => {
      // Handle the JSON response from your Symfony controller
      console.log(data);
      addMessageToConversation(data, 'api');

  })
  .catch(error => {
      // Handle errors
      console.error(error);
  });}
});

let reponses = []; // Tableau pour stocker les réponses.
    let reponseChoisie = null;
    const reponseCorrecte = 'Paris';

    function choisirReponse(button, reponse) {
      reponseChoisie = reponse;

      const buttons = document.querySelectorAll('#reponses button');
      buttons.forEach(btn => {
        btn.classList.remove('selected');
      });

      button.classList.add('selected');

      document.getElementById('envoyer').style.display = 'block';
    }

    function questionSuivante() {
      reponses.push(reponseChoisie); // Ajoute la réponse à notre tableau de réponses.

      if (reponseChoisie === reponseCorrecte) {
        alert('Bonne réponse !');
      } else {
        alert('Mauvaise réponse. La réponse correcte était ' + reponseCorrecte);
      }

      reponseChoisie = null;

      const buttons = document.querySelectorAll('#reponses button');
      buttons.forEach(button => {
        button.disabled = false;
        button.classList.remove('selected');
      });

      document.getElementById('envoyer').style.display = 'none';

      // Vous pouvez ajouter ici du code pour afficher la question suivante.
      // Par exemple, changer le texte de la question et les options de réponse.
      // Assurez-vous de mettre à jour reponseCorrecte en conséquence.
    }







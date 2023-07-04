import './styles/app.css';

// Définition de la structure de la réponse du formulaire
/**
 * @typedef {Object} ArticleFormResponse
 * @property {string} code - Le code de la réponse (200, 400, etc.)
 * @property {Object} errors - Les erreurs de validation du formulaire
 * @property {string} html - Le lien vers la page HTML de redirection
 */

// Écouteur d'événement pour la soumission du formulaire
const formArticle = document.querySelector('#form_article');

document.addEventListener('DOMContentLoaded', function () {
    if (formArticle) {
        formArticle.addEventListener('submit', function (e) {
            e.preventDefault();

            // Récupération des données du formulaire
            const formData = new FormData(e.target);

            // Envoi de la requête au serveur
            fetch(this.action, {
                body: formData,
                method: 'POST'
            })
                .then(response => response.json())
                .then(json => handleResponse(json))
                .catch(error => handleNetworkError(error));
        });
    }

});


/**
 * Gère la réponse du serveur après la soumission du formulaire
 * @param {ArticleFormResponse} response - La réponse du serveur
 */
const handleResponse = function (response) {
    removeErrors(); // Supprime les messages d'erreur précédents

    let category = response.category !== null ? response.category : 'all';

    // Traitement de la réponse en fonction du code
    switch (response.code) {
        case '200':
            // Redirection vers la page HTML indiquée dans la réponse
            formArticle.reset()
            window.location.href = response.html + '/' + category;
            break;
        case '400':
            handleErrors(response.errors); // Gestion des erreurs de validation du formulaire
            break;
    }
};

/**
 * Supprime les messages d'erreur du formulaire
 */
const removeErrors = function () {
    const invalidFeedbackElements = document.querySelectorAll('.invalid-feedback');
    const isInvalidElements = document.querySelectorAll('.is-invalid');

    // Supprime les messages d'erreur
    invalidFeedbackElements.forEach(errorElement => errorElement.remove());

    // Supprime les classes 'is-invalid' des champs en erreur
    isInvalidElements.forEach(isInvalidElement => isInvalidElement.classList.remove('is-invalid'));
};

/**
 * Gère les erreurs de validation du formulaire
 * @param {Object} errors - Les erreurs de validation
 */
const handleErrors = function (errors) {
    if (Object.keys(errors).length === 0) return;

    // Parcourt les erreurs de validation et les affiche
    for (const key in errors) {

        let element = document.querySelector(`#article_${key}`);
        element.classList.add('is-invalid');

        let div = document.createElement('div');
        div.classList.add('invalid-feedback', 'd-block');
        div.innerText = errors[key];

        element.after(div);
    }
};

/**
 * Gère les erreurs réseau lors de la communication avec le serveur
 * @param {Error} error - L'erreur réseau
 */
const handleNetworkError = function (error) {
    console.error('Erreur réseau:', error);
};

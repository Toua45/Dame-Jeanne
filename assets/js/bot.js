let chatbotHeader = document.querySelector(".chatbot__header"); // Déclraration d'une variable pour récupérer l'élément html class = "chatbot__header"
let chatbotIcon = document.getElementById("chatBot_icon"); // Déclaration d'une variable pour récupérer l'élément html id = "chatBot_icon"
let messages = document.getElementById('chatBot_messages');
let input = document.getElementById('input');
let botBlock = document.getElementById('botBlock');
let userBlock = document.getElementById('userBlock');
let messageNum = 0;

/*
 * On récupère l'élément html class = "chatbot__header" auquel on ajoute un évènement "click"
 * qui permet de mettre en display = "none" tous les éléments enfants dont la class = "chatbot" d'un tableau
 * et de mettre en display = "block" l'élément html id = "chatBot_icon"
 */
chatbotHeader.addEventListener("click", () => {
        let element = document.getElementsByClassName("chatbot");
        element[0].style.display = "none";
        chatbotIcon.style.display = "block";
    },
    false
);

/*
 * On récupére l'élément html id = "chatBot_icon" auquel on ajoute un évènement "click"
 * qui permet de mettre en display = "block" tous les éléments enfants dont la class = "chatbot" d'un tableau,
 * de donner le focus sur l'élément html id = "input" et de mettre en display = "none" l'élément html id = "chatBot_icon"
 */
chatbotIcon.addEventListener("click", () => {
        let element = document.getElementsByClassName("chatbot");
        element[0].classList.remove("chatbot--closed");
        element[0].style.display = "block";
        input.focus();
        chatbotIcon.style.display = "none";
    }
);

/*
 * Fonction TakeTheInput lié à l'évènement "keyup" de l'élément html id = "input",
 * cette fonction est appelé lorsque le focus est dans l'élément html id = "input"
 * et que la touche du clavier "Entrer" qui a été pressée est relâchée
 */
function takeTheInput(event) {
    if (event.key === "Enter") {
        // innerHTMl permet de modifier le contenu d'un élément HTML
        // outerHTML renvoie l'élément HTML et tout son contenu, y compris la balise de début, ses attributs et la balise de fin
        messages.innerHTML += userBlock.outerHTML;
        messageNum += 1;
        // on affecte le messageNum au dernier enfant de l'élément html id = "chatBot_messages"
        messages.lastChild.id = messageNum;
        // on récupère l'élément et on remplace la class = "d-none" en "d-flex"
        document.getElementById(messageNum).classList.replace('d-none', 'd-flex');
        // on récupère le contenu texte de l'enfant de notre élément précédent et on lui affecte la valeur de notre input
        messages.lastChild.childNodes[1].textContent = input.value;
        processInput(input.value);
        input.value = "";
        autoScroll(); // Permet de s'aligner au dernier message
    }
}

/*
 * Cette fonction est appelé dans la fonction takeTheInput
 */
function processInput(inputVal) {
    if (inputVal !== "") {
        botBlock.classList.replace('d-none', 'd-inline-block');
        messages.innerHTML += botBlock.outerHTML;
        messageNum += 1;
        messages.lastChild.id = messageNum;
        // on récupère le loader
        let loader = messages.lastChild.childNodes[2];
        // on lui ajoute un délai de 2 sec
        setTimeout(() => { loader.classList.replace('lds-ellipsis','d-none') }, 2000);
        let botAnswer = messages.lastChild.childNodes[1];
        setTimeout(() => {
            botAnswer.innerHTML = reply(inputVal)
        }, 2000);
        autoScroll(); // Permet de s'aligner au dernier message
    }
}

const autoScroll = () => {
    // On récupère le dernier élément
    const newMessage = messages.lastElementChild;
    // On récupère le nombre de pixels dont le contenu de l'élément a défilé vers le haut
    messages.scrollTop = messages.scrollHeight - (newMessage.offsetHeight + 60);
};

let placeQuestions = ["Ou", "Où", "ou", "où", "situé", "situer"];

let hourQuestions = ["Quand", "quand", "heure", "heures", "horaires"];

let productQuestions = ["Produit", "Produits", "produit", "produits", "vendez", "vendre", 'trouver', 'retrouver'];

/*
 * Cette fonction est appelé dans la fonction processInput
 */
function reply(inputVal) {
    // La méthode match () recherche une chaîne qui correspond au regex et retourne les correspondances, sous la forme d'un objet tableau.
    let result = inputVal.match(/[-a-zA-Z*(é|è|à|ù)]+/g);
    let answer = '';
    // permet de récupérer l'origine de l'URL exemple : http://www.example.com:8080
    let url = window.location.origin;

    /* on effectue une boucle pour vérifier si les mots entrés dans l'élément html input correspondent aux mots que l'on a
     * dans notre tableau placeQuestions
     */
    result.forEach(function (placeQuestion) {
        if (placeQuestions.includes(placeQuestion)) {
            answer = "Nous sommes situés au 111 Rue Colbert 37000 Tours.<br>" +
                "Pour plus d'information, vous pouvez vous rendre sur la section " +
                "<a href=" + url + "/#map_section class='chatbot_link'><span class='nav-effect'>Plan</span></a>";
        }
    });

    result.forEach(function (hourQuestion) {
        if (hourQuestions.includes(hourQuestion)) {
            answer = "Nous sommes ouvert du mardi au dimanche de 15h à 00h.<br>" +
                "Pour plus d'information, vous pouvez vous rendre sur la section " +
                "<a href=" + url + "/#map_section class='chatbot_link'><span class='nav-effect'>Plan</span></a>";
        }
    });

    result.forEach(function (productQuestion) {
        if (productQuestions.includes(productQuestion)) {
            answer = "Vous pouvez retrouver la liste de nos produits dans la section " +
                "<a href=" + url + "/product class='chatbot_link'><span class='nav-effect'>Nos produits</span></a>";
        }
    });

    // Si les mots trouvés correspondent aux mots des tableaux, on renvoie la réponse correspondante
    if (answer) {
        return answer;
    }

    // Dans le cas contraire, on retourne cette réponse
    return "Désolé, je ne comprends pas votre question.";
}

// On récupére l'élément html id = "input" auquel on ajoute un évènement "keyup" qui appelle la fonction takeTheInput
input.addEventListener('keyup', takeTheInput);

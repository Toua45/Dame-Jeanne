let chatbotHeader = document.querySelector(".chatbot__header");

let messages = document.getElementById('chatBot_messages');
let input = document.getElementById('input');
let botBlock = document.getElementById('botBlock');
let userBlock = document.getElementById('userBlock');
let messageNum = 0;

chatbotHeader.addEventListener(
    "click",
    () => {
        var element = document.getElementsByClassName("chatbot");
        element[0].style.display = "none";
        document.getElementById("chatBot_icon").style.display = "block";
    },
    false
);

document.getElementById("chatBot_icon").addEventListener(
    "click",
    () => {
        var element = document.getElementsByClassName("chatbot");
        element[0].classList.remove("chatbot--closed");
        element[0].style.display = "block";
        input.focus();
        document.getElementById("chatBot_icon").style.display = "none";
    }
);

function takeTheInput(event) {
    if (event.key === "Enter") {
        messages.innerHTML += userBlock.outerHTML;
        messageNum += 1;
        messages.lastChild.id = messageNum;
        document.getElementById(messageNum).classList.replace('d-none', 'd-flex');
        messages.lastChild.childNodes[1].textContent = input.value;
        processInput(input.value);
        input.value = "";
        autoScroll(); // Permet de s'aligner au dernier message
    }
}

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

let placeQuestions = [
    "Ou",
    "Où",
    "ou",
    "où",
    "situé",
    "situer",
];

let hourQuestions = [
    "Quand",
    "quand",
    "heure",
    "heures",
    "horaires",
];

let productQuestions = [
    "Produit",
    "Produits",
    "produit",
    "produits",
    "vendez",
    "vendre",
    'trouver',
    'retrouver',
];

function reply(inputVal) {
    let result = inputVal.match(/[-a-zA-Z*(é|è|à|ù)]+/g);

    let answer = '';
    let url = window.location.origin;

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

    if (answer) {
        return answer;
    }

    return "Désolé, je ne comprends pas votre question.";
}

input.addEventListener('keyup', takeTheInput);

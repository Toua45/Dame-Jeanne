const filePath = document.getElementById('article_imageFile_file')
|| document.getElementById('product_imageFile_file')
|| document.getElementById('team_imageFile_file')
|| document.getElementById('message_imageFile_file')
|| document.getElementById('partner_partnerFile_file');

function displayImageName() {
    if (filePath !== '') {
        // On change la valeur de filePath en le transformant en un premier temps notre chaîne en un tableau de sous-chaînes et en séparant chaque élément par un \
        const imageName = filePath.value.split("\\");
        // La fonction .pop permet de renvoyer le dernier élément d'un tableau => c'est là qu'on récupère bien le nom de notre image
        const imageLastName = imageName.pop();
        // Changement du contenu HTML sur tous les identifiants 'displayVich' par le nom de notre image
        document.getElementById('displayVich').innerHTML = imageLastName;
    }
}

// Exécution de la fonction displayImageName sur un 'change' en EventListener
filePath.addEventListener('change', () => {
    displayImageName();
})

// On définit une variable pour récupérer tous les éléments html ayant la classe 'switch'
const checkboxes = document.getElementsByClassName('switch');
// eslint-disable-next-line no-undef,no-restricted-syntax
// On boucle sur les éléments et on leurs ajoute un évènement 'change'
for (const checkbox of checkboxes) {
    // eslint-disable-next-line no-undef
    checkbox.addEventListener('change', (event) => {
        event.target.form.submit();
    });
}
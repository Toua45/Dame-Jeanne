let contactFormSubject = document.getElementById('contact_subject');
let btnContactForm = document.getElementById('btn-contact-form');
let contactMessage = document.getElementById('contact_form_message');
let contactReservation = document.getElementById('contact_form_reservation');
let reservationConstraint = document.getElementById('reservation_constraint');

if (contactFormSubject.value === 'choose_options') {
    btnContactForm.classList.replace('d-flex', 'd-none');
    reservationConstraint.classList.replace('d-flex', 'd-none');
}

function changeOption(event) {
    console.log(contactFormSubject.value);

    if (contactFormSubject.value === 'choose_options') {
        btnContactForm.classList.replace('d-flex', 'd-none');
        contactMessage.classList.replace('d-flex', 'd-none');
        contactReservation.classList.replace('d-flex', 'd-none');
        reservationConstraint.classList.replace('d-flex', 'd-none');
    } else if (contactFormSubject.value === 'information') {
        btnContactForm.classList.replace('d-none', 'd-flex');
        contactReservation.classList.replace('d-flex', 'd-none');
        reservationConstraint.classList.replace('d-flex', 'd-none');
        contactMessage.classList.replace('d-none', 'd-flex');
    } else if (contactFormSubject.value === 'reservation') {
        btnContactForm.classList.replace('d-none', 'd-flex');
        contactMessage.classList.replace('d-flex', 'd-none');
        contactReservation.classList.replace('d-none', 'd-flex');
        reservationConstraint.classList.replace('d-none', 'd-flex');
    }
}

contactFormSubject.addEventListener('change', changeOption);




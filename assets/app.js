/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
// start the Stimulus application
import './bootstrap';

// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';

// import styles bundle
import 'swiper/css/bundle';

const Swipes = new Swiper('.swiper-container', {
    loop: true,
    effect: 'fade',
    fadeEffect: {
        crossFade: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
    },
    autoplay: {
        delay: 5000,
        pauseOnMouseEnter: true,
    },
});

const form = document.querySelector('form');
form.addEventListener('submit', (e) => {
    const lastname = document.querySelector('#contact_lastname').value;
    const firstname = document.querySelector('#contact_firstname').value;
    const email = document.querySelector('#contact_email').value;
    const object = document.querySelector('#contact_object').value;
    const message = document.querySelector('#contact_message').value;
    const data = {
        lastname: lastname,
        firstname: firstname,
        email: email,
        object: object,
        message: message,
    }
    e.preventDefault();
    const send = fetch('/contact/new', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    }).then(response => {
        if (response.ok) {
            alert('Votre message a bien été envoyé');
            form.reset();
        } else {
            alert('Une erreur est survenue');
        }
    })

});

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

var Swipes = new Swiper('.swiper-container', {
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

console.log((document.getElementById('testimony_rate').value = '0')); // attribuer la valeur

document.getElementById('starContainer').addEventListener(
    'mouseover',
    function (e) {
        if (e.target.classList.contains('star')) {
            document.getElementById('testimony_rate').value =
                e.target.dataset.value;

            document
                .getElementById('starContainer')
                .querySelectorAll('.star')
                .forEach(function (star, index) {
                    if (index + 1 <= e.target.dataset.value) {
                        star.classList.add('fas');
                        star.classList.remove('far');
                    } else {
                        star.classList.add('far');
                        star.classList.remove('fas');
                    }
                });
        }
    },
    false
);

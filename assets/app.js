/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

let switchToggleButton = document.querySelector('#switch-theme');
let theme = document.querySelector('#theme');

switchToggleButton.addEventListener('click', () => {
    if(theme.getAttribute('data-theme') === 'light') {
        theme.setAttribute('data-theme', 'dark');
    } else {
        theme.setAttribute('data-theme', 'light');
    }
})
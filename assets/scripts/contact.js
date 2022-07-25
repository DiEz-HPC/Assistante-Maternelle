const form = document.querySelector('form');
form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const lastname = document.querySelector('#contact_lastname').value;
    const firstname = document.querySelector('#contact_firstname').value;
    const email = document.querySelector('#contact_email').value;
    const object = document.querySelector('#contact_object').value;
    const message = document.querySelector('#contact_message').value;
    const flashMessages = document.getElementsByClassName('flash-message')
    const title = document.querySelector('#title-contact');

    if (title.classList.contains('mb-5')) {
        title.classList.remove('mb-5');
        title.classList.add('mb-3');
    }

    while (flashMessages[1].firstChild) {
        flashMessages[1].removeChild(flashMessages[1].lastChild);
    }

    const data = {
        lastname: lastname,
        firstname: firstname,
        email: email,
        object: object,
        message: message,
    }
    const send = await fetch('/contact/new', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    const status = send.status;
    const response = await send.json();

    if (status === 422) {
        if (flashMessages[0].style.display === 'block') {
            flashMessages[0].style.display = 'none';
        }
        const ul = document.createElement('ul');
        const errorsResponse = response.errors;
        const errors = Object.keys(errorsResponse).map(key => errorsResponse[key]);
        errors.map(error => {
            error.forEach(message => {
                const li = document.createElement('li');
                li.innerHTML = message + '.';
                ul.appendChild(li);
            })
        });
        ul.style.listStyleType = 'none';
        flashMessages[1].appendChild(ul);
        flashMessages[1].style.display = 'block';
        console.log(flashMessages[1]);
    }else{
        const message = JSON.parse(response)
        if (flashMessages[1].style.display === 'block') {
            flashMessages[1].style.display = 'none';
        }
        flashMessages[0].innerHTML = `Merci ${message.firstname} ${message.lastname}. Votre message a bien été envoyé`;
        flashMessages[0].style.display = 'block';
        form.reset();
    }
});

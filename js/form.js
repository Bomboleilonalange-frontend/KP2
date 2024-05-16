const RegistrathionContainer = document.querySelector('.Registrathion-container');
const RegistrathionLink = document.querySelector('.Registrathion-link');
const AuthorizationContainer = document.querySelector('.Authorization-container');
const AuthorizationLink = document.querySelector('.Authorization-link');
const Wrapper = document.querySelector('.wrapper')
const OpenForm = document.querySelector('#OpenForm')
const OpenForm2 = document.querySelector('#OpenForm2')
const Close = document.querySelector('.close')
const Close2 = document.querySelector('.close2')
const Zatemnenie = document.querySelector('#zatemnenie')



RegistrathionLink.addEventListener('click',() =>{
    RegistrathionContainer.style.display = 'none';
    AuthorizationContainer.style.display = 'block';
});

AuthorizationLink.addEventListener('click', () =>{
    AuthorizationContainer.style.display = 'none'
    RegistrathionContainer.style.display = 'block';
})

OpenForm.addEventListener('click', () =>{
    Wrapper.classList.add('active-popur');
    Zatemnenie.style.display = 'block';
})


OpenForm2.addEventListener('click', () =>{
    Wrapper.classList.add('active-popur');
    Zatemnenie.style.display = 'block';
})


Close.addEventListener('click', () =>{
    Wrapper.classList.remove('active-popur');
    Zatemnenie.style.display = 'none';
    
})

Close2.addEventListener('click', () =>{
    Wrapper.classList.remove('active-popur');
    Zatemnenie.style.display = 'none';
})

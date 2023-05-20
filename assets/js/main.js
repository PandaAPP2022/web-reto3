window.onload = () => {
    let btnHeader = $('.header-display')[0]
    btnHeader.addEventListener('click', displayMenu)
    let passButton = document.getElementById('passButton')
    if (typeof (passButton) != 'undefined' && passButton != null) passButton.addEventListener('click', updatePassword);
    currentPage()
}

currentPage = () => {
    const url = window.location.href
    const header = $('.headerContainer')[0].children
    for (const btn of header) {
        if (url.includes(btn.firstChild.href)) btn.classList.add('currentPage');
    }
}

function displayMenu() {
    
    if (this.src.includes('logo')) this.src = 'assets/img/closemenu.png';
    else this.src = 'assets/img/logo.png';

    const header = $('.header')[0]
    if (header.style.display != 'flex') {
        header.style.display = 'flex';
    } else {
        header.style.display = 'none';
    }
}

logout = () => {
    $('#logout').click();
}

updatePassword = () => {
    let passwd = prompt("Please enter your old password", "Cambio de contraseña");
    if (passwd != null) {
        $('#updatePassword').click();
        $('#oldPassword').value = passwd
    } else {
        alert('Tienes que introducir tu contraseña.');
    }
}

toggleFormLogged = (btn) => {
    const account = document.getElementById('account')
    const password = document.getElementById('password')
    if (btn.innerText == "Cambiar contraseña") {
        btn.innerText = "Editar cuenta"
        account.style.display = 'none'
        password.style.display = 'grid'
    } else {
        btn.innerText = "Cambiar contraseña"
        password.style.display = 'none'
        account.style.display = 'grid'
    }
}

toggleForm = (btn) => {
    const login = $('#login')
    const singup = $('#singup')
    if (btn.innerText == "Registrarse") {
        btn.innerText = "Iniciar sesión"
        login.style.display = 'none'
        singup.style.display = 'grid'
    } else {
        btn.innerText = "Registrarse"
        singup.style.display = 'none'
        login.style.display = 'grid'
    }
}
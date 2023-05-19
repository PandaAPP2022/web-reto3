window.onload = () => {
    let btnHeader = document.getElementsByClassName('header-display')[0]
    btnHeader.addEventListener('click', displayMenu)
    let passButton = document.getElementById('passButton')
    passButton.addEventListener('click', updatePassword)
}
function displayMenu() {
    
    var img = 'assets/img/'
    let padding = 0;
    if (!this.src.includes('closemenu')) {
        img += 'closemenu.svg';
        padding = '5px';
    } else img += 'logo.png';

    this.src = img
    this.style.padding = padding

    const header = document.getElementsByClassName('header')[0]
    if (header.style.display != 'flex') {
        header.style.display = 'flex';
    } else {
        header.style.display = 'none';
    }
}

function logout() {
    document.getElementById('logout').click();
}

function updatePassword() {
    let passwd = prompt("Please enter your old password", "Cambio de contraseña");
    if (passwd != null) {
        document.getElementById('updatePassword').click();
        document.getElementById('oldPassword').value = passwd
    } else {
        alert('Tienes que introducir tu contraseña.');
    }
}

function toggleFormLogged(btn) {
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

function toggleForm(btn) {
    const login = document.getElementById('login')
    const singup = document.getElementById('singup')
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
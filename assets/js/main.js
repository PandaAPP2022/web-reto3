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

requestUsers = (data) => {
    $.post('assets/php/getUsers.php', { input: data }, function(response) {
        const jsonData = JSON.parse(response);
        if (jsonData.success == "1") loadUsers(jsonData.data);
    });
}

loadScores = () => {
    let list = $('.list');
    list.empty();

    $.post('assets/php/getScores.php' ,function (response) {
        const jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
            const data = jsonData.data;
            for (let i = 0; i < data.length; i++) {
                const user = data[i];
        
                list.append($('\
                <article class="list-item score">\
                    <div class="info">\
                        <h4>'+(i+1)+") "+ user['name']+" "+user['surname']+'</h4>\
                    </div>\
                    <div class="options">\
                        <p>'+user['score']+'</p>\
                        <p>'+user['fecha']+'</p>\
                    </div>\
                </article>'));
            }
        }
    });
}

loadUsers = (data) => {
    let list = $('.list');
    list.empty();
    for (let i = 0; i < data.length; i++) {
        const user = data[i];

        let del = "";
        if (user['tipo'] != "gerente") del = '<img onclick = "deleteUser('+user['id']+')" class= "icons" src = "https://img.icons8.com/fluency/240/delete-sign.png" alt = "delete-sign" />'

        list.append($('\
        <article class="list-item">\
            <div class="info">\
                <h3>'+ user['name']+" "+user['surname']+'</h3>\
                <p>'+user['mail']+'</p>\
                <span class="tipo">'+user['tipo']+'</span>\
            </div>\
            <div class="options">\
                <img onclick="loadUser('+user['id']+')" class="icons" src="https://img.icons8.com/external-febrian-hidayat-flat-febrian-hidayat/64/external-Edit-user-interface-febrian-hidayat-flat-febrian-hidayat.png" alt="external-Edit-user-interface-febrian-hidayat-flat-febrian-hidayat"/>\
                '+del+'\
            </div>\
        </article>'));
    }
}
loadUser = (id) => {
    let link = document.createElement('a')
    link.href = "user.php?id="+id
    $('main')[0].append(link);
    link.click();
}
deleteUser = (id) => {
    $('#btnDelete')[0].value = id;
    $('#btnDelete')[0].click();
}


logout = () => {
    $('#logout').click();
}

updatePassword = () => {
    let passwd = prompt("Please enter your old password", "Cambio de contraseña");
    if (passwd != null) {
        $('#oldPassword')[0].value = passwd
        let link = document.createElement('input')
        link.type = 'submit'
        link.name = "updatePassword"
        $('#passForm')[0].append(link);
        link.click();
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

deleteSelf = () => {
    if (!confirm("¿Estás seguro de que quieres eliminar tu cuenta?\nSe borrarán todos tus datos.")) return;
    let form = document.createElement('form')
    form.action = "assets/php/requests.php"
    form.method = 'post'

    let btn = document.createElement('input')
    btn.type = 'submit'
    btn.name = 'deleteUser'

    let self = document.createElement('input')
    self.type = 'hidden'
    self.name = 'deleteSelf'
    
    $('section')[0].append(form)
    form.append(btn)
    form.append(self)
    
    btn.click();
}
window.onload = () => {
    let btnHeader = $('.header-display')[0]
    btnHeader.addEventListener('click', displayMenu)
    let passButton = $('#passButton')[0]
    if (typeof (passButton) != 'undefined' && passButton != null) passButton.addEventListener('click', updatePassword);
    currentPage()
}

currentPage = () => {
    const url = window.location.href
    const header = $('.headerContainer')[0].children
    for (const btn of header) {
        if (url.includes(btn.firstChild.href)) btn.classList.add('currentPage');
    }
    $('#login').fadeIn(1000);
    $('#account').fadeIn(1000);
    notify();
}

notify = () => {
    const msg = window.location.hash.slice(1);
    if (msg == 'actualizado') alertify.success('Usuario actualizado con éxito.');
    else if (msg == 'cerrado') alertify.success('Sesión cerrada con éxito.');
    else if (msg == 'datosIncorrectos') alertify.error('Datos incorrectos. ¿Ha escrito su información correctamente?');
    else if (msg == 'passNeedsNum') alertify.error('La contraseña debe contener mínimo 1 número, pruebe de nuevo.');
    else if (msg == 'oldPassError') alertify.error('La contraseña anterior no es la correcta, prueba de nuevo.');
    else if (msg == 'contrasenasNoIguales') alertify.error('Las contraseñas no son iguales, prueba de nuevo.');
    else if (msg == 'usuarioCreado') alertify.success('Usuario creado correctamente.');
    else if (msg == 'errorActualizando') alertify.error('No se pudo actualizar el usuario, pruebe de nuevo en un rato o contacte al administrador.');
    else if (msg == 'eliminado') alertify.success('Usuario eliminado con éxito.');
    else if (msg == 'noEliminado') alertify.error('No se pudo eliminar el usuario, pruebe de nuevo en un rato o contacte al administrador.');
    else if (msg == 'noIniciado') alertify.error('No se ha iniciado sesión o la sesión ha caducado.');
    else if (msg == 'actualizada') alertify.success('Pregunta actualizada con éxito.');
}

function displayMenu() {
    
    if (this.src.includes('logo')) this.src = 'assets/img/closemenu.png';
    else this.src = 'assets/img/logo.png';

    const header = $('.header')[0]
    if (header.style.display != 'flex') {
        $('.header').fadeIn(1000)
        header.style.display = 'flex';
    } else {
        $('.header').fadeOut(1000)
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

    list.fadeIn(1000);

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
                    <div class="options" style="padding: 10px;">\
                        <p>'+user['score']+'</p>\
                        <p>'+user['fecha']+'</p>\
                    </div>\
                </article>'));
            }
        }
    });
}

loadUsers = (data) => {
    let aside = $('aside');
    let list = $('.list');
    list.empty();

    aside.fadeIn(1000);
    list.fadeIn(1000);

    aside[0].style.display = 'grid';
    list[0].style.display = 'grid';

    list.append($('\
        <article class="list-item"><div class="info">\
                <img onclick="loadUser()" class="add-icon" src="https://img.icons8.com/stickers/100/plus-math.png" alt="plus-math"/>    \
        </div></article>'));

    for (let i = 0; i < data.length; i++) {
        const user = data[i];

        let del = "";
        if (user['tipo'] != "gerente") del = '<img data-name="'+user['mail']+'" data-user="'+user['id']+'" onclick = "deleteUser(this.dataset)" class= "icons" src = "https://img.icons8.com/fluency/240/delete-sign.png" alt = "delete-sign" />'

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
    if (id == undefined) link.href = "user.php"
    else link.href = "user.php?id="+id
    $('main')[0].append(link);
    link.click();
}
deleteUser = (data) => {
    alertify.confirm('Eliminar usuario',"¿Estás seguro de que quieres eliminar al usuario "+data.name,
    () => {
        $('#btnDelete')[0].value = data.user;
        $('#btnDelete')[0].click()
    },
    () => {
        alertify.error('Operación cancelada');
        return
    });
}


logout = () => {
    $('#logout').click();
}

updatePassword = () => {
    const pass1 = $('#pass1')[0].value
    const pass2 = $('#pass2')[0].value
    if (!pass1 || !pass2 ) return
    if (pass1 != pass2) {
        alertify.error('Las contraseñas no son iguales, prueba de nuevo.');
        return
    }

    if (!/[0-9]/.test(pass1)) {
        alertify.error('Las contraseña debe contener por lo menos 1 número, prueba de nuevo.');
        return
    };

    alertify.prompt(
        "Cambio de contraseña",
        "Introduzca su antigua contraseña para confirmar el cambio a la nueva.", "",
        (evt, passwd) => {
            $('#oldPassword')[0].value = passwd
            let link = document.createElement('input')
            link.type = 'submit'
            link.name = "updatePassword"
            $('#passForm')[0].append(link);
            link.click();
        },
        () => alertify.error('Operación cancelada.')
    );
}

toggleFormLogged = (btn) => {
    const account = $('#account')[0]
    const password = $('#password')[0]
    if (btn.innerText == "Cambiar contraseña") {
        btn.innerText = "Editar cuenta"
        account.style.display = 'none'
        $('#password').fadeIn(1500);
        password.style.display = 'grid'
    } else {
        btn.innerText = "Cambiar contraseña"
        password.style.display = 'none'
        $('#account').fadeIn(1500);
        account.style.display = 'grid'
    }
}

toggleForm = (btn) => {
    const login = $('#login')[0]
    const singup = $('#singup')[0]
    if (btn.innerText == "Registrarse") {
        btn.innerText = "Iniciar sesión"
        login.style.display = 'none'
        $('#singup').fadeIn(1500);
        singup.style.display = 'grid'
    } else {
        btn.innerText = "Registrarse"
        singup.style.display = 'none'
        $('#login').fadeIn(1500);
        login.style.display = 'grid'
    }
}

deleteSelf = () => {
    alertify.confirm("¿Estás seguro de que quieres eliminar tu cuenta? Se borrarán todos tus datos.",
    () => {
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
    },
    () => {
        alertify.error('Operación cancelada');
        return
    });
}
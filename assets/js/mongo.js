loadQuestionPage = (id) => {
    let link = document.createElement('a')
    if (id == undefined) link.href = "question.php"
    else link.href = "question.php#"+id
    $('main')[0].append(link);
    link.click();
}

loadQuestion = (id) => {
    $.get('http://192.168.0.180:8081/api/pregunta/'+id, function(response) {
        loadQuestions(response.pregunta);
    });
}

send = () => {
    const form = document.getElementById('form')
    let submit = document.createElement('input')
    submit.type = 'submit'
    submit.name = 'submit'
    form.append(submit)

    submit.click();
}

window.onload = () => {
    let url = window.location
    if (url.href.includes("question.php")) {
        let id = url.hash.slice(1);
        $.get('http://192.168.0.180:8081/api/pregunta/'+id, function(response) {
            const pregunta = response.pregunta[0]
            const respuesta = response.respuesta[0]
            $('#pregunta')[0].value = pregunta.pregunta
            $('#explicacion')[0].value = pregunta.explicacion
            $('#categoria')[0].value = pregunta.categoria
            $('#dificultad')[0].value = pregunta.dificultad

            $('#nuevaImagen').on("change", function(img){ uploadFile(); });
            
            if (pregunta.imagen != 'Insertar imagen') $('#imagen')[0].src = pregunta.imagen

            $('#res1')[0].value = respuesta.respuesta[0]
            $('#res2')[0].value = respuesta.respuesta[1]
            $('#res3')[0].value = respuesta.respuesta[2]
            $('#res4')[0].value = respuesta.respuesta[3]
        });

    } else {
        $.get('http://192.168.0.180:8081/api/todo', function(response) {
            console.log(response.pregunta);
            loadQuestions(response.pregunta);
        });
    }
}


loadQuestions = (data) => {
    let list = $('.list');
    list.empty();

    list.append($('\
        <article class="list-item"><div class="info">\
            <img onclick="loadQuestionPage()" class="add-icon" src="https://img.icons8.com/stickers/100/plus-math.png" alt="plus-math"/>    \
        </div></article>'));

    for (let i = 0; i < data.length; i++) {
        const question = data[i];

        let del = '<img data-id="'+question['id']+'" onclick = "deleteUser(this.dataset)" class= "icons" src = "https://img.icons8.com/fluency/240/delete-sign.png" alt = "delete-sign" />'

        list.append($('\
        <article class="list-item">\
            <div class="info">\
                <h3>'+ question['pregunta']+'</h3>\
                <p>'+question['categoria']+'</p>\
                <span class="tipo">'+question['dificultad']+'</span>\
            </div>\
            <div class="options">\
                <img onclick="loadQuestionPage('+question['id']+')" class="icons" src="https://img.icons8.com/external-febrian-hidayat-flat-febrian-hidayat/64/external-Edit-user-interface-febrian-hidayat-flat-febrian-hidayat.png" alt="external-Edit-user-interface-febrian-hidayat-flat-febrian-hidayat"/>\
                '+del+'\
            </div>\
        </article>'));
    }
}
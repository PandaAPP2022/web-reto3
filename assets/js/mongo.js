var id;
window.onload = () => {
    currentPage()
    let url = window.location
    if (url.href.includes("question.php")) {
        
        id = url.hash.slice(1);
        $('#nuevaImagen')[0].dataset.id = id;
        $('#nuevaImagen').on("change", () => uploadImage );

        $.get('http://192.168.0.180:8081/api/pregunta/'+id, function(response) {
            const pregunta = response.pregunta[0]
            const respuesta = response.respuesta[0]
            
            $('#pregunta')[0].value = pregunta.pregunta
            $('#explicacion')[0].value = pregunta.explicacion
            $('#categoria')[0].value = pregunta.categoria
            $('#dificultad')[0].value = pregunta.dificultad

            $('#image')[0].src = pregunta.imagen

            $('.res')[0].value = respuesta.respuesta[0]
            $('.res')[1].value = respuesta.respuesta[1]
            $('.res')[2].value = respuesta.respuesta[2]
            $('.res')[3].value = respuesta.respuesta[3]
            $('#correcta')[0].value = respuesta.RespCorrecta
        });

    } else $.get('http://192.168.0.180:8081/api/preguntas', (response) => loadQuestions(response));
}
toggle = () => {
    const form_data = new FormData();
    form_data.append('id',  $('#nuevaImagen')[0].dataset.id);
    $.ajax({
        url: 'assets/php/clean.php', dataType: 'text', cache: false, contentType: false, processData: false,
        data: form_data, type: 'post',
        success: function (response) {
            let link = document.createElement('a')
            link.href = "questions.php"
            $('#account').append(link)
            link.click()
        },
        error: (response) => {
            let link = document.createElement('a')
            link.href = "questions.php"
            $('#account').append(link)
            link.click()
            console.log(response)
        }
    });

}

// CARGAR PÁGINA DE LA PREGUNTA
loadQuestionPage = (id) => {
    let link = document.createElement('a')

    if (id == null) {
        $.get('http://192.168.0.180:8081/api/idAlto', (response) => {
            createQuestion();
            link.href = "question.php#"+(response.index + 1)
            $('main')[0].append(link);
            link.click();
        });
    } else {
        link.href = "question.php#"+id
        $('main')[0].append(link);
        link.click();
    }
}
// INSERTAR PREGUNTA
updateQuestion = () => {
    var data = {
        "pregunta": $('#pregunta')[0].value,
        "explicacion": $('#explicacion')[0].value,
        "imagen": $('#image')[0].src,
        "dificultad": $('#dificultad')[0].value,
        "categoria": $('#categoria')[0].value,
        "respuesta": [
            $('.res')[0].value,
            $('.res')[1].value,
            $('.res')[2].value,
            $('.res')[3].value
        ],
        "RespCorrecta": $('#correcta')[0].value
    }
    var enabled = true;

    Object.keys(data).forEach(function(key,index) {
        var value = data[key];

        if (key == "respuesta") {
            for (let i = 0; i < data[key].length; i++) {
                value = data[key][i];
                if (value == "" || value == null || value == undefined) enabled = false
            }
        } else {
            if (value == "" || value == null || value == undefined) enabled = false
        }
    });

    if ($('#dificultad')[0].value < 1 || $('#dificultad')[0].value > 3) {
        alertify.error('La dificultad debe ser entre 1 y 3.')
        return
    }
    if ($('#correcta')[0].value < 1 || $('#correcta')[0].value > 4) {
        alertify.error('La respuesta correcta debe ser entre 1 y 4.')
        return
    }

    if (!enabled) {
        alertify.error('Faltan datos por rellenar, por favor rellena todos los campos.')
        return
    }

    let img = $('#nuevaImagen')[0]
    const form_data = new FormData();
    form_data.append('fileToUpload', $('#nuevaImagen').prop('files')[0]);
    form_data.append('id', img.dataset.id);

    console.log($('#nuevaImagen').prop('files')[0]);
    if ($('#nuevaImagen').prop('files')[0] == undefined) {
        $.ajax({
            url: 'http://192.168.0.180:8081/api/actualizar/'+id,
            data: data,
            cache: false, processData: true, type: 'PUT',
            success: function(response){
                let a = document.createElement('a')
                a.href = 'questions.php#actualizada'
                document.getElementById('quest').append(a)
                a.click()
            },
            error: (response) => console.log(response)
        });
    }
    else {
        $.ajax({
            url: 'assets/php/upload.php', dataType: 'text', cache: false, contentType: false, processData: false,
            data: form_data, type: 'post',
            success: function (response) {
                const jsonData = JSON.parse(response);
                document.getElementById('image').src = 'assets/images/'+jsonData.name
                data.imagen = document.getElementById('image').src
                $.ajax({
                    url: 'http://192.168.0.180:8081/api/actualizar/'+id,
                    data: data,
                    cache: false, processData: true, type: 'PUT',
                    success: function(response){
                        let a = document.createElement('a')
                        a.href = 'questions.php#actualizada'
                        document.getElementById('quest').append(a)
                        a.click()
                    },
                    error: (response) => console.log(response)
                });
            },
            error: (response) => console.log(response)
        });
    }
}

createQuestion = () => {
    const data = {
        "pregunta": "",
        "explicacion":"",
        "imagen":"assets/images/default.png",
        "dificultad":1,
        "categoria":"esp",
        "respuesta":[
            "",
            "",
            "",
            ""
        ],
        "RespCorrecta":1
    };

    $.post('http://192.168.0.180:8081/api/insertar/', data, (response) => {
        $.get('http://192.168.0.180:8081/api/preguntas', (response) => loadQuestions(response));
    })
}
deleteQuestion = (id) => {
    $.ajax({
        url: 'http://192.168.0.180:8081/api/borrar/'+id, dataType: 'text', cache: false, contentType: false, processData: false, type: 'DELETE',
        success: function(response){
            console.log(response)
            $.get('http://192.168.0.180:8081/api/preguntas', (response) => {
                alertify.success('Pregunta eliminada correctamente.');
                loadQuestions(response)
            });
        },
        error: (response) => console.log(response)
    });
}

// SUBIR LA NUEVA IMAGEN
uploadImage = (img) => {

    const form_data = new FormData();
    form_data.append('fileToUpload', $('#nuevaImagen').prop('files')[0]);
    form_data.append('tmp', img.dataset.id);
  
    $.ajax({
        url: 'assets/php/upload.php', dataType: 'text', cache: false, contentType: false, processData: false,
        data: form_data, type: 'post',
        success: function(response) {
            const jsonData = JSON.parse(response);
            if ('name' in jsonData) document.getElementById('image').src = 'assets/images/'+jsonData.name
            else console.log(jsonData);
        },
        error: (response) => console.log(response)
    });
}

// CARGAR LA PREGUNTA/PREGUNTAS DADAS
loadQuestions = (data) => {
    const list = $('.list');
    list.empty();

    list.fadeOut();
    list.fadeIn(1000);

    list.append($('\
        <article class="list-item"><div class="info">\
            <img onclick="loadQuestionPage(null)" class="add-icon" src="https://img.icons8.com/stickers/100/plus-math.png" alt="plus-math"/>    \
        </div></article>'));

    for (let i = 0; i < data.length; i++) {
        const question = data[i];

        let del = '<img onclick = "deleteQuestion('+question['id']+')" class= "icons" src = "https://img.icons8.com/fluency/240/delete-sign.png" alt = "delete-sign" />'

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
let drop_ = document.querySelector('.area-upload #upload-file');
drop_.addEventListener('dragenter', function() {
    document.querySelector('.area-upload .label-upload').classList.add('highlight');
});
drop_.addEventListener('dragleave', function() {
    document.querySelector('.area-upload .label-upload').classList.remove('highlight');
});
drop_.addEventListener('drop', function() {
    document.querySelector('.area-upload .label-upload').classList.remove('highlight');
});

document.querySelector('#upload-file').addEventListener('change', function() {
    var files = this.files;
    for (var i = 0; i < files.length; i++) {
        var info = validarArquivo(files[i]);

        /* Criar o conteudo da barra */
        var barra = document.createElement("div");
        var fill = document.createElement("div");
        var text = document.createElement("div");

        /* Cria o botão de excluir foto */
        var removeButton = document.createElement('a');
        var removeIcon = document.createElement('i');
        removeIcon.classList.add('fa', 'fa-close', 'text-danger');

        removeButton.href = 'javascript:void(0)';
        removeButton.setAttribute('onClick', `removeFile('${files[i].name}')`);
        removeButton.setAttribute('data-toggle', 'tooltip');
        removeButton.setAttribute('data-placement', 'top');
        removeButton.setAttribute('title', 'Remover imagem');
        removeButton.style.marginRight = '10px';
        removeButton.appendChild(removeIcon);

        /* Monta a barra de arquivo */
        barra.appendChild(fill);
        barra.appendChild(text);
        barra.appendChild(removeButton);

        barra.classList.add("barra");
        fill.classList.add("fill");
        text.classList.add("text");

        if (info.error == undefined) {
            text.innerHTML = info.success;
            // enviarArquivo(i, barra); //Enviar
        } else {
            text.innerHTML = info.error;
            barra.classList.add("error");
        }

        //Adicionar barra
        document.querySelector('.lista-uploads').appendChild(barra);
    };
});

function validarArquivo(file) {
    // Tipos permitidos
    var mime_types = ['image/jpeg', 'image/png'];

    // Validar os tipos
    if (mime_types.indexOf(file.type) == -1) {
        return { "error": "O arquivo " + file.name + " não permitido" };
    }

    // Apenas 2MB é permitido
    if (file.size > 5 * 1024 * 1024) {
        return { "error": file.name + " ultrapassou limite de 2MB" };
    }

    // Se der tudo certo
    return { "success": "Arquivo: " + file.name };
}

function removeFile(fileName) {
    const filesSelected = document.getElementById('upload-file').files;

    /* Cria um buffer com todos os arquivos, exceto o que deseja remover */
    let indexToRemove = -1;
    const fileBuffer = new DataTransfer();
    for (let fileIndex = 0; fileIndex < filesSelected.length; fileIndex++) {
        if (filesSelected[fileIndex].name === fileName) {
            indexToRemove = fileIndex;
            continue;
        }
        fileBuffer.items.add(filesSelected[fileIndex]);
    }

    /* Adiciona a nova lista ao input e remove a barra visualmente */
    document.getElementById('upload-file').files = fileBuffer.files;
    indexToRemove > -1 && document.querySelectorAll('.lista-uploads > div')[indexToRemove].remove();
}
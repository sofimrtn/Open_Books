class ClienteServicio {

    obtenerRatings(isbn) {
        $.getJSON(
            'https://openlibrary.org/api/books?bibkeys=ISBN:' + isbn + '&jscmd=data&format=json',
            this.procesarResultado.bind(this));
    }

    procesarResultado(resultado) {
        var info = Object.values(resultado)[0];
        $('#titulo-popup').text(info.title);
        if(info.subtitle==null){
            $('#subtitulo-popup').text(' ');
        }else{
            $('#subtitulo-popup').text(info.subtitle);
        }
        $('#date-popup').text(info.publish_date);
        var authors = info.authors
            .map(p => p.name)
            .join(',');
        $('#author-popup').text(authors);
        var editoriales = info.publishers
            .map(p => p.name)
            .join(',');
        $('#editorial-popup').text(editoriales);
        var subjects = info.subjects;
        if(subjects==null){
            $('#subject-popup').text('not specified');
        }else{
            subjects=info.subjects.map(p => p.name)
                .join(', ');
            $('#subject-popup').text(subjects);
        }
        if(info.number_of_pages==null){
            $('#pages-popup').text('not specified');
        }else{
            $('#pages-popup').text(info.number_of_pages);
        }
        $('#link-info-popup').attr("href", info.url);
        $('#popup-info-libro').slideDown();
        console.log(resultado);
    }
}

clienteServicio = new ClienteServicio();





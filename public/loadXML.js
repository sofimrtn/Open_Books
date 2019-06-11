"use strict";

class FileXML {
    constructor(name){
        this.nombre = name;
    }
    loadData(){
        $.ajax({
            dataType: "xml",
            url: this.nombre,
            method: 'GET',
            success: function(data){
                var title;
                var name;
                var surname;
                var year;
                var editorial;
                var isbn;
                var rating;
                var description;

                var books = '';
                // son los nodos del DOM de XML
                $('libro', data).each(function () {
                    title = $('titulo', this).text();

                    var authors = '';
                    $('autor', this).each(function () {
                        name = $('nombre',this).text();
                        surname = $('apellidos',this).text();
                        authors += '<h4>' + name + ' ' + surname + '</h4>';
                    });
                    year = $('año',this).text();
                    editorial = $('editorial',this).text();
                    $('edicion', this).each(function () {
                       if($('formato',this).text() === "Hardcover"){
                           $('idioma',this).each(function () {
                              $('isbn',this).each(function () {
                                 isbn = $('isbn13',this).text();
                              });
                           });
                       }
                    });
                    rating = $('puntuacion',this).text();
                    description = $('sinopsis',this).text();
                    books +=
                        '<section class="book" draggable="true">' +
                            '<h2>' + title + '</h2>' +
                            authors +
                            '<p>Publishers: ' + editorial + '</p>' +
                            '<p>Year published: ' + year + '</p>' +
                            '<p>Overall Rating: ' + rating + ' ⭐ </p>' +
                            '<p>Description: ' + description + '</p><i class="fas fa-heart"></i>' +
                            '<p>ISBN: ' + isbn + '</p>' +
                        '</section>';
                });
                $("section").html(books);
                $("article.book").on('dragstart', function () {
                    operationDragAndDropCurrent = new OperationDragAndDrop(this);
                });
            },
            error:function(){
                $("h3").html("Could not load XML file");
                $("article").remove();
            }
        });
    }
    printXML(){
        this.loadData();
        $("button").attr("disabled","disabled");
    }
}
var loadedBooks = new FileXML("public/books.xml");

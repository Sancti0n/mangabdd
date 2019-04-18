$(document).ready(function () {
    $("#form").submit(function (e) {
        e.preventDefault();

        var search = $("#livres").val();
        if (search === '') {
            var searchEmpty = $('<h5>Vous devez écrire dans ce champ</h5>');
            searchEmpty.appendTo('#result');
        }
        else {
            var url, img, title, author, isbn13, isbn10, pageCount, publishedDate, lang, publisher, price, ebook;
    
            $.get("https://www.googleapis.com/books/v1/volumes?q=" + search, function (response) {
                for (var i = 0; i < 6; i+=1) {
                    title = $('<p>' + response.items[i].volumeInfo.title + '</p>');
                    author = $('<p>' + response.items[i].volumeInfo.authors + '</p>');
                    ebook = $('<h5>Ebook : ' + response.items[i].saleInfo.isEbook + '</h5>');
                    isbn13 = $('<h5>' + response.items[i].volumeInfo.industryIdentifiers[0].identifier + '</h5>');
                    if (typeof response.items[i].volumeInfo.industryIdentifiers[1] !== 'undefined') {
                        isbn10 = $('<h5>'+ response.items[i].volumeInfo.industryIdentifiers[1].identifier + '</h5>');
                    }
                    else {
                        isbn10 = "undefined";
                    }
                    pageCount = $('<h5>' + response.items[i].volumeInfo.pageCount + '</h5>');
                    publishedDate = $('<h5>'+ response.items[i].volumeInfo.publishedDate + '</h5>');
                    lang = $('<h5>' + response.items[i].volumeInfo.language + '</h5>');
                    publisher = $('<h5>' + response.items[i].volumeInfo.publisher + '</h5>');
                    if (typeof response.items[i].saleInfo.listPrice !== 'undefined') {
                        price = $('<h5>' + response.items[i].saleInfo.listPrice.amount + ' €</h5>');
                    }
                    else {
                        price = "undefined";
                    }
                    
                    img = $('<img><a href=' + response.items[i].volumeInfo.infoLink + '></div>');
                    if (typeof response.items[i].volumeInfo.imageLinks !== 'undefined') {
                        url=response.items[i].volumeInfo.imageLinks.thumbnail;
                    }
                    else {
                        url = "undefined";
                    }
                    
                    img.attr('src',url);
                    title.appendTo("#result");
                    author.appendTo("#result");
                    ebook.appendTo("#result");
                    isbn13.appendTo("#result");
                    if (isbn10 !== "undefined") {
                        isbn10.appendTo("#result");
                    }
                    pageCount.appendTo("#result");
                    publishedDate.appendTo("#result");
                    lang.appendTo("#result");
                    publisher.appendTo("#result");
                    if (price !== "undefined") {
                        price.appendTo("#result");
                    }
                    
                    img.appendTo("#result");
                }
            });
        }
    });
return false;
});
$(document).ready(function () {
    $("#form").submit(function (e) {
        e.preventDefault();

        var search = $("#livres").val();
        if (search === "") {
            $("#livres").attr("placeholder", "Écrivez ici !");
        }
        else {
            var url, img, title, author, isbn13, isbn10, pageCount, publishedDate, lang, publisher, price, ebook;

            $.ajax({
                url: "https://www.googleapis.com/books/v1/volumes?q=" + search, 
                success: function (response) {
                    // Le maximum est 10
                    for (var i = 0; i < 6; i+=1) {
                        title = response.items[i].volumeInfo.title;
                        author = response.items[i].volumeInfo.authors;
                        ebook = response.items[i].saleInfo.isEbook;
                        isbn13 = response.items[i].volumeInfo.industryIdentifiers[0].identifier;
                        if (typeof response.items[i].volumeInfo.industryIdentifiers[1] !== "undefined") {
                            isbn10 = response.items[i].volumeInfo.industryIdentifiers[1].identifier;
                        }
                        else {
                            isbn10 = "undefined";
                        }
                        pageCount = response.items[i].volumeInfo.pageCount;
                        publishedDate = response.items[i].volumeInfo.publishedDate;
                        lang = response.items[i].volumeInfo.language;
                        publisher = response.items[i].volumeInfo.publisher;
                        if (typeof response.items[i].saleInfo.listPrice !== "undefined") {
                            price = response.items[i].saleInfo.listPrice.amount;
                        }
                        else {
                            price = "undefined";
                        }
                        img = $("<img><a href="+response.items[i].volumeInfo.infoLink+">");
                        if (typeof response.items[i].volumeInfo.imageLinks !== "undefined") {
                            url=response.items[i].volumeInfo.imageLinks.thumbnail;
                        }
                        else {
                            url = "undefined";
                        }
                    
                        $("#result"+i).removeClass("d-none").addClass("d-block");
                        img.attr("src",url);
                        $("<p>Titre : "+title+"</p>").appendTo("#result"+i);
                        $("<p>Auteur : "+author+"</p>").appendTo("#result"+i);
                        $("<p>Ebook : "+ebook+"</p>").appendTo("#result"+i);
                        $("<p>"+isbn13+"</p>").appendTo("#result"+i);
                        if (isbn10 !== "undefined") {
                            $("<p>"+isbn10+"</p>").appendTo("#result"+i);
                        }
                        $("<p>Pages : "+pageCount+"</p>").appendTo("#result"+i);
                        $("<p>"+publishedDate+"</p>").appendTo("#result"+i);
                        $("<p>"+lang+"</p>").appendTo("#result"+i);
                        $("<p>"+publisher+"</p>").appendTo("#result"+i);
                        if (price !== "undefined") {
                            $("<p>"+price+"</p>").appendTo("#result"+i);
                        }
                        img.appendTo("#result"+i);
                    }
                },
                error: function(){
                    $("#livres").val("API Indisponible ! Réessayez plus tard !");
                }
            });
        }
    });
return false;
});
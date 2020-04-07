
function initPage_onDomContentLoaded() {
    var page = document.querySelector("[data-page]").getAttribute('data-page');
    
    route(page)
}

function route(page) {

    switch(page){
        
        case 'page-post':
            search();
        break;
    }
}

function search() {
    
    document.querySelector("#form-search").addEventListener('submit', function(e) {
            e.preventDefault();
        var search = document.querySelector("#search").value;

        if(search.trim()=="") {
            var element = document.createElement("span");
            var content = document.createTextNode('El campo no puede estar vacio');
            element.appendChild(content);
            var div = document.querySelector("#div1");
            div.appendChild(element);
            return;
        }

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        e.preventDefault();
        fetch("search", {
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json, text-plain, */*",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-TOKEN": token
             },
            method: 'post',
            credentials: "same-origin",
            body: JSON.stringify({
              name: search
             
            })
           })
            .then(function(response) {
                if(response.ok) {
                    return response.json()
                } else {
                    throw "Error en la llamada Ajax";
                }
            
            })
            .then(function(response) {

                    console.log(response.search);
                    if(response.search.length!=0) {
                        document.querySelector("#div1").innerHTML="";
                        showQuerySearch(response.search);
                    }else{
                        failedQuerySearch();
                    }

            })
            .catch(function(err) {
                console.log(err);
            });
              
    });

   
}

function failedQuerySearch() {

    var section = document.querySelector("section");

    section.innerHTML = `<p>No se ha encontrado la pelicula</p>`;
}

function showQuerySearch(searchPost) {


    var section = document.querySelector("section");

    //Borrar todos los elementos hijos de la seccion articulos
    while(section.firstChild) {
        section.removeChild(section.firstChild);
    }

    var resultSearch = "";

    for(i=0; i<searchPost.length;i++) {
        resultSearch+=
        `<article class="padding-80px-bottom">
        <img src="images/${searchPost[i].image}" alt="">
        <div>
        <h1>${searchPost[i].title}</h1>
        <p>Genero : ${searchPost[i].name_category}</p>
        <p>${searchPost[i].body.substring(0,400)}...</p>
    
        <p>Posteado por: ${searchPost[i].name_user}</p>
        
        <a class="btn-read" href="http://www.blog-final.com.devel/detailPost/${searchPost[i].id}">Continuar Leyendo</a>
        </div>
        </article>`
    }

    section.innerHTML=resultSearch;



  
    
    
    
} 


window.addEventListener('DOMContentLoaded', initPage_onDomContentLoaded);
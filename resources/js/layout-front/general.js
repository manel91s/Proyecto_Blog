
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
        
        var search = document.querySelector("#search").value;
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
                    if(response) {
                        showQuerySearch(response.search);
                    }

            })
            .catch(function(err) {
                console.log(err);
            });
              
    });

   
}

function showQuerySearch(searchPost) {


    var section = document.querySelector("section");

    //Borrar todos los elementos hijos de la seccion articulos
    while(section.firstChild) {
        section.removeChild(section.firstChild);
    }

    var resultSearch;

    for(i=0; i<searchPost.length;i++) {
        resultSearch+=
        `<article class="padding-80px-bottom">
        <img src="images/${searchPost[i].image}" alt="">
        <div>
        <h1>${searchPost[i].title}</h1>
        <p>Genero : ${searchPost[i].name_category}</p>
        <p>substr(${searchPost[i].body},0,400)...</p>
    
        <p>Posteado por: ${searchPost[i].name_user}</p>
        
        <a class="btn-read" href="{{route('detail.post',${searchPost[i].id}}}">Continuar Leyendo</a>
        </div>
        </article>`
    }

    section.innerHTML=resultSearch;



  
    
    
    
} 


window.addEventListener('DOMContentLoaded', initPage_onDomContentLoaded);
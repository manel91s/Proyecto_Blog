
function initPage_onDomContentLoaded() {
    var page = document.querySelector("[data-page]").getAttribute('data-page');
    route(page)

    document.querySelector("#form-searchxs").addEventListener('submit',eventFormxs);
   
    
}

function eventFormxs(event) {
    event.preventDefault();
    var btnsearchxs = document.querySelector("#searchxs").value;
    if(btnsearchxs.trim()=="") {
        var element = document.createElement("span");
        var content = document.createTextNode('El campo no puede estar vacio');
        element.appendChild(content);
        var div = document.querySelector("#div2");
        div.appendChild(element);
        return;
    }
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch("/search", {
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": token
         },
        method: 'POST',
        credentials: "same-origin",
        body: JSON.stringify({
          name: btnsearchxs
         
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
                document.querySelector("#div2").innerHTML="";
                console.log(response.search);
                if(response.search.length!=0) {
                  
                    showQuerySearch(response.search);
                }else{
                    failedQuerySearch();
                }

        })
        .catch(function(err) {
            console.log(err);
        });
    
    
}

 window.onload=function() {

    var menu = false; 

    document.querySelector("#hamburguesa").addEventListener("click",menuBarra)    
    //activar un listener para detectar el cambio de resolucion horizontal del objeto window
    window.addEventListener("resize",ocultarMenu)

    function ocultarMenu() {
        //Solo se ocultara cuando el ancho de la ventana del navegador supere el limite de la mediaquery
        if(window.innerWidth >=800) {
          document.querySelector("nav").style.left="-130px"
          menu=false;
          
        }
      }
    
      function menuBarra() {
    
        if(menu==false) {
          //si menu oculto lo mostramos
          document.querySelector("nav").style.left="0px"
          menu=true;
    
        }else{
          //si menu visible lo ocultamos
          document.querySelector("nav").style.left="-130px"
          menu=false;
        }
}
 }

window.addEventListener('DOMContentLoaded', initPage_onDomContentLoaded);

function route(page) {

    switch(page){
        

        case 'page-user':
            search();
            break

        case 'page-post':

            search();
             break;
        case 'page-post-managament':
            managamentPost();
            break;
        
        case 'page-category':
            searchCategory();
            break;
    }
}


function search(xsearch) {
    
    document.querySelector("#form-search").addEventListener('submit', function(e) {
            e.preventDefault();

            var btnsearch = document.querySelector("#search").value;
            
            
            
        if(btnsearch.trim()=="") {
            var element = document.createElement("span");
            var content = document.createTextNode('El campo no puede estar vacio');
            element.appendChild(content);
            var div = document.querySelector("#div1");
            div.appendChild(element);
            return;
        }

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        e.preventDefault();
        fetch("/search", {
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json, text-plain, */*",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-TOKEN": token
             },
            method: 'POST',
            credentials: "same-origin",
            body: JSON.stringify({
              name: btnsearch
             
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
                    document.querySelector("#div1").innerHTML="";
                    console.log(response.search);
                    if(response.search.length!=0) {
                      
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
        <img src="http://www.blog-final.com.devel/images/${searchPost[i].image}" alt="">
        <div>
        <h1>${searchPost[i].title}</h1>
        <p>Genero : <span class="text-bold">${searchPost[i].name_category}</span></p>
        <p>${searchPost[i].body.substring(0,400)}...</p>
    
        <p>Posteado por: <span class="text-bold">${searchPost[i].name_user}</span></p>
        
        <a class="btn-read" href="http://www.blog-final.com.devel/detailPost/${searchPost[i].id}">Continuar Leyendo</a>
        </div>
        </article>`
    }

    section.innerHTML=resultSearch;



  
    
    
    
} 



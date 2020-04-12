function searchCategory() {

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
                document.querySelector("#div1").innerHTML="";
                console.log(response.search);
                if(response.search.length!=0) {
                  
                    showQueryCategorySearch(response.search);
                }else{
                    failedQuerySearch();
                }

        })
        .catch(function(err) {
            console.log(err);
        });
          
});


}

function showQueryCategorySearch(searchPost) {

    var section = document.querySelector("section");

      //Borrar todos los elementos hijos de la seccion articulos
      while(section.firstChild) {
        section.removeChild(section.firstChild);
    }

    var resultSearch = "";
    for(i=0; i<searchPost.length; i++) {

        resultSearch+= 
                        `
                        <div class="container-movie">
                        <div>
                        <a href="http://www.blog-final.com.devel/detailPost/${searchPost[i].id}"><img src="http://www.blog-final.com.devel/imagesCover/${searchPost[i].image}" alt=""></a>
                        <p>${searchPost[i].title}</p>
                        
                        </div>
                        <div>`

    }
    
    section.innerHTML=resultSearch;

  

}
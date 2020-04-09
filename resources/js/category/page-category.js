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

function managamentPost() {

    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch("/queryPost", {
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": token
         },
        method: 'POST',
        credentials: "same-origin",
        body: JSON.stringify({
        
         
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
                console.log(response);
                showAllquery(response.allPosts.data)
               

        })
        .catch(function(err) {
            console.log(err);
        });
    
}


function showAllquery(posts) {

    console.log(posts);

    var table = `<tr><th>Titulo</th><th>Genero</th><th>Autor</th></tr>`;

     for(i in posts) {
        table+= `<tr>
                    <input class="post_id" type="hidden" value="${posts[i].id}">
                    <td>${posts[i].title}</td>
                    <td>${posts[i].name_category}</td>
                    <td>${posts[i].name_user}</td>
                    <td><a href="editPost/${posts[i].id}">Editar</a></td>
                    <td><img id="delete" name="${posts[i].id}" src="./images/delete.png" alt=""></td>
                 </tr>`
    }

    document.querySelector("#allPost").innerHTML=table;

    eventIdPost();

}

function eventIdPost() {

    var deletePost = document.querySelectorAll("#delete");
    
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');  

    for(i=0; i<deletePost.length; i++) {
     
        deletePost[i].addEventListener("click", function() {
        
            var tr = this.closest("tr");

            var id = this.name;
            fetch("/deletePosts", {
                headers: {
                  "Content-Type": "application/json",
                  "Accept": "application/json, text-plain, */*",
                  "X-Requested-With": "XMLHttpRequest",
                  "X-CSRF-TOKEN": token
                 },
                method: 'POST',
                credentials: "same-origin",
                body: JSON.stringify({

                idPost: id

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

                    tr.parentNode.removeChild(tr);
                    console.log(response);
        
                })
                .catch(function(err) {
                    console.log(err);
                });
  
       });
    }

}


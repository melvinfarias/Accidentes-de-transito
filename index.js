var categorias= document.getElementById("categorias");
var verCategorias= document.getElementById("verCategorias");
categorias.style.display= "none";
verCategorias.addEventListener("click", function(){
    
    if(categorias.style.display== "none"){
        categorias.style.display= "block";
    }
    else{
        categorias.style.display= "none"; 
    }
});


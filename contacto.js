const nombre = document.getElementById("form-nombre");
const mail = document.getElementById("form-mail");
const mensaje = document.getElementById("form-text");

const rojo = document.getElementById("semaforo-rojo");
const verde = document.getElementById("semaforo-verde");
const amarillo = document.getElementById("semaforo-amarillo");

rojo.style.opacity="0";
amarillo.style.opacity="0";
verde.style.opacity="0";


function aparecerLuces(){

    if (nombre.value && !mail.value && !mensaje.value){
        rojo.style.opacity="1";
    }
    else if (nombre.value && mail.value && !mensaje.value){
        amarillo.style.opacity="1";
    }
    else if (nombre.value && mail.value && mensaje.value){
        verde.style.opacity="1";
    }
    else if(!nombre.value){
        rojo.style.opacity="0";
        amarillo.style.opacity="0";
        verde.style.opacity="0";
    }  
    else if(!mail.value){
        rojo.style.opacity="0";
        amarillo.style.opacity="0";
        verde.style.opacity="0";
    } 
    else if(!mensaje.value){
        rojo.style.opacity="0";
        amarillo.style.opacity="0";
        verde.style.opacity="0";
    } 

} 

nombre.addEventListener("input", aparecerLuces);
mail.addEventListener("input", aparecerLuces);
mensaje.addEventListener("input", aparecerLuces);
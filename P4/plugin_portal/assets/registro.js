document.addEventListener("DOMContentLoaded", function () {
 if(document.querySelector("#upload") != null) {
  function mostrarFoto(file, imagen) {
    //carga la imágen de file en el elemento src imágen
    var reader = new FileReader();
    reader.addEventListener("load", function () {
     imagen.src = reader.result;
    });
    reader.readAsDataURL(file);
  }
  function validarExtension(fichero) {
     // Comprobar extensiones
     var extensiones = /(\.jpg|\.png|\.jpeg)$/i;
     return (extensiones.exec(fichero.name));  
  }
   function validarDimension(fichero) {
     // Comprobar que ocupa menos de 700KB
     return (fichero.size < 700000);  
   }
   function fotoModificar(rutaImagen) {
     var imagen = document.querySelector("#imagen_form");
     imagen.src = rutaImagen;
   }
   function ready() {
     var fichero = document.querySelector("#upload");
     var marco = document.querySelector("#foto_form");
     var imagen = document.querySelector("#imagen_form");

     //si es el formulario de modificar y tiene foto, mostrarla
     var oculto = document.querySelector("#oculto_nombre");
     var nombreImagen = oculto.getAttribute("value");
     if(nombreImagen != null && nombreImagen != '') {
        fotoModificar("../../wp-content/uploads/fotos_actividades/" + nombreImagen);
     }
 
     //escuchamos el evento de selección nuevo fichero.
     fichero.addEventListener("change", function (event) {
        // si habia saltado un error, borrar el mensaje
        var nodoError = document.getElementById("mensaje");
        if (nodoError != null) marco.removeChild(nodoError);
        
        // comprobar extension y dimension de la foto
        var extensionCorrecta = validarExtension(this.files[0]);
        var dimensionCorrecta = validarDimension(this.files[0]);
        if(extensionCorrecta && dimensionCorrecta) {
          mostrarFoto(this.files[0], imagen);
        } else {
          //hay un error en la foto
          var error = document.createElement('p');
          error.className = "aviso no-permitido";
          if (!extensionCorrecta) error.textContent = "Extensión no permitida.";
          else error.textContent = "Fichero demasiado grande.";
          marco.appendChild(error);
          imagen.src = '';
          fichero.value='';
          this.files[0]='';
        }
     });   
   }
   ready();
 }
});
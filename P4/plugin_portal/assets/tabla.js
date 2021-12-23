document.addEventListener("DOMContentLoaded", function () {
if(document.getElementById("personalizar") != null) {
  function cambiaColor(nuevoColor) {
    var list = document.getElementsByTagName("td");
    for(var i=0; i<list.length; i++)
    {
       list[i].style.color=nuevoColor;
    }
  }

  function muestraOculto() {
    document.getElementById("oculto").setAttribute('id', 'visible');
    var personalizar = document.getElementById("personalizar");
    personalizar.removeEventListener("click", muestraOculto);
    personalizar.addEventListener("click", ocultaElemento);
  }

  function ocultaElemento() {
    document.getElementById("visible").setAttribute('id', 'oculto');
    var personalizar = document.getElementById("personalizar");
    personalizar.removeEventListener("click", ocultaElemento);
    personalizar.addEventListener("click", muestraOculto);
  }

  document.getElementById("personalizar").addEventListener("click", muestraOculto);
  document.getElementById("rosa").addEventListener("click", function () { cambiaColor('#FBD9FF') });
  document.getElementById("azul").addEventListener("click", function () { cambiaColor('#A1FFF1') });
  document.getElementById("verde").addEventListener("click", function () { cambiaColor('#B1FFA1') });
  document.getElementById("naranja").addEventListener("click", function () { cambiaColor('#FFDEA1') });
  document.getElementById("blanco").addEventListener("click", function () { cambiaColor('#EEEEEE') });
}
});
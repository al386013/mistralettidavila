<script type="text/javascript" async="" defer="">
  function cambiaColor(nuevoColor) {
    var list = document.getElementsByTagName("td");
    for(var i=0; i<list.length; i++)
    {
       list[i].style.color=nuevoColor;
    }
  }

  function muestraOculto() {
    document.getElementById("oculto").setAttribute('id', 'visible');
    document.getElementById("personalizar").setAttribute('onclick', 'ocultaElemento()');
  }

  function ocultaElemento() {
    document.getElementById("visible").setAttribute('id', 'oculto');
    document.getElementById("personalizar").setAttribute('onclick', 'muestraOculto()');
  }
</script>
<script type="text/javascript" async="" defer="">
  document.addEventListener("DOMContentLoaded", function () {
    const FOTOS = [
      '../wp-content/uploads/2021/11/arco.jpg',
      '../wp-content/uploads/2021/11/atletismo.jpg',
      '../wp-content/uploads/2021/11/basquet.jpg',
      '../wp-content/uploads/2021/11/correr.jpg',
      '../wp-content/uploads/2021/11/tennis.jpg',
      '../wp-content/uploads/2021/11/padel.jpeg'
    ];
    const TIEMPO_MILISEG = 3000;
    let posActual = 0;
    let $botonAnterior = document.querySelector('#anterior');
    let $botonSiguiente = document.querySelector('#siguiente');
    let $foto = document.querySelector('#fotoCarrusel');
    let intervalo;

    function pasarFotoBoton() {
      fotoSiguiente();
      resetearIntervalo()
    }

    function fotoSiguiente() {
      if(posActual >= FOTOS.length - 1) posActual = 0;
      else posActual++;
      cargarFoto();
    }

    function retrocederFotoBoton() {
      fotoAnterior();
      resetearIntervalo()
    }

    function fotoAnterior() {
      if(posActual <= 0) posActual = FOTOS.length - 1;
      else posActual--;
      cargarFoto();
    }

    function cargarFoto () {
      $foto.src = FOTOS[posActual];
    }

    // Cuando se carga por primera vez o tras pasar con un boton, resetear el intervalo
    function resetearIntervalo() {
      clearInterval(intervalo);
      intervalo = setInterval(fotoSiguiente, TIEMPO_MILISEG); //llama a fotoSiguiente cada 3 segundos
    }

    // Eventos
    $botonSiguiente.addEventListener('click', pasarFotoBoton);
    $botonAnterior.addEventListener('click', retrocederFotoBoton);

    // Comenzar
    cargarFoto();
    resetearIntervalo();
  }); 

  function suelta(id) {
    document.getElementById(id).blur();
  }
</script>
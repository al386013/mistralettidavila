document.addEventListener("DOMContentLoaded", function () {
  if (document.querySelector('#fotoCarrusel') != null) {
    const FOTOS = [
      {url: '/wp-content/uploads/2021/11/arco.jpg', alt: 'Tiro al arco'},
      {url: '/wp-content/uploads/2021/11/atletismo.jpg', alt: 'Atletismo adaptado'},
      {url: '/wp-content/uploads/2021/11/basquet.jpg', alt: 'Basquet adaptado'},
      {url: '/wp-content/uploads/2021/11/correr.jpg', alt: 'Persona corriendo'},
      {url: '/wp-content/uploads/2021/11/tennis.jpg', alt: 'Tennis adaptado'},
      {url: '/wp-content/uploads/2021/11/padel.jpeg', alt: 'Equipo de padel adaptado'},
      {url: '/wp-content/uploads/2021/12/agua.webp', alt: 'Nadadora'}

    ];

    const TIEMPO_MILISEG = 3000;
    let posActual = 0;
    let $botonAnterior = document.querySelector('#anterior');
    let $botonSiguiente = document.querySelector('#siguiente');
    let $foto = document.querySelector('#fotoCarrusel');
    let intervalo = 0;

    function fotoSiguiente() {
      if(posActual >= FOTOS.length - 1) posActual = 0;
      else posActual++;
      cargarFoto();
    }

    function fotoAnterior() {
      if(posActual <= 0) posActual = FOTOS.length - 1;
      else posActual--;
      cargarFoto();
    }

    function cargarFoto () {
      clearTimeout(intervalo);
      $foto.src = FOTOS[posActual].url;
      $foto.alt = FOTOS[posActual].alt;
      cargarIntervalo();
    }

    // Cuando se carga por primera vez o tras pasar con un boton, resetear el intervalo
    function cargarIntervalo() {
      intervalo = setTimeout(fotoSiguiente, TIEMPO_MILISEG); //llama a fotoSiguiente cada 3 segundos
    }

    // Eventos
    $botonSiguiente.addEventListener('click', fotoSiguiente);
    $botonAnterior.addEventListener('click', fotoAnterior);

    // Comenzar
    cargarIntervalo();
  }
}); 

function suelta(id) {
  document.getElementById(id).blur();
}
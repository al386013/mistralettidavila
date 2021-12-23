<?php
/**
* @title: Canvas cuadrados
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

get_header();
?>

<div class="wrap">
  <div id="primary" class="content-area">
    <main id="main" class="site-main center" role="main">
      <h1>Juego en Canvas</h1>
      <ul id="lista">
        <li>Haz clic para dibujar cuadrados de medida aleatoria.</li>
        <li>Haz clic sobre un cuadrado para hacerlo rojo.</li>
      </ul>
      <canvas id="sketchpad" width="800" height="350"></canvas>
      <br><br>
      <button id="limpiar">Limpiar</button>
      <br><br>
     		  	
    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- .wrap -->

<script type="text/javascript" charset="utf-8">
  function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
      x: evt.clientX - rect.left,
      y: evt.clientY - rect.top
    };
  }
  function limpiar(context) {
    canvas = document.querySelector('#sketchpad');
    context = canvas.getContext("2d");
    context.clearRect(0, 0, canvas.width, canvas.height);
    cuadrados = [];
  }
  function dibujaEnRaton(context, coors) {
    // comprobar si se ha clicado un cuadrado
    var clic = false;
    var index = 0;
    cuadrados.forEach((cuadrado)=>{
      var color = cuadrado[0];
      var c = cuadrado[1];
      context.beginPath();
      context.rect(c[0], c[1], c[2], c[3]);
      //si el raton esta en el cuadrado
      if(context.isPointInPath(coors["x"], coors["y"])) {
        clic = true;
        // cambiar el color del cuadrado a rojo
        context.fillStyle = colorRojo;
        cuadrados[index][0] = colorRojo;
      } else {
        context.fillStyle = cuadrados[index][0];
      }
      context.fill();
      index += 1;
    });
    
    // si no se ha clicado un cuadrado, dibujar uno nuevo
    if(!clic) { 
      context.fillStyle = colorAzul;
      var lado = Math.random() * (151 - 10) + 10; //devuelve un numero aleatorio entre 10 y 150
      context.fillRect(coors.x, coors.y, lado, lado);
      cuadrados.push([colorAzul, [coors.x, coors.y, lado, lado]]);
    }
  }
  function ready() {
    var canvas = document.querySelector("#sketchpad");
    context = canvas.getContext('2d');
    canvas.addEventListener("click",function(evt){
      coors=getMousePos(canvas, evt);
      dibujaEnRaton(context, coors) ;
    });
    document.querySelector("#limpiar").addEventListener("click", function () {
      limpiar(context);
      document.querySelector("#limpiar").blur();
    });
  }
  var cuadrados = [];
  const colorRojo = "rgb(233,68,24)";
  const colorAzul = "rgb(175,176,255)";
  ready();
</script>

<?php
  get_footer();
?>
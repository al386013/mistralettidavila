document.addEventListener("DOMContentLoaded", function () {
  function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
      x: evt.clientX - rect.left,
      y: evt.clientY - rect.top
    };
  }
  function limpiar(context, canvas) {
    context.clearRect(0, 0, canvas.width, canvas.height);
    cuadrados = [];
  }
  function dibujaEnRaton(context, coors) {
    canvas = document.querySelector('#sketchpad');
    context.clearRect(0, 0, canvas.width, canvas.height);
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
    //borrar article
    var article = document.getElementsByTagName("article")[0];
    var padre = article.parentNode;
    padre.removeChild(article);
    //insertar juego
    padre.innerHTML = '<h1 class="page-title">Juego en Canvas</h1><div class="entry-meta">Primer juego en JavaScript</div><ol id="lista"><li>Haz clic para dibujar cuadrados de medida aleatoria.</li><li>Haz clic sobre un cuadrado para cambiar su color.</li></ol><div class="center"><canvas id="sketchpad" width="800" height="350"></canvas><br><br><button id="limpiar">Limpiar</button></div>';

    var canvas = document.querySelector("#sketchpad");
    context = canvas.getContext('2d');
    canvas.addEventListener("click",function(evt){
      coors=getMousePos(canvas, evt);
      dibujaEnRaton(context, coors) ;
    });
    document.querySelector("#limpiar").addEventListener("click", function () {
      limpiar(context, canvas);
      document.querySelector("#limpiar").blur();
    });
  }
  var cuadrados = [];
  const colorRojo = "rgb(233,68,24)";
  const colorAzul = "rgb(175,176,255)";
  ready();
});
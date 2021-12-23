document.addEventListener("DOMContentLoaded", function () {
  function finDelJuego(tocaPared) {
    var canvas = document.querySelector("#sketchpad2");
    var context = canvas.getContext('2d');
    x = 0;
    y = 0;
    dibujando = false;
    context.clearRect(0, 0, canvas.width, canvas.height);
    // si ha perdido porque ha tocado una pared, se vuelven rojas 0.5 seg

    console.log(tocaPared);
    if(tocaPared) {
      dibujarLaberinto(context, colorParedError);
      setTimeout(dibujarLaberinto, 500, context, colorPared);
    } else {
      dibujarLaberinto(context, colorPared);
    }
  }
  function dibujarParedes(context, color) {
    for(let i = 0; i < paredes.length; i++) {
      dibujarPared(context, paredes[i], color);
    }
  }
  function dibujarPared(context, pared, color) {
    context.fillStyle = color;
    context.fillRect(pared.x, pared.y, pared.width, pared.height);
  }
  function dibujarCasillas(context, color, pared) {
    context.fillStyle = color;
    context.fillRect(pared.x, pared.y, pared.width, pared.height);
  }
  function dibujarLogo(context) {
    var img = new Image();
    img.src = '../wp-content/uploads/2021/11/silla-150x150.png';
    img.onload = function(){
      context.drawImage(img, 5, 385, 30, 30);
    }
  }
  function dibujarLaberinto(context, color) {
    dibujarParedes(context, color);
    dibujarCasillas(context, colorInicio, casillaInicio);
    dibujarCasillas(context, colorFinal, casillaFin);
    dibujarLogo(context);
  }
  function ready() {
    //borrar article
    var article = document.getElementsByTagName("article")[0];
    var padre = article.parentNode;
    padre.removeChild(article);
    //insertar juego
    var main = document.querySelector("#main");
    main.innerHTML = '<h1 class="page-title">Laberinto en Canvas</h1><div class="entry-meta">Juego inventado</div><ul id="lista"><li>Para jugar, mantén pulsado desde la casilla amarilla hasta la naranja.</li><li>¡No te choques con las paredes!</li></ul><div class="center"><p id="mensaje" onmousedown="return false;" onselectstart="return false;">Comienza en la casilla amarilla.</p><canvas id="sketchpad2" width="800" height="420"></canvas></div>';

    var canvas = document.querySelector("#sketchpad2");
    var context = canvas.getContext('2d');
    dibujarLaberinto(context, colorPared);
    
    canvas.addEventListener('mousedown', e => {
      x = e.offsetX;
      y = e.offsetY;
      var context = canvas.getContext('2d');
      context.beginPath();
      context.rect(casillaInicio.x, casillaInicio.y, casillaInicio.width, casillaInicio.height);
      //si el raton esta en la casilla de inicio
      if(context.isPointInPath(x, y)) {
        dibujando = true;
        var parrafo = document.getElementById("mensaje");
        parrafo.textContent = "Jugando...";
      }
    });    

    canvas.addEventListener('mousemove', e => {
     if (dibujando) {
       var context = canvas.getContext('2d');
       dibujaLinea(context, x, y, e.offsetX, e.offsetY);
       x = e.offsetX;
       y = e.offsetY;
       // comprobar si ha chocado con una pared
       for(let i = 0; i < paredes.length; i++) {
        context.beginPath();
        context.rect(paredes[i].x, paredes[i].y, paredes[i].width, paredes[i].height);
        //si el raton esta en la pared
        if(context.isPointInPath(x, y)) {
          var parrafo = document.getElementById("mensaje");
          parrafo.textContent = "¡Has perdido! Vuelve a intentarlo.";
          finDelJuego(true);
          break;
        }
      }
     }
    });

    // el usuario suelta el raton, ver si ha ganado o no
    window.addEventListener('mouseup', e => {
      if (dibujando) {
        var context = canvas.getContext('2d');
        dibujaLinea(context, x, y, e.offsetX, e.offsetY);
        context.beginPath();
        context.rect(casillaFin.x, casillaFin.y, casillaFin.width, casillaFin.height);
        var parrafo = document.getElementById("mensaje");
        //si el raton esta en la casilla de inicio
        if(context.isPointInPath(x, y)) {
          parrafo.textContent = "¡Enhorabuena, has completado el laberinto!";
        } else {
          parrafo.textContent = "¡Has perdido! Vuelve a intentarlo.";
        }
        finDelJuego(false);
      }
    });

    function dibujaLinea(context, x1, y1, x2, y2) {
      context.beginPath();
      context.strokeStyle = 'black';
      context.lineWidth = 1;
      context.moveTo(x1, y1);
      context.lineTo(x2, y2);
      context.stroke();
      context.closePath();
    }
  }

  const colorPared = "rgb(101,152,69)";
  const colorParedError = "rgb(255,77,0)";
  const colorInicio = "rgb(255, 230, 55)";
  const colorFinal = "rgb(255, 115, 55)";
  const casillaInicio = {x: 0, y: 60, width: 20, height: 60};
  const casillaFin = {x: 780, y: 300, width: 20, height: 60};
  const paredes = [
      {x: 0, y: 0, width: 800, height: 60},
      {x: 0, y: 120, width: 140, height: 170},
      {x: 200, y: 60, width: 100, height: 170},
      {x: 360, y: 120, width: 60, height: 170},
      {x: 420, y: 120, width: 260, height: 60},
      {x: 740, y: 60, width: 60, height: 240},
      {x: 480, y: 240, width: 260, height: 60},
      {x: 0, y: 290, width: 420, height: 130},
      {x: 420, y: 360, width: 380, height: 60}
  ];
  //Dibujo del recorrido con el mouse
  var dibujando = false;
  var x = 0;
  var y = 0;
  ready();
});
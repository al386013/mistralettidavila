document.addEventListener("DOMContentLoaded", function () {
if (document.querySelector('#divTemplate') != null) {
  var myInit = {
    method: 'GET'
  };

  function cargarDatos(datos) {
    if (document.querySelector('template').content) {
	// Instantiate the table with the existing HTML tbody and the row with the template
	var t = document.querySelector('#template');
	var tb = document.getElementsByTagName("tbody");
	var clone;

	td = t.content.querySelectorAll("td");
	for (var i = 0; i < datos.length; i++) {
          td[0].textContent = datos[i].title.rendered;
	  td[1].textContent = datos[i].type;
          td[2].innerHTML = '<a href="' + datos[i].link + '">' + datos[i].link + '</a>';
	  clone = document.importNode(t.content, true);
	  tb[0].appendChild(clone);
	}
    }
  }

  function obtenerTemplate(url_template, data) {
    var myRequest = new Request(url_template, myInit);
	fetch(myRequest)
		.then(function (response) {
			if (response.status == 200) return response.text();
			else throw new Error('Something went wrong on api server!');
		})
		.then(function (response) {
			document.querySelector('#divTemplate').innerHTML = response;
			cargarDatos(data);
		})
		.catch(function (error) {
			console.error(error);
		});
  }
  document.querySelector('#recuperarCPT').addEventListener("click", function (event) {
	event.preventDefault();
        document.querySelector('#botonRecuperar').blur();
        //this.getAttribute('href')
	var myRequest = new Request('https://mistralettidavila.cloudaccess.host/wp-json/wp/v2/deportes-adaptados', myInit);
	fetch(myRequest)
		.then(function (response) {
			if (response.status == 200) return response.json();
			else throw new Error('Something went wrong on api server!');
		})
		.then(function (response) {
			console.debug(response);
			obtenerTemplate('/wp-content/plugins/plugin_portal/includes/listarTemplate.html', response);
		})
		.catch(function (error) {
			console.log(error);
		});
  });
}
});
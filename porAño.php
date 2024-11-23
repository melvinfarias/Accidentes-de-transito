<?php
    //conexion con la base de datos: donde se va a ver,usuario,contraseña,nombre de tabla
	$conexion = new mysqli("localhost","root","","ppi");

	//query sql en una variable
	$porAño = "select Año,count(*) as total from tablita where Año > 0 group by Año";

	//en una variable guardar lo que se trae de la coneccion haciendo la query llamando a la variable que tiene la query
	$resultado = $conexion->query($porAño);

	//array
	$data=[];

	//cada var columna guarda lo que se trae de cada fila, con fetch_assoc() se trae fila por fila
	while($columna = $resultado->fetch_assoc() ){
		
		$data[]=$columna;
	}
	
	//jsaon_encode codifica el array data en lenguaje json, json_unescaped_unicode guarda los caracteres tal cual
	$json_data = json_encode($data,JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<!--convierto en español-->
<html lang="es">
<head>
    <!--permite usar caracteres especiales -->
	<meta charset="UTF-8">
    <!--viewport configura la vetana, ancho y hace el zoom necesario para adaptarse al entorno-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>vista previa de accidentes por año</title>
	<link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/x-icon" href="./multimedia/favicon.ico">
</head>

<body>

	<header>
        <nav class="nav">
            <div class="nav-header">
                <div class="nav-logo">
                    <a href="index.html "><img src="./multimedia/logoNav.png" alt="Logo" ></a>
                </div>
            </div>
            <div class="nav-links">
                <a href="index.html">Volver</a>
            </div>
        </nav>
	</header>

    <!-- script es javaScript/src carga y ejecuta un archivo / llama a un url -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--canvas es el lugar donde se dibuja y el id es para asignar un identificador a cada grafico -->
	<canvas id="grafiquito">  </canvas>
	<script>

		//trea lo json a data javaScript y echo lo imprime
		const dataJavaScript= <?php echo $json_data;?>; 

        /*lineas guarda un array de lo que se trajo de json, map da otro formato e item con la flecha toma cada elemento
		del array item y devuelve una cadena formateada, devuelve [año 2016,etc]*/  
		const lineas = dataJavaScript.map(item => item.Año);
		const contar = dataJavaScript.map(item => item.total);

		// donde se almacena la referencia de la busqueda del id en HTML
		const grafico2d = document.getElementById('grafiquito').getContext('2d');

		// nueva instancia de un grafico, chart es una clase para crear graficos
		
		let variableGrafico = new Chart(grafico2d, {

		//aclara el tipo de grafico	
		type: 'bar',
		//datos del grafico
		data: {
			//eje x
			labels: lineas,
			datasets: [{
				//leyenda
				label: 'Conteo por Año',
				//array que tiene los valores de datos que se muestran en el grafico 
				data: contar,
				backgroundColor: 'rgba(200, 0, 0, 1)',
				borderColor: 'rgba(200, 0, 0, 1)',
				borderWidth: 1
			}]
		},
		//config para personalizar el comportamiento del graficp
		options: {

			scales: {
                //ele eje y empiza de 0
				y: { beginAtZero: true }

			}
		}});
	</script>

    <!--leabel asocia un texto, 2016 es lo que se ve/ type define el tipo de entrada/ valor/ checked valor true por defecto -->
	<label>2016 <input type="checkbox" value="2016" checked></label> 
	<label>2017 <input type="checkbox" value="2017" checked></label> 
	<label>2018 <input type="checkbox" value="2018" checked></label> 
	<label>2019 <input type="checkbox" value="2019" checked></label>  
	<label>2020 <input type="checkbox" value="2020" checked></label>
	<label>2021 <input type="checkbox" value="2021" checked></label>

	<script>
		//para actualizar dependiendo de lo seleccionado
		function actualizargrafiquito(){
			//selecciona todos los elementos de tipo checkbox
			const checkboxs = document.querySelectorAll('input[type="checkbox"]');
			/*array.from convierte checkbox en array/filter filtra el array quedandose solo con los que esta chequeados/
			convierte los checkboxs que son array en enteros*/
			const añosSeleccionados = Array.from(checkboxs)
			.filter(checkbox => checkbox.checked)
			.map(checkbox=>parseInt(checkbox.value));

			const nuevasLineas = [];
			const nuevoContar= [];

			//bucle for que trae elementos(no los crea)
			dataJavaScript.forEach(item=>{
				if(añosSeleccionados.includes(parseInt(item.Año))){
					//push es ingresar datos
					//nuevasLineas.push(`Año ${item.Año}`);
					nuevasLineas.push(item.Año);
					nuevoContar.push(item.total);
				}
			});
            variableGrafico.data.labels=nuevasLineas;
			variableGrafico.data.datasets[0].data=nuevoContar;
			//update esactualizar/guardardatos
			variableGrafico.update();
			console.log(nuevoContar);
		}
        //trae todos los checkbox del documento se iteran (addEventListener para que haga algo)
		document.querySelectorAll('input[type="checkbox"]').forEach(checkbox =>{ 
			checkbox.addEventListener('change',actualizargrafiquito);
		});

	</script>

	<footer class="footer">
        <ul>
            <li> <a href="#">Somos <span>FLASH</span></a></li>
            <img src="./multimedia/logos redes sociales/1.png" alt="">
            <img src="./multimedia/logos redes sociales/2.png" alt="">
            <img src="./multimedia/logos redes sociales/3.png" alt="">
        </ul>
        <a class="slogan" href="#">PREVENIR SIN LAMENTAR</a>
        <img src="./multimedia/logoFooter.png" alt="">
    </footer>
</body>
</html>


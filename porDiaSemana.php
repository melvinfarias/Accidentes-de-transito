<?php
	$conexion = new mysqli("localhost","root","","ppi");
	
	$porDiaSemana = "SELECT `Día semana`, COUNT(*) AS total FROM tablita GROUP BY `Día semana`";


	$resultado = $conexion->query($porDiaSemana);

	$data=[];

	while($columna = $resultado->fetch_assoc() ){
		$data[]=$columna;
	}
	//var_dump($data);
	$json_data = json_encode($data,JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>vista previa de accidentes por Día semana</title>
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
	
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<canvas id="grafiquito">  </canvas>
	<script> 

		const dataJavaScript= <?php echo $json_data;?>; 
		const lineas = dataJavaScript.map(item => item['Día semana']);
		const contar = dataJavaScript.map(item => item.total);
		const grafico2d = document.getElementById('grafiquito');

		let variableGrafico = new Chart(grafico2d, {
		type: 'bar',
		data: {
			labels: lineas,
			datasets: [{
				label: 'Conteo por Día semana',
				data: contar,
				backgroundColor: 'rgba(75, 192, 192, 1)',
				borderColor: 'rgba(75, 192, 192, 1)',
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: { beginAtZero: true }
			}
		}}) ;
	</script>

<label>lunes <input type="checkbox" value="Lunes" checked></label> 
	<label>martes <input type="checkbox" value="Martes" checked></label> 
	<label>miercoles <input type="checkbox" value="Miercoles" checked></label> 
	<label>jueves <input type="checkbox" value="Jueves" checked></label>  
	<label>viernes <input type="checkbox" value="Viernes" checked></label>
	<label>sabado <input type="checkbox" value="Sabado" checked></label>
	<label>domingo <input type="checkbox" value="Domingo" checked></label>

	<script>
		
		function actualizargrafiquito(){
			
			const checkboxs = document.querySelectorAll('input[type="checkbox"]');
			
			const diaSeleccionados = Array.from(checkboxs)
			.filter(checkbox => checkbox.checked )
			.map(checkbox=>checkbox.value);

			const nuevasLineas = [];
			const nuevoContar= [];

			
			dataJavaScript.forEach(item=>{
				if(diaSeleccionados.includes(item['Día semana'])) {
					nuevasLineas.push(item['Día semana']);
					nuevoContar.push(item.total);
				}
				
			});
            variableGrafico.data.labels=nuevasLineas;
			variableGrafico.data.datasets[0].data=nuevoContar;
			
			variableGrafico.update();
			console.log(nuevasLineas);
		}
        
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





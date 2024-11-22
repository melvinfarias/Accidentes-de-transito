<?php
	$conexion = new mysqli("localhost","root","","ppi");
	$porRangoetario = "SELECT `Rango etario`,count(*) as total from tablita group by `Rango etario`";

	$resultado = $conexion->query($porRangoetario);

	$data=[];

	while($columna = $resultado->fetch_assoc() ){
		$data[]=$columna;
	}
	
	$json_data = json_encode($data,JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vista previa de accidentes por Rango etario</title>
	<link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/x-icon" href="./multimedia/favicon.ico">
</head>

<body>

	<header>
        <nav class="nav">
            <div class="nav-header">
                <div class="nav-logo">
                    <a href="index.html "><img src="./multimedia/logoNav.png" alt="Logo"></a>
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
		const lineas = dataJavaScript.map(item => `'Rango etario' ${item[`Rango etario`]}`);
		const contar = dataJavaScript.map(item => item.total);
		const grafico2d = document.getElementById('grafiquito');
		let variableGrafico = new Chart(grafico2d, {
		type: 'bar',
		data: {
			labels: lineas,
			datasets: [{
				label: 'Conteo por Rango etario',
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
		}});
	</script>
	<label>Menos de 20 <input type="checkbox" value="Menos de 20" checked></label> 
	<label> Entre 21- 40 <input type="checkbox" value=" Entre 21- 40" checked></label> 
	<label>Entre 41-60 <input type="checkbox" value="Entre 41-60" checked></label> 
	<label>Entre 61-80 <input type="checkbox" value="Entre 61-80" checked></label>  
	<label>Más de 80 <input type="checkbox" value="Más de 80" checked></label>

	<script>
		
		function actualizargrafiquito(){
			
			const checkboxs = document.querySelectorAll('input[type="checkbox"]');
			
			const diaSeleccionados = Array.from(checkboxs)
			.filter(checkbox => checkbox.checked )
			.map(checkbox=>checkbox.value);

			const nuevasLineas = [];
			const nuevoContar= [];

			
			dataJavaScript.forEach(item=>{
				if(diaSeleccionados.includes(item['Rango etario'])) {
					nuevasLineas.push(item['Rango etario']);
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
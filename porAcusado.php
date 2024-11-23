<?php
	$conexion = new mysqli("localhost","root","","ppi");
	$porAcusado = "SELECT Acusado, COUNT(*) AS total FROM tablita  GROUP BY Acusado";

	$resultado = $conexion->query($porAcusado);

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
	<title>vista previa de numero de participantes</title>
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
		const lineas = dataJavaScript.map(item => `'Acusado' ${item[`Acusado`]}`);
		const contar = dataJavaScript.map(item => item.total);
		const grafico2d = document.getElementById('grafiquito');
		let variableGrafico = new Chart(grafico2d, {
		type: 'bar',
		data: {
			labels: lineas,
			datasets: [{
				label: 'Conteo por Num acusado',
				data: contar,
				backgroundColor: 'rgba(200, 0, 0, 1)',
				borderColor: 'rgba(200, 0, 0, 1)',
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: { beginAtZero: true }
			}
		}});
	</script>

<label>AUTO <input type="checkbox" value="AUTO" checked></label>
    <label>BICICLETA <input type="checkbox" value="BICICLETA" checked></label>
    <label>CARGAS <input type="checkbox" value="CARGAS" checked></label>
    <label>MOTO <input type="checkbox" value="MOTO" checked></label>
    <label>MULTIPLE <input type="checkbox" value="MULTIPLE" checked></label>
    <label>OBJETO FIJO <input type="checkbox" value="OBJETO FIJO" checked></label>
    <label>OTRO <input type="checkbox" value="OTRO" checked></label>
    <label>PASAJEROS <input type="checkbox" value="PASAJEROS" checked></label>
    <label>SD <input type="checkbox" value="SD" checked></label>
    <label>TREN <input type="checkbox" value="TREN" checked></label>
    <script>
		
		function actualizargrafiquito(){
			
			const checkboxs = document.querySelectorAll('input[type="checkbox"]');
			
			const AcusadoSeleccionados = Array.from(checkboxs)
			.filter(checkbox => checkbox.checked )
			.map(checkbox=>checkbox.value);

			const nuevasLineas = [];
			const nuevoContar= [];

			
			dataJavaScript.forEach(item=>{
				if(AcusadoSeleccionados.includes(item['Acusado'])) {
					nuevasLineas.push(item['Acusado']);
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




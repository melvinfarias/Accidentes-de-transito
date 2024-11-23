<?php
	$conexion = new mysqli("localhost","root","","ppi");
	$porParticipantes = "SELECT Participantes, COUNT(*) AS total FROM tablita  GROUP BY Participantes";

	$resultado = $conexion->query($porParticipantes);

	$data=[];

	while($columna = $resultado->fetch_assoc() ){
		//echo"año: ". $columna["Año"] ." cantidad de accidentes: ". $columna["total"]."<br>";
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
		const lineas = dataJavaScript.map(item => `'Participantes' ${item[`Participantes`]}`);
		const contar = dataJavaScript.map(item => item.total);
		const grafico2d = document.getElementById('grafiquito');
		let variableGrafico = new Chart(grafico2d, {
		type: 'bar',
		data: {
			labels: lineas,
			datasets: [{
				label: 'Conteo por participantes',
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

    <label>AUTO-AUTO <input type="checkbox" value="AUTO-AUTO" checked></label>
    <label>AUTO-CARGAS <input type="checkbox" value="AUTO-CARGAS" checked></label>
    <label>AUTO-MOVIL <input type="checkbox" value="AUTO-MOVIL" checked></label>
    <label>AUTO-OBJETO FIJO <input type="checkbox" value="AUTO-OBJETO FIJO" checked></label>
    <label>AUTO-PASAJEROS <input type="checkbox" value="AUTO-PASAJEROS" checked></label>
    <label>AUTO-SD <input type="checkbox" value="AUTO-SD" checked></label>
    <label>BICICLETA-AUTO <input type="checkbox" value="BICICLETA-AUTO" checked></label>
    <label>BICICLETA-CARGAS<input type="checkbox" value="BICICLETA-CARGAS" checked></label>
    <label>BICICLETA-OTRO <input type="checkbox" value="BICICLETA-OTRO" checked></label>
    <label>BICICLETA-PASAJEROS <input type="checkbox" value="BICICLETA-PASAJEROS" checked></label>
    <label>BICICLETA-TREN <input type="checkbox" value="BICICLETA-TREN" checked></label>
    <label>CARGAS-AUTO <input type="checkbox" value="CARGAS-AUTO" checked></label>
    <label>CARGAS-CARGAS<input type="checkbox" value="CARGAS-CARGAS" checked></label>
    <label>CARGAS-OBJETO FIJO <input type="checkbox" value="CARGAS-OBJETO FIJO" checked></label>
    <label>CARGAS-PASAJEROS <input type="checkbox" value="CARGAS-PASAJEROS" checked></label>
    <label>MOTO-AUTO <input type="checkbox" value="MOTO-AUTO" checked></label>
    <label>MOTO-BICICLETA <input type="checkbox" value="MOTO-BICICLETA" checked></label>
    <label>MOTO-CARGAS <input type="checkbox" value="MOTO-CARGAS" checked></label>
    <label>MOTO-MOTO <input type="checkbox" value="MOTO-MOTO" checked></label>
    <label>MOTO-MOVIL <input type="checkbox" value="MOTO-MOVIL" checked></label>
    <label>MOTO-OBJETO FIJO <input type="checkbox" value="MOTO-OBJETO FIJO" checked></label>
    <label>MOTO-OTRO <input type="checkbox" value="MOTO-OTRO" checked></label>
    <label>MOTO-PASAJEROS <input type="checkbox" value="MOTO-PASAJEROS" checked></label>
    <label>MOTO-SD <input type="checkbox" value="MOTO-SD" checked></label>
    <label>MOVIL-CARGAS <input type="checkbox" value="MOVIL-CARGAS" checked></label>
    <label>MOVIL-PASAJEROS <input type="checkbox" value="MOVIL-PASAJEROS" checked></label>
    <label>MULTIPLE <input type="checkbox" value="MULTIPLE" checked></label>
    <label>PASAJEROS-AUTO <input type="checkbox" value="PASAJEROS-AUTO" checked></label>
    <label>PASAJEROS-PASAJEROS <input type="checkbox" value="PASAJEROS-PASAJEROS" checked></label>
    <label>PASAJEROS-SD <input type="checkbox" value="PASAJEROS-SD" checked></label>
    <label>PEATON-AUTO <input type="checkbox" value="PEATON-AUTO" checked></label>
    <label>PEATON-BICICLETA <input type="checkbox" value="PEATON-BICICLETA" checked></label>
    <label>PEATON-CARGAS <input type="checkbox" value="PEATON-CARGAS" checked></label>
    <label>PEATON-MOTO <input type="checkbox" value="PEATON-MOTO" checked></label>
    <label>PEATON-PASAJEROS <input type="checkbox" value="PEATON-PASAJEROS" checked></label>
    <label>PEATON-SD <input type="checkbox" value="PEATON-SD" checked></label>
    <label>PEATON_MOTO-MOTO <input type="checkbox" value="PEATON_MOTO-MOTO" checked></label>
    <label>SD-AUTO <input type="checkbox" value="SD-AUTO" checked></label>
    <label>SD-CARGAS <input type="checkbox" value="SD-CARGAS" checked></label>
    <label>SD-MOTO<input type="checkbox" value="SD-MOTO" checked></label>
    <label>SD-SD <input type="checkbox" value="SD-SD" checked></label>
    

	<script>
		
		function actualizargrafiquito(){
			
			const checkboxs = document.querySelectorAll('input[type="checkbox"]');
			
			const ParticipanteSeleccionados = Array.from(checkboxs)
			.filter(checkbox => checkbox.checked )
			.map(checkbox=>checkbox.value);

			const nuevasLineas = [];
			const nuevoContar= [];

			
			dataJavaScript.forEach(item=>{
				if(ParticipanteSeleccionados.includes(item['Participantes'])) {
					nuevasLineas.push(item['Participantes']);
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



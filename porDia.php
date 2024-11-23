<?php
	$conexion = new mysqli("localhost","root","","ppi");
	$porDiaCopy = "SELECT CAST(Día AS UNSIGNED) AS Día, COUNT(*) AS total FROM tablita WHERE Día > 0 GROUP BY Día ORDER BY Día ASC";

	$resultado = $conexion->query($porDiaCopy);

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
	<title>vista previa de accidentes por Día</title>
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
		const lineas = dataJavaScript.map(item => `Día ${item.Día}`);
		const contar = dataJavaScript.map(item => item.total);
		const grafico2d = document.getElementById('grafiquito');
		let variableGrafico = new Chart(grafico2d, {
		type: 'bar',
		data: {
			labels: lineas,
			datasets: [{
				label: 'Conteo por Día',
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
		}}) ;
	</script>

		
	<label>1 <input type="checkbox" value="1" checked></label> 
	<label>2 <input type="checkbox" value="2" checked></label> 
	<label>3 <input type="checkbox" value="3" checked></label> 
	<label>4 <input type="checkbox" value="4" checked></label>  
	<label>5 <input type="checkbox" value="5" checked></label>
	<label>6 <input type="checkbox" value="6" checked></label>
	<label>7 <input type="checkbox" value="7" checked></label>
	<label>8 <input type="checkbox" value="8" checked></label>
	<label>9 <input type="checkbox" value="9" checked></label>
	<label>10 <input type="checkbox" value="10" checked></label>
	<label>11 <input type="checkbox" value="11" checked></label>
	<label>12 <input type="checkbox" value="12" checked></label>
	<label>13 <input type="checkbox" value="13" checked></label>
	<label>14 <input type="checkbox" value="14" checked></label>
	<label>15 <input type="checkbox" value="15" checked></label>
	<label>16 <input type="checkbox" value="16" checked></label>
	<label>17 <input type="checkbox" value="17" checked></label>
	<label>18 <input type="checkbox" value="18" checked></label>
	<label>19 <input type="checkbox" value="19" checked></label>
	<label>20 <input type="checkbox" value="20" checked></label>
	<label>21 <input type="checkbox" value="21" checked></label>
	<label>22 <input type="checkbox" value="22" checked></label>
	<label>23 <input type="checkbox" value="23" checked></label>
	<label>24 <input type="checkbox" value="24" checked></label>
	<label>25 <input type="checkbox" value="25" checked></label>
	<label>26 <input type="checkbox" value="26" checked></label>
	<label>27 <input type="checkbox" value="27" checked></label>
	<label>28 <input type="checkbox" value="28" checked></label>
	<label>29 <input type="checkbox" value="29" checked></label>
	<label>30 <input type="checkbox" value="30" checked></label>
	<label>31 <input type="checkbox" value="31" checked></label>

	<script>
		
		function actualizargrafiquito(){
			
			const checkboxs = document.querySelectorAll('input[type="checkbox"]');
			
			const diaSeleccionados = Array.from(checkboxs)
			.filter(checkbox => checkbox.checked)
			.map(checkbox=>parseInt(checkbox.value));

			const nuevasLineas = [];
			const nuevoContar= [];

			
			dataJavaScript.forEach(item=>{
				if(diaSeleccionados.includes(parseInt(item.Día))){
					
					nuevasLineas.push(item.Día);
					nuevoContar.push(item.total);
				}
			});
            variableGrafico.data.labels=nuevasLineas;
			variableGrafico.data.datasets[0].data=nuevoContar;
			
			variableGrafico.update();
			console.log(nuevoContar);
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



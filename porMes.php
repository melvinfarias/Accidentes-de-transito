<?php
	$conexion = new mysqli("localhost","root","","ppi");
	$porMes = "SELECT Mes,count(*) as total from tablita where Mes > 0 group by Mes order by cast(Mes as unsigned) asc";

	$resultado = $conexion->query($porMes);

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
	<title>vista previa de accidentes por Mes</title>
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
		const lineas = dataJavaScript.map(item => `Mes ${item.Mes}`);
		const contar = dataJavaScript.map(item => item.total);
		const grafico2d = document.getElementById('grafiquito');
		let variableGrafico = new Chart(grafico2d, {
		type: 'bar',
		data: {
			labels: lineas,
			datasets: [{
				label: 'Conteo por Mes',
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

	<!--leabel asocia un texto, 2016 es lo que se ve/ type define el tipo de entrada/ valor/ checked valor true por defecto -->
	<label>mes 1 <input type="checkbox" value="1" checked></label> 
	<label>mes 2 <input type="checkbox" value="2" checked></label> 
	<label>mes 3 <input type="checkbox" value="3" checked></label> 
	<label>mes 4 <input type="checkbox" value="4" checked></label>  
	<label>mes 5 <input type="checkbox" value="5" checked></label>
	<label>mes 6 <input type="checkbox" value="6" checked></label>
	<label>mes 7 <input type="checkbox" value="7" checked></label>
	<label>mes 8 <input type="checkbox" value="8" checked></label>
	<label>mes 9 <input type="checkbox" value="9" checked></label>
	<label>mes 10 <input type="checkbox" value="10" checked></label>
	<label>mes 11 <input type="checkbox" value="11" checked></label>
	<label>mes 12 <input type="checkbox" value="12" checked></label>

	<script>
		
		function actualizargrafiquito(){
			
			const checkboxs = document.querySelectorAll('input[type="checkbox"]');
			
			const mesSeleccionados = Array.from(checkboxs)
			.filter(checkbox => checkbox.checked)
			.map(checkbox=>parseInt(checkbox.value));

			const nuevasLineas = [];
			const nuevoContar= [];

			
			dataJavaScript.forEach(item=>{
				if(mesSeleccionados.includes(parseInt(item.Mes))){
					
					nuevasLineas.push(item.Mes);
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



<?php
	$conexion = new mysqli("localhost","root","","ppi");
	$porEdad = "SELECT `Edad`,count(*) as total from tablita group by `Edad`";

	$resultado = $conexion->query($porEdad);

	$data=[];

	while($columna = $resultado->fetch_assoc() ){
		//echo"edad: ". $columna["Edad"] ." cantidad de accidentes: ". $columna["total"]."<br>";
		$data[]=$columna;
	}
	
	$json_data = json_encode($data,JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vista previa de accidentes por Edad</title>
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
		const lineas = dataJavaScript.map(item => `'Edad' ${item[`Edad`]}`);
		const contar = dataJavaScript.map(item => item.total);
		const grafico2d = document.getElementById('grafiquito');
		let variableGrafico = new Chart(grafico2d, {
		type: 'bar',
		data: {
			labels: lineas,
			datasets: [{
				label: 'Conteo por Edad',
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

    <!--leabel asocia un texto, 2016 es lo que se ve/ type define el tipo de entrada/ valor/ checked valor true por defecto -->
    <label>0 <input type="checkbox" value="0" checked></label>
    <label>1 <input type="checkbox" value="1" checked></label>
    <label>4 <input type="checkbox" value="4" checked></label> 
    <label>5 <input type="checkbox" value="5" checked></label> 
    <label>7 <input type="checkbox" value="7" checked></label> 
    <label>10 <input type="checkbox" value="10" checked></label>
    <label>11 <input type="checkbox" value="11" checked></label> 
    <label>12 <input type="checkbox" value="12" checked></label> 
    <label>13 <input type="checkbox" value="13" checked></label> 
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
    <label>32 <input type="checkbox" value="32" checked></label> 
    <label>33 <input type="checkbox" value="33" checked></label> 
    <label>34 <input type="checkbox" value="34" checked></label> 
    <label>35 <input type="checkbox" value="35" checked></label> 
    <label>36 <input type="checkbox" value="36" checked></label> 
    <label>37 <input type="checkbox" value="37" checked></label> 
    <label>38 <input type="checkbox" value="38" checked></label> 
    <label>39 <input type="checkbox" value="39" checked></label> 
    <label>40 <input type="checkbox" value="40" checked></label> 
    <label>41 <input type="checkbox" value="41" checked></label> 
    <label>42 <input type="checkbox" value="42" checked></label> 
    <label>43 <input type="checkbox" value="43" checked></label> 
    <label>44 <input type="checkbox" value="44" checked></label> 
    <label>45 <input type="checkbox" value="45" checked></label> 
    <label>46 <input type="checkbox" value="46" checked></label> 
    <label>47 <input type="checkbox" value="47" checked></label> 
    <label>48 <input type="checkbox" value="48" checked></label> 
    <label>49 <input type="checkbox" value="49" checked></label> 
    <label>50 <input type="checkbox" value="50" checked></label>
    <label>50 <input type="checkbox" value="50" checked></label>
	<label>51 <input type="checkbox" value="51" checked></label>
	<label>52 <input type="checkbox" value="52" checked></label>
	<label>53 <input type="checkbox" value="53" checked></label>
	<label>54 <input type="checkbox" value="54" checked></label>
	<label>55 <input type="checkbox" value="55" checked></label>
	<label>56 <input type="checkbox" value="56" checked></label>
	<label>57 <input type="checkbox" value="57" checked></label>
	<label>58 <input type="checkbox" value="58" checked></label>
	<label>59 <input type="checkbox" value="59" checked></label>
	<label>60 <input type="checkbox" value="60" checked></label>
	<label>61 <input type="checkbox" value="61" checked></label>
	<label>62 <input type="checkbox" value="62" checked></label>
	<label>63 <input type="checkbox" value="63" checked></label>
	<label>64 <input type="checkbox" value="64" checked></label>
	<label>65 <input type="checkbox" value="65" checked></label>
	<label>66 <input type="checkbox" value="66" checked></label>
	<label>67 <input type="checkbox" value="67" checked></label>
	<label>68 <input type="checkbox" value="68" checked></label>
	<label>69 <input type="checkbox" value="69" checked></label>
	<label>70 <input type="checkbox" value="70" checked></label>
	<label>71 <input type="checkbox" value="71" checked></label>
	<label>72 <input type="checkbox" value="72" checked></label>
	<label>73 <input type="checkbox" value="73" checked></label>
	<label>74 <input type="checkbox" value="74" checked></label>
	<label>75 <input type="checkbox" value="75" checked></label>
	<label>76 <input type="checkbox" value="76" checked></label>
	<label>77 <input type="checkbox" value="77" checked></label>
	<label>78 <input type="checkbox" value="78" checked></label>
	<label>79 <input type="checkbox" value="79" checked></label>
	<label>80 <input type="checkbox" value="80" checked></label>
	<label>81 <input type="checkbox" value="81" checked></label>
	<label>82 <input type="checkbox" value="82" checked></label>
	<label>83 <input type="checkbox" value="83" checked></label>
	<label>84 <input type="checkbox" value="84" checked></label>
	<label>85 <input type="checkbox" value="85" checked></label>
	<label>86 <input type="checkbox" value="86" checked></label>
	<label>87 <input type="checkbox" value="87" checked></label>
	<label>88 <input type="checkbox" value="88" checked></label>
	<label>91 <input type="checkbox" value="91" checked></label>
	<label>92 <input type="checkbox" value="92" checked></label>
	<label>95 <input type="checkbox" value="95" checked></label>

	<script>
		//para actualizar dependiendo de lo seleccionado
		function actualizargrafiquito(){
			//selecciona todos los elementos de tipo checkbox
			const checkboxs = document.querySelectorAll('input[type="checkbox"]');
			/*array.from convierte checkbox en array/filter filtra el array quedandose solo con los que esta chequeados/
			convierte los checkboxs que son array en enteros*/
			const edadSeleccionados = Array.from(checkboxs)
			.filter(checkbox => checkbox.checked)
			.map(checkbox=>parseInt(checkbox.value));

			const nuevasLineas = [];
			const nuevoContar= [];

			//bucle for que trae elementos(no los crea)
			dataJavaScript.forEach(item=>{
				if(edadSeleccionados.includes(parseInt(item.Edad))){
					//push es ingresar datos
					//nuevasLineas.push(Año ${item.Año});
					nuevasLineas.push(item.Edad);
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
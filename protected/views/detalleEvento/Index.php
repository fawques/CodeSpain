<?php
/* @var $this DetalleEventoController */
?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6">
			
			<div class="span5">
				<?php echo "<img src='$ModeloEvento->Imagen'/>" ?>
			</div>

			<div class="span5">
				<h5> Descripción del evento </h5>
				<?php echo "<p>".$ModeloEvento->Descripcion."</p>" ?>
			</div>

			<div class="span10">
				<h5> Datos evento </h5>
				<p>Nombre del Evento: <?php echo $ModeloEvento->Nombre ?></p> 
				<p>Localización: <?php echo $ModeloEvento->Lugar ?>
				<p>Fecha: <?php echo $ModeloEvento->Fecha ?></p> 
			</div>
				
		</div>

		<div class="span4">
			<?php
			
			Yii::import('ext.EGMap.*');
			 
			$gMap = new EGMap();
			$gMap->zoom = 15;
			$mapTypeControlOptions = array(
			  'position'=> EGMapControlPosition::LEFT_BOTTOM,
			  'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
			);
			 
			$gMap->mapTypeControlOptions= $mapTypeControlOptions;
			 
			$gMap->setCenter($ModeloEvento->CoordX, $ModeloEvento->CoordY);
			 
			// Create GMapInfoWindows
			//$info_window_a = new EGMapInfoWindow("<div><h5>$ModeloEvento->Nombre</h5></div>");
			 
			// Create marker
			$marker = new EGMapMarker($ModeloEvento->CoordX, $ModeloEvento->CoordY);
			//$marker->addHtmlInfoWindow($info_window_a);
			$gMap->addMarker($marker);
			 
			 
			// enabling marker clusterer just for fun
			// to view it zoom-out the map
			$gMap->enableMarkerClusterer(new EGMapMarkerClusterer());
			 
			$gMap->renderMap();
			?>
		</div>
	</div>
</div>

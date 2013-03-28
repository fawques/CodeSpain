<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<script type="text/javascript">
	function MostrarModal(data) 
	{ 
		$("#DetalleEventosModal .modal-body").html(data);
		$("#DetalleEventosModal").modal(); 
	}
</script>

<h1>¡Bienvenido desarrollador!</h1>
<br>
<p>En este proyecto pretendemos aunar todos los posibles eventos existentes en españa para developers tales como <a href="http://codemotion.es">Code Motion</a>, o cualquier hackaton desarrolado en este, nuestro país. También, nos gustaría promover la asistencia a estos eventos ayudando en la difusión e intentando facilitar una forma más económica de asistir.</p>

<p>Nos puedes seguir en nuestro Twitter: <a href="https://twitter.com/CodeSpain">CodeSpain</a></p>


<div class="container-fluid">
	<div class="row-fluid">

		<div class="span6">
			<h4 style="text-align:center"> Lista de Eventos </h4>
			<?php 
			//session_start();
			$this->widget('bootstrap.widgets.TbGridView', array(
				'type'=>'bordered',
				'id'=>'evento',
				'selectableRows'=>1,
				'selectionChanged'=>'CentrarEnCoordenadasLista',	
			    'dataProvider'=>$this->ObtenerDataProvider(),
			    'columns'=>array(
			    	array('name'=>'Nombre', 'header'=>'Nombre'),
			    	array('name'=>'Lugar', 'header'=>'Lugar'),
			    	array('name'=>'FechaIni', 'header'=>'Fecha de inicio'),
			    	array('name'=>'FechaFin', 'header'=>'Fecha de fin'),
			    	array(
			            'class'=>'bootstrap.widgets.TbButtonColumn',
			            'htmlOptions'=>array('style'=>'width: 50px'),
			            'template' => "{view}",
			            'buttons'=>array(
				        	'view' => array(
				            	'label'=>'Detalle de evento',
				            	'url'=>'Yii::app()->createUrl("DetalleEvento?id=$data->idEventos")',
				            	'options'=>array(
						           	'ajax'=>array(
	                                	'type'=>'POST',
	                                	'url'=>"js:$(this).attr('href')",
	                                	'success'=>'function(data) {MostrarModal(data);}'
	                            	),
	                            ),
				           		
				        	),
			        	),

			    	),
			    ),
			    //'template' => "{items}",
			    'enablePagination' => true,
			    'enableSorting' => false,
			));

			?>

			<h4 style="text-align:center"> Calendario de Eventos</h4>
			<?php $this->widget('application.extensions.fullcalendar.FullcalendarGraphWidget', 
				    $data
			);
			?>
		</div>

		<div class="span6">
			<h4 style="text-align:center"> Mapa de Eventos </h4>

			<div id="contenedorMapa">
				<?php 
					Yii::import('mapa');
					$mapa = new MapaController('mapa');
					$mapa->actionIndex();
				?>
			</div>
		</div>
	</div>
</div>


<!-- View Popup  -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'DetalleEventosModal')); ?>
<!-- Popup Header -->
<div class="modal-header">
	<a class="close" data-dismiss="modal">&times;</a>
	<h4>Detalles de evento</h4>
</div>
<!-- Popup Content -->
<div class="modal-body">

</div>

<?php $this->endWidget(); ?>
<!-- View Popup ends -->












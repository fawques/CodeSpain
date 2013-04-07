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

<h1>&iexcl;Bienvenido desarrollador!</h1>
<h2 style="display:none;">Eventos Para desarrolladores</h2>
<h3 style="display:none;">Buscar Eventos</h3>
<br>
<p>En este proyecto pretendemos aunar todos los posibles eventos existentes en espa&ntilde;a para developers tales como <a href="http://codemotion.es" alt="enlace a Code Motion">Code Motion</a>, o cualquier hackaton desarrollado en este, nuestro pa&iacute;s. Tambi&eacute;n, nos gustar&iacute;a promover la asistencia a estos eventos ayudando en la difusi&oacute;n e intentando facilitar una forma m&aacute;s econ&oacute;mica de asistir.</p>

<p>Nos puedes seguir en nuestro <a href="https://twitter.com/CodeSpain" alt="Twitter de CodeSpain">Twitter</a></p>


<div class="container-fluid">
	<div class="row-fluid">

		<div class="span7">
			<h4 class="pagination-centered"> Lista de Eventos </h4>
			<?php
			//session_start();
			$this->widget('bootstrap.widgets.TbGridView', array(
				'type'=>'bordered',
				'id'=>'evento',
				'selectableRows'=>1,
				'selectionChanged'=>'CentrarEnCoordenadasLista',
			    'dataProvider'=>$this->ObtenerDataProvider(),
			    'columns'=>array(
			    	array('name'=>'idEventos', 'header'=>''),
			    	array('name'=>'Nombre', 'header'=>'Nombre'),
			    	array('name'=>'Lugar', 'header'=>'Lugar'),
			    	array('name'=>'FechaIni', 'header'=>'Fecha de inicio','value'=>'date("d/m/Y", strtotime($data->FechaIni))'),
			    	array('name'=>'FechaFin', 'header'=>'Fecha de fin','value'=>'date("d/m/Y", strtotime($data->FechaFin))'),
			    	array('name'=>'Web', 'header'=>'Web', 'value' => 'CHtml::link($data->Web, "http://".$data->Web, array("target"=>"_blank"))','type'  => 'raw',),
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
	                                	'async'=>'false',
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

			<h4 class="pagination-centered"> Calendario de Eventos</h4>
			<?php $this->widget('application.extensions.fullcalendar.FullcalendarGraphWidget',
				    $data
			);
			?>
		</div>

		<div class="span5">
			<h4 class="pagination-centered"> Mapa de Eventos </h4>

			<div id="contenedorMapa">
				<?php
					Yii::import('mapa');
					$mapa = new MapaController('mapa');
					$mapa->actionIndex(true);
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












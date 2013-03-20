<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>¡Bienvenido desarrollador!</h1>
<br>
<p>En este proyecto pretendemos aunar todos los posibles eventos existentes en españa para developers tales como <a href="codemotion.es">Code Motion</a>, <a href="www.ignitevlc.com">Ignite Valencia</a>, o cualquier hackaton desarrolado en este, nuestro país. También, nos gustaría promover la asistencia a estos eventos ayudando en la difusión e intentando facilitar una forma más económica de asistir.</p>

<p>Nos puedes seguir en nuestro Twitter: <a href="https://twitter.com/CodeSpain">CodeSpain</a></p>


<div class="container-fluid">
	<div class="row-fluid">

		<div class="span5">
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
			    	'Nombre','Lugar','Fecha',
			    	 array(
			            'class'=>'bootstrap.widgets.TbButtonColumn',
			            'htmlOptions'=>array('style'=>'width: 50px'),
			            'template'=>'{view}',
			            'buttons'=>array(
					        'view' => array(
					            'label'=>'Detalle del evento',
					            //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
					            //'click'=>'function(){alert("'.Yii::app()->baseUrl.'");}',
					            //'url' => '/DetalleEvento',
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













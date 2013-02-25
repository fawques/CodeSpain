<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>¡Bienvenido desarrollador!</h1>
<br>
<p>En este proyecto pretendemos aunar todos los posibles eventos existentes en españa para developers tales como <a href="codemotion.es">Code Motion</a>, <a href="www.ignitevlc.com">Ignite Valencia</a>, o cualquier hackaton desarrolado en este, nuestro país. También, nos gustaría promover la asistencia a estos eventos ayudando en la difusión e intentando facilitar una forma más económica de asistir.</p>
<div id="search">
	<input placeholder="Escriba aqu&iacute" id="inputSearch">
	<button id="BtSearch">¡Busca eventos!</button>
</div>


<p>Nos puedes seguir en nuestro Twitter: <a href="https://twitter.com/CodeSpain">CodeSpain</a></p>


<p> Calendario de Eventos </p>
<?php $this->widget('application.extensions.fullcalendar.FullcalendarGraphWidget', 
	    $data
	);?>


<p> Mapa de Eventos </p>

<?php 
	Yii::import('mapa');
	$mapa = new MapaController('mapa');
	$mapa->actionIndex();
?>

<?php 

$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'bordered',
	'id'=>'evento',
	'selectableRows'=>1,
	'selectionChanged'=>'CentrarEnCoordenadas',	// via 1: para mostrar detalles al seleccionar
    'dataProvider'=>$ArrayListaEventos,
    'columns'=>array(
    	'Nombre','Lugar','Fecha'

    ),
    'template' => "{items}",
));



?>
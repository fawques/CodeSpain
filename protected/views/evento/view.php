<?php
/* @var $this EventoController */
/* @var $model Evento */

$this->breadcrumbs=array(
	'Eventos'=>array('index'),
	$model->idEventos,
);

$this->menu=array(
	array('label'=>'List Evento', 'url'=>array('index')),
	array('label'=>'Create Evento', 'url'=>array('create')),
	array('label'=>'Update Evento', 'url'=>array('update', 'id'=>$model->idEventos)),
	array('label'=>'Delete Evento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idEventos),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Evento', 'url'=>array('admin')),
);
?>

<h1>View Evento #<?php echo $model->idEventos; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idEventos',
		'Nombre',
		'Descripcion',
		'Lugar',
		'Fecha',
	),
)); ?>

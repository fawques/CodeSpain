<?php
/* @var $this EventoController */
/* @var $model Evento */

$this->breadcrumbs=array(
	'Eventos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Evento', 'url'=>array('index')),
	array('label'=>'Manage Evento', 'url'=>array('admin')),
);
?>

<h1>Create Evento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
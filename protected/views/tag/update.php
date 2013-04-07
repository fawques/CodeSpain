<?php
/* @var $this TagController */
/* @var $model Tag */

$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->Etiqueta=>array('view','id'=>$model->Etiqueta),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tag', 'url'=>array('index')),
	array('label'=>'Create Tag', 'url'=>array('create')),
	array('label'=>'View Tag', 'url'=>array('view', 'id'=>$model->Etiqueta)),
	array('label'=>'Manage Tag', 'url'=>array('admin')),
);
?>

<h1>Update Tag <?php echo $model->Etiqueta; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
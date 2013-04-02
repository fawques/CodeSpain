<?php
/* @var $this TagController */
/* @var $data Tag */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Etiqueta')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Etiqueta), array('view', 'id'=>$data->Etiqueta)); ?>
	<br />


</div>
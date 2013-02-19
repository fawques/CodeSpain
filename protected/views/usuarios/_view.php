<?php
/* @var $this UsuariosController */
/* @var $data Usuarios */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idUsuarios')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idUsuarios), array('view', 'id'=>$data->idUsuarios)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nombre')); ?>:</b>
	<?php echo CHtml::encode($data->Nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Token')); ?>:</b>
	<?php echo CHtml::encode($data->Token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Preferencias_idPreferencias')); ?>:</b>
	<?php echo CHtml::encode($data->Preferencias_idPreferencias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Eventos_idEventos')); ?>:</b>
	<?php echo CHtml::encode($data->Eventos_idEventos); ?>
	<br />


</div>
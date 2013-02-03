<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idUsuarios'); ?>
		<?php echo $form->textField($model,'idUsuarios'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Nombre'); ?>
		<?php echo $form->textField($model,'Nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Token'); ?>
		<?php echo $form->textField($model,'Token',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Preferencias_idPreferencias'); ?>
		<?php echo $form->textField($model,'Preferencias_idPreferencias'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Eventos_idEventos'); ?>
		<?php echo $form->textField($model,'Eventos_idEventos'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
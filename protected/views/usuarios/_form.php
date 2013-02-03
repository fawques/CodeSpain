<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idUsuarios'); ?>
		<?php echo $form->textField($model,'idUsuarios'); ?>
		<?php echo $form->error($model,'idUsuarios'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Nombre'); ?>
		<?php echo $form->textField($model,'Nombre',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Token'); ?>
		<?php echo $form->textField($model,'Token',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Token'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Preferencias_idPreferencias'); ?>
		<?php echo $form->textField($model,'Preferencias_idPreferencias'); ?>
		<?php echo $form->error($model,'Preferencias_idPreferencias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Eventos_idEventos'); ?>
		<?php echo $form->textField($model,'Eventos_idEventos'); ?>
		<?php echo $form->error($model,'Eventos_idEventos'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
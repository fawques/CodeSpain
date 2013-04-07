<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle='CodeSpain - Contacto';
$this->breadcrumbs=array(
	'Contact',
);
?>

<div class="form">
<fieldset>
 
    <legend>Contacta con nosotros</legend>
    <p>
	Cuelquier cosa que quieras preguntar estamos abiertos, sólo tienes que completar este lindo formulario.
	</p>
<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'asunto'); ?>
		<?php echo $form->textField($model,'asunto',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'asunto'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'mensaje'); ?>
		<?php echo $form->textArea($model,'mensaje',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mensaje'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div>
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Introduce las letras que aparecen en la imágen.
		<br/>No importa que pongas mayúsculas o minúsculas</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="buttons">
		<?php echo CHtml::submitButton('¡Mandalo YA!'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
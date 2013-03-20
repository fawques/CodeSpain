<?php
/* @var $this EventosController */

$this->breadcrumbs=array(
	'Evento'=>array('/evento'),
	'Nuevo',
);
?>
<div class="form">

<?php /** @var BootActiveForm $form */
$model = new Eventos();
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'nuevoEvento',
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); 

$model->Nombre = $valores['Nombre'];
$model->Descripcion = $valores['Descripcion'];
$model->Lugar = $valores['Lugar'];
$model->Fecha = $valores['Fecha'];
$model->tags = $valores['tags'];



?>
 
<fieldset>
 
    <legend>Nuevo Evento</legend>
 	<!-- Necesito Nombre, Descripcion, Lugar, Fecha, CoordX, Coordy, tags-->
 	<div class="row">
 		<?php echo $form->labelEx($model,'Nombre'); ?>
	    <?php echo $form->textField($model, 'Nombre'); ?>
	    <?php echo $form->error($model,'Nombre'); ?>
 	</div>
 	<div class="row">
 		<?php echo $form->labelEx($model,'Descripcion'); ?>
    	<?php echo $form->textArea($model, 'Descripcion', array('class'=>'span8', 'rows'=>5, )); ?>
    	<?php echo $form->error($model,'Descripcion'); ?>
    </div>
    <div class="row">
	    <div class="control-group">
	    	<?php echo $form->labelEx($model,'Lugar'); ?>
	    	<div class="controls">
		    	<?php $this->widget('bootstrap.widgets.TbTypeahead', array(
				    'name'=>'Eventos[Lugar]', //sirve para que en el $_Post se pueda coger :)
				    'options'=>array(
				        'source'=>array('Madrid', 'Barcelona', 'Valencia', 'Alicante', 'Granada', 'Bilbao', 'San Sebastián', 'A Coruña', 'Santiago de Compostela', 'Sevilla'),
				        'items'=>4,
				        'matcher'=>"js:function(item) {
				            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
				        }",
				    ),
				)); ?>

			<?php echo $form->error($model,'Lugar'); ?>
	    </div>
	</div>
	<div class="row">
	    <div class="control-group">
	    	<?php echo $form->labelEx($model,'Fecha'); ?>
	    	<div class="controls">
			    <?php 
				$this->widget('application.extensions.timepicker.timepicker', array(
			    	'model'=>$model,
			    	'id'=>'Eventos_Fecha',
			    	'name'=>'Fecha',
				));
				?>
				<?php echo $form->error($model,'Fecha'); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="control-group">
	    	<label class="control-label">Etiquetas</label>
	    	<div class="controls">
				<?php
				// Para que lo autocomplete, el formato del array debe ser este:
				// $prueba = array(array('id'=>'0','text'=>'c++'),array('id'=>'1','text'=>'java'));
				echo CHtml::textField('test','',array('id'=>'test'));
				$this->widget('ext.select2.ESelect2',array(
				  'selector'=>'#test',
				  'options'=>array(
				    'data'=>$etiquetas,
				    'width'=>'200px',
				    'multiple'=>'true',
				  ),
				));
				?>
	    		<?php //echo $form->error($model,'Nombre'); ?> <!-- Habría que ponerlo para validarlo -->
			</div>
	    </div>
	</div>
    <div class="row" id="dVal">
	    	<?php echo $form->labelEx($model,'validacion'); ?>
			<?php $this->widget('application.extensions.recaptcha.EReCaptcha', 
				array('model'=>$model, 'attribute'=>'validacion',
				     'theme'=>'clean', 'language'=>'es_ES', 
				     'publicKey'=>'6LemVd0SAAAAALWoJdj_2skhhO22FBpXxPyczwS1')) ?>
			<?php echo $form->error($model,'validacion'); ?>
			<!--<div class="errorMessage" id="errorVal" style="display:none">Introduzca correctamente los parámetros</div>-->
    </div>
</fieldset>

<?php if(Yii::app()->user->hasFlash('expire_date_error')):?>
        <div class="alert alert-error">
        	<button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::app()->user->getFlash('expire_date_error'); ?>
        </div>
<?php endif; ?>
 
<div class="form-actions">
    <?php echo CHtml::submitButton("¡Al turron!"); ?>
</div>
 
<?php $this->endWidget(); ?>
</div>

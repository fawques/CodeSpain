<?php
/* @var $this EventosController */

$this->breadcrumbs=array(
	'Evento'=>array('/evento'),
	'Nuevo',
);
?>
<?php /** @var BootActiveForm $form */
$model = new Eventos();
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'nuevoEvento',
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
 
<fieldset>
 
    <legend>Nuevo Evento</legend>
 	<!-- Necesito Nombre, Descripcion, Lugar, Fecha, CoordX, Coordy, tags-->
 	<?php echo $form->labelEx($model,'Nombre'); ?>
    <?php echo $form->textField($model, 'Nombre'); ?>
    <?php echo $form->error($model,'Nombre'); ?>
    <?php echo $form->textArea($model, 'Descripcion', array('class'=>'span8', 'rows'=>5, )); ?>
    <div class="control-group">
    	<label class="control-label">Lugar</label>
    	<div class="controls">
	    	<?php $this->widget('bootstrap.widgets.TbTypeahead', array(
			    'name'=>'WLugar',
			    'options'=>array(
			        'source'=>array('Madrid', 'Barcelona', 'Valencia', 'Alicante', 'Granada', 'Bilbao', 'San Sebastián', 'A Coruña', 'Santiago de Compostela', 'Sevilla'),
			        'items'=>4,
			        'matcher'=>"js:function(item) {
			            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
			        }",
			    ),
			)); ?>
		</div>
    </div>
    <div class="control-group">
    	<label class="control-label">Fecha inicio:</label>
    	<div class="controls">
		    <?php 
			$this->widget('application.extensions.timepicker.timepicker', array(
		    	'model'=>$model,
		    	'name'=>'Fecha',
			));
			?>
		</div>
	</div>
   	<div class="control-group">
    	<label class="control-label">Tags</label>
    	<div class="controls">
	    	<?php $this->widget('bootstrap.widgets.TbTypeahead', array(
			    'name'=>'WTags',
			    'options'=>array(
			        'source'=>array('C', 'C++', 'Objective C', 'C#', 'Web', 'Java', 'Javascript', 'Ruby','Perl', 'PHP', 'Python', 'Agile/Metodologías Ágiles'),
			        'items'=>4,
			        'matcher'=>"js:function(item) {
			            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
			        }",
			    ),
			)); ?>
		</div>
    </div>
    <div class="control-group">
    	<div class="controls">
    		<?php echo CHtml::activeLabel($model, 'validacion'); ?>
			<?php $this->widget('application.extensions.recaptcha.EReCaptcha', 
			   array('model'=>$model, 'attribute'=>'validacion',
			         'theme'=>'red', 'language'=>'es_ES', 
			         'publicKey'=>'6LemVd0SAAAAALWoJdj_2skhhO22FBpXxPyczwS1')) ?>
			<?php echo CHtml::error($model, 'validacion'); ?> 
    	</div>
    </div>
</fieldset>
 
<div class="form-actions">
    <?php echo CHtml::submitButton('¡Al turrón!'); ?>
</div>
 
<?php $this->endWidget(); ?>

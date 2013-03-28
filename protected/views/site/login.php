<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Accede con cualquiera de estos servicios</p>

<?php  $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Google',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>array('/acceso/Google'),
)); ?>

<?php 
    $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Twitter',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>array('/acceso/Twitter'),
)); ?>

<?php  $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Facebook',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>'javascript:alert("Facebook")',
)); ?>
>>>>>>> master

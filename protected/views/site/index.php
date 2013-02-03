<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1><a href="codespain.es"><img src="images/cover.png" class="img"></a></h1>

<div class="btn-toolbar">
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'buttons'=>array(
            array('label'=>'Home', 'url'=>'#'),
            array('label'=> 'Noticias', 'url'=>'#'),
            array('label'=>'F.A.Q.', 'items'=>array(
                array('label'=>'¿Qué es esto?', 'url'=>'#'),
                array('label'=>'¿De dónde hemos salido?', 'url'=>'#'),
                array('label'=>'Are you Open?', 'url'=>'#'),
            )),
        ),
    )); ?>
</div>

<p>Bienvenido a CodeSpain.</p>

<p>En este proyecto pretendemos aunar todos los posibles eventos existentes en españa para developers tales como <a href="codemotion.es">Code Motion</a>, <a href="http://www.ignitevlc.com/">Ignite Valencia</a>, o cualquier hackaton desarrolado en este, nuestro país. También, nos gustaría promover la asistencia a estos eventos ayudando en la difusión e intentando facilitar una forma más económica de asistir.

<p>Nos puedes seguir en nuestro Twitter: <a href="https://twitter.com/CodeSpain">CodeSpain</a></p>


<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'tabs'=>array(
        array('label'=>'Noticia 1', 'content'=>'Pronto esperamos tener la web
            operativa y bla bla bla bla', 'active'=>true),
        array('label'=>'To Escolaneitor', 'content'=>'Escolano judas.'),
        array('label'=>'To Victoriuous', 'content'=>'Victor putilla.'),
        ),)); ?>


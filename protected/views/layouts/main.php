<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/faq.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('../')),
                array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'F.A.Q.', 'url'=>array('/site/page', 'view'=>'faq')
                    /* ========== No he conseguido que vaya el scroll automático al punto concreto, lo dejo comentado ============= */
                    /*'items'=>array(
                    array('label'=>'¿Qué es esto?', 'url'=>array('/site/page',  'view'=>'faq', 'id'=>'ctQueEs')),
                    array('label'=>'¿Quien está detrás?', 'url'=>array('/site/page', 'view'=>'faq', 'id'=>'ctWhoAre')),
                    array('label'=>'¿OpenSource?', 'url'=>array('/site/page', 'view'=>'faq', 'id'=>'ctOpen'))
                    ,)*/
                ,),
                array('label'=>'Nuevo Evento', 'url'=>array('/evento/create'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                

            ),

        ),
        '<form class="navbar-search pull-right" action=""><input title="Buscar Eventos" type="text" class="search-query span2" placeholder="Buscar eventos"></form>',
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	       <br>
           <hr>
           Created and designed by <a href="http://twitter.com/fawques">Victor Guzman</a>, <a href="http://twitter.com/AzureFlameK1t3">Adri&aacute;n Escolano</a> y <a href="http://twitter.com/Pablo_1990">Pablo Vicente.</a>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

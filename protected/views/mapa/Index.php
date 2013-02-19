

<?php
/* @var $this MapaController */


$this->breadcrumbs=array(
	'Mapa'=>array('/mapa'),
	'Index',
);
?>
<body> 
	<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

	<p>
		You may change the content of this page by modifying
		the file <tt><?php echo __FILE__; ?></tt>.
	</p>

	<div id="search-panel">
      <input id="target" type="text" placeholder="Search Box">
    </div>
	<div id="map_canvas" style="width:1000px; height:1000px"></div>
</body>
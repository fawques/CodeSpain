function buscar(){

	var keyword = $('#busqueda').val();
	//alert(keyword);
	$.ajax({
			url: "index.php/site/search",
			data: "busqueda=" + keyword,
			type: "POST",
			dataType: "json",
			success: function(resultados){
				var listado = new Array();
				for(i=0; i< resultados.length; i++){
					listado.push({name: i, value: resultados[i].lat+'|'+resultados[i].lng});
				}
				actualizarLista($.param(listado));

			},
			error: function(dato){
				alert("ERROR EN LA BÚSQUEDA");
				alert(dato);
			}
		});
	return false;
}

$('#searchForm').submit(buscar);
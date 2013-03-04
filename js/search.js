function buscar(){

	var keyword = $('#busqueda').val();
	alert(keyword);
	$.ajax({
			url: "index.php/site/search",
			data: "busqueda=" + keyword,
			type: "POST",
			dataType: "text",
			success: function(resultados){
				for(i=0; i< resultados.length; i++){
					alert(resultados[i] + " // hacer cosas");
				}

			},
			error: function(dato){
				alert("ERROR EN LA BÚSQUEDA");
				alert(dato);
			}
		});
	return false;
}

$('#searchForm').submit(buscar);
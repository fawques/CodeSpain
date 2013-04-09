$("#Eventos_tags_em_").hide();

function validarFormulario(form)
{
	var nombre = form['Eventos_Nombre'].value;
	var descripcion = form['Eventos_Descripcion'].value;
	var lugar = form['Eventos_Lugar'].value;
	var fecha1 = form['Eventos_FechaIni'].value;
	var fecha2 = form['Eventos_FechaFin'].value;
	var tags = form['Eventos_tags'].value;
	var tagsOK = true;

	if(tags == ""){
		$("#divEtiquetas").addClass('error');
		$("#divEtiquetas2").addClass('error');
		$("#Eventos_tags_em_").show();
		tagsOK = false;
	}

	if(nombre == "" || descripcion == "" || lugar == "" || fecha1 == "" || fecha2 == "" || !tagsOK)
	{
		return false;
	}
	else if(!comprobarRangoFecha(fecha1, fecha2)){
		//document.getElementById("divError").style.display="inline";
		//$("#divError").alert();
		alert('¡Fechas incorrectas!');
	}
	else
	{
		var markers = ListaMarkers();
		if(markers.length > 0)
		{
			var coord = markers[0].value.split("|");
			document.getElementById("Eventos_CoordX").value = coord[0];
			document.getElementById("Eventos_CoordY").value = coord[1];
			return true;
		}
		else
		{
			alert('¡Pon un marker, por favor!');
			return false;
		}
	}
}

function comprobarRangoFecha(fecha1, fecha2){
	var c1 = fecha1.split("-");
	var c2 = fecha2.split("-");
	var c3 = c1[2].split(" ");
	var c4 = c2[2].split(" ");

	if(parseInt(c1[0])>parseInt(c2[0])){
		return false;
	}
	else if(parseInt(c1[1])>parseInt(c2[1])){
		return false;
	}
	else if(parseInt(c3[0])>parseInt(c4[0])){
		return false;
	}
	return true;
}
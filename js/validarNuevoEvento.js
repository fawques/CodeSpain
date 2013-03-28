function validarFormulario(form)
{
	var nombre = form['Eventos_Nombre'].value;
	var descripcion = form['Eventos_Descripcion'].value;
	var lugar = form['Eventos_Lugar'].value;
	var fecha = form['Eventos_FechaIni'].value;
	

	if(nombre == "" || descripcion == "" || lugar == "" || fecha == "")
	{
		return false;
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
			return false;
		}
	}
}

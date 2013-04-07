/* Spanish initialisation for the jQuery UI date picker plugin. */
/* Written by Pablo Vicente Munuera */

$.datepicker.regional['es'] = {
   closeText: 'Hecho',
   prevText: 'Anterior',
   nextText: 'Siguiente',
   currentText: 'Ahora',
   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
   monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
   'Jul','Ago','Sep','Oct','Nov','Dic'],
   dayNames: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
   dayNamesShort: ['Lun','Mar','Mie','Jue','Vie','Sab','Dom'],
   dayNamesMin: ['L','M','X','J','V','S','D'],
   weekHeader: 'V',
   dateFormat: 'dd.mm.yy',
   firstDay: 1,
   isRTL: false,
   showMonthAfterYear: false,
   yearSuffix: ''};

$.timepicker.regional['es'] = {
   timeOnlyTitle: 'Elige fecha',
   timeText: 'Fecha',
   hourText: 'Hora',
   minuteText: 'Minutos',
   secondText: 'Segundos',
   currentText: 'Ahora',
   closeText: 'Hecho',
   ampm: false
};

$.datepicker.setDefaults($.datepicker.regional['es']);
$.timepicker.setDefaults($.timepicker.regional['es']);

function getPhpDate(fecha) {
	var dia = fecha.substring(0,2);
	var mes = fecha.substring(3,5);
	var anio =  fecha.substring(6,10);
	
	var fecha_doc = anio.toString() + mes.toString() + dia.toString();

	return fecha_doc;

}

function fechamask (fecha) {
	var dia = fecha.substring(8,10);
	var mes = fecha.substring(5,7);
	var anio =  fecha.substring(0,4);
	
	var fecha_doc = dia.toString() + '/'+  mes.toString() + '/' + anio.toString() 

	return fecha_doc;

}

function hourmask(tiempo){

	var hora = tiempo.substring(11,13);
	var min  = tiempo.substring(14,16);
	var ampm = 'AM';
	
	if (parseFloat(hora) == 12) {
		ampm = 'PM';
	}
	else if (parseFloat(hora)> 12){
		hora = parseFloat(hora) - 12;
		ampm = 'PM';
	}else if (parseFloat(hora) == 0){
		hora = 12;
	}

	return hora+':'+min+' '+ ampm;



}
	
function msjPnotify(tipo,titulo,mensaje) {
	new PNotify({
          title: '<b>'+titulo +'</b>',
          text: mensaje,
          type: tipo
    });		
    console.log(tipo);
}

function requestErrorHandler(array){
	$.each(array,function(index, value) {
		msjPnotify('error','Advertencia',value);
		
	});
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function currency(value, decimals, separators) {
    decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
    separators = separators || ['.', ".", ','];
    var number = (parseFloat(value) || 0).toFixed(decimals);
    if (number.length <= (4 + decimals))
        return number.replace('.', separators[separators.length - 1]);
    var parts = number.split(/[-.]/);
    value = parts[parts.length > 1 ? parts.length - 2 : 0];
    var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
        separators[separators.length - 1] + parts[parts.length - 1] : '');
    var start = value.length - 6;
    var idx = 0;
    while (start > -3) {
        result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
            + separators[idx] + result;
        idx = (++idx) % 2;
        start -= 3;
    }
    return (parts.length == 3 ? '-' : '') + result;
}
 
function currency_cob (value, decimals, separators) {

	$value = currency(value,decimals,separators) ;

	if ($value == '0.00') {
		return '-';
	}else {
		return $value;
	}

}

function currency_js(value,id){

	$value = currency(value,2,[',', "'", '.']) ;

	document.getElementById(id).value = $value;
}

function convert_strFloat(value) {
	value = String(value);
	var value2 = '';
	var caracter = '';
	var test = value;




	if (value == '-' || value == '0'){
		value2 = '0'
	}else {
		for(i=0; i<value.length; i++) {
			//alert(i + ': ' + cadena.charAt(i));
			if (value.charAt(i) == ','){
				caracter = '';			
			}else {				
				caracter = value.charAt(i);
			}
			value2 += caracter;
		}

	}

	if (value2 == ''){
		value2 = '0';
	}
	//console.log('Or: ' + value + ' - ' + value2 + ' - ' + parseFloat(value2) + ' - ' + parseFloat(value));
	
	return parseFloat(value2);

}

function getSelectText(combo){
	var combo = document.getElementById(combo);
	var selected = combo.options[combo.selectedIndex].text;
	return selected;
}
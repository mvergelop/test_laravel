<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Index 
Route::get('/',"IndexController@index");
Route::get('planes',"IndexController@precios");
Route::get('email',"IndexController@sendEmail");


//Usuarios
Route::get('usuarios/activar/{idlogin}','UsuarioController@activar');
Route::get('usuarios/desactivar/{idlogin}','UsuarioController@desactivar');
Route::resource('usuarios/poraprobar','UsuarioController@porAprobar');
Route::resource('usuarios','UsuarioController');

//Login
Route::resource('login','LoginController');
Route::get('logout','LoginController@logout');


Route::get('existeurl/{url}','CondominioController@existeUrl');
Route::get('condominio/edit','CondominioController@edit');
Route::resource('condominio','CondominioController');
Route::resource('inmuebles','InmuebleController');



//Tipo de Gastos
Route::get('tipogastos/gettipogastos','TipoGastosController@getTiposGastos');
Route::get('tiposgastos/activar/{id}','TipoGastosController@activar');
Route::get('tiposgastos/desactivar/{id}','TipoGastosController@desactivar');
Route::get('tiposgastos/{id}/edit','TipoGastosController@edit');
Route::resource('tipogastos','TipoGastosController');


Route::get('gastos/desactivar/{id}','GastosController@desactivar');
Route::get('gastos/activar/{id}','GastosController@activar');
Route::resource('gastos','GastosController');

Route::post('generacuotas/storetemp',"GeneraCuotasController@storeTemp");
Route::post('generacuotas/guardar',"GeneraCuotasController@guardar");
Route::post('generacuotas/storetempsave',"GeneraCuotasController@storeTempSave");
Route::resource('generacuotas','GeneraCuotasController');

//Cobro de Cuotas
Route::get ('periodosinmueble/{idInmueble}','CobroCuotasController@periodosInmueble');
Route::get ('montocuota/{idInmueble}/{idPeriodo}/{extra}','CobroCuotasController@montoCuota');

Route::post('procesatuotastemp','CobroCuotasController@procesaCuotasTemp');
Route::post('validafecha','CobroCuotasController@validaFecha'); // Se puede usar tmb para cobranzas y otro tipo de ingresos o egresos
Route::resource('cuotastemp','CobroCuotasController@cuotasTemp');
Route::resource('cobrocuotas','CobroCuotasController');

Route::resource('gastostemp','RegistraGastosController@gastosTemp');
Route::resource('procesagastostemp','RegistraGastosController@procesaGastosTemp');
Route::resource('reggastos','RegistraGastosController');

//Cierre de Periodos
Route::get('periodosxcerrar','CerrarPeriodoController@periodosXCerrar');
Route::get('haydatatemp/{periodo}','CerrarPeriodoController@hayDataTemp');
Route::post('cierraperiodo','CerrarPeriodoController@cierraPeriodo');
Route::resource('cerrarperiodo','CerrarPeriodoController');


//Formas de Pago
Route::resource('formaspago','FormasPagoController');


//Reportes 
Route::get('resumencondominio/{idPeriodo}','ReportesController@getResumenCondominio');
Route::get('periodoscerrados','ReportesController@getPeriodosCerrados');
Route::get('ultimosperiodos','ReportesController@getUltimosPeriodosCerrados');
Route::get('/cobranzas','ReportesController@cobranzas');
Route::get('/inmueblecobranza','ReportesController@inmuebleCobranza');
Route::get('resumen','ReportesController@resumenperiodo');
Route::get('periodosnombrecondo','ReportesController@getPeriodosNombreCondo');
Route::get('getnombrecondominio','ReportesController@getNombreCondominio');


//Reporte de Ingresos y Egresos
Route::resource('ingresosyegresos','RpIngresosEgresosCtlr');
Route::get('getingresosyegresos/{idPeriodo}','RpIngresosEgresosCtlr@getIngresosEgresos');
Route::get('emailingresosyegresos/{idCondominio}/{periodo}/','RpIngresosEgresosCtlr@emailingresosyegresos');

//Reporte Ingresos Periodo
Route::get('ingresosordinarios/{idPeriodo}','RpIngresosController@getIngresosOrdinarios');
Route::resource('ingresosperiodo','RpIngresosController');



Route::resource('cuotasgeneradas','CuotasOrdinariasController');

//Modificar Cuotas
Route::post('/buscar_cuotas','ModificarCuotasController@buscar');
Route::post('/modificar_cuota','ModificarCuotasController@modificar');
Route::resource('modificarcuotas','ModificarCuotasController');

//AnularGastos
Route::post('/buscar_gastos','AnularGastosController@buscar');
Route::post('/anular_gasto','AnularGastosController@anular');
Route::resource('anulargastos','AnularGastosController');


//AnularCobros
Route::post('/buscar_cobros','AnularCobrosController@buscar');
Route::post('/anular_cobro','AnularCobrosController@anular');
Route::resource('anularcobros','AnularCobrosController');

Route::resource('ingresosadicionales','IngresosAdicionalesController');
Route::get('ingresosadicionales/activar/{id}','IngresosAdicionalesController@activar');
Route::get('ingresosadicionales/desactivar/{id}','IngresosAdicionalesController@desactivar');


//Registro de Ingresos Adicionales
Route::resource('ingresosadicionalestemp','RegistraIngresosAController@ingresosTemp');
Route::resource('procesaingresostemp','RegistraIngresosAController@procesaIngresosTemp');
Route::get('validadatostemp','RegistraIngresosAController@validaDatosTemp');
Route::resource('regingresos','RegistraIngresosAController');


//FAQ
Route::resource('faq','FAQController');
Route::get('ayuda','FAQController@informacion');
Route::get('faqinfo','FAQController@dataInfo');
Route::get('faq/mostrar','FAQController@mostrar');
Route::get('faq/ocultar','FAQController@ocultar');


//Generar Cuotas Extra 
Route::resource('generacuotasextra','GeneraCuotasExtraController'); 


//Lost Password 
Route::get('lostpassword/recuperar/{code}','UsrPasswordForgotController@recuperar');
Route::resource('lostpassword','UsrPasswordForgotController');


//Config
Route::resource('configuracion','ConfigController');


//Log 
Route::resource('log','LogController');
Route::get('log/getlogperiodo/{periodo}','LogController@getLogPeriodo');

//Abrir Periodos
Route::get('abrirperiodo/periodos','AbrirPeriodoController@periodosCerrados');
Route::resource('abrirperiodo','AbrirPeriodoController');


//Contacto 
Route::resource('contacto','ContactoController');


Route::get('/nombre_condominio',"IndexController@nombreCondominio");
Route::get('/{url}',"IndexController@urlCondominio");


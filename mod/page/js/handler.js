/**
 * Handler
 * 
 * @author Mário Sakamoto <mskamot@gmail.com>
 * @license MIT http://www.opensource.org/licenses/MIT
 * @see http://mariosakamoto.com/getz
 */

/*
 * @example After response
 *
function tableRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		alert("Success!");
	else
		alert("Error!");

	if (method == "method")
		alert("method");
}
 */

/*
 * Insert you code here
 */

/*
 * @example After selecting the item in <select>
 *
function screen_tableSHDL() { 
	var select = cI("screen.reference");

	for (var i = 0; i < select.length; i++) {
		select.remove(i);
	}
}
 */
 
/*
 * Insert you code here
 */

/*
 * @example Execute after the render
 *
function screen_tableHDL() { }
 */
function homeHDL() {}
function tempo_hojeHDL() {
	graphic("altura_mar", altura_marl, altura_marc, "", "m", true, "#009688");		
	graphic("humidade_ar", humidade_arl, humidade_arc, "", "%", true, "#009688");
	graphic("humidade_solo", humidade_solol, humidade_soloc, "", "%", true, "#009688");
	graphic("pressao_ar", pressao_arl, pressao_arc, "", "", false, "#009688");	
	graphic("temperatura_ar", temperatura_arl, temperatura_arc, "", "º", true, "#009688");	
}

/*
 * Insert you code here
 */
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
function homeHDL() {
	graphic("temperaturas_diarias", temperaturas_diariasl, temperaturas_diariasc, "", "º", true, "#009688");	
	//graphic("pressao_ar", pressao_arl, pressao_arc, "", "hPa", false, "#009688");
}

/*
 * Insert you code here
 */
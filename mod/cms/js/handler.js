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

function loginRES(response, method) {
	var res = JSON.parse(response);

	if (method == "login") {
		if (res[0]["message"] == "success")
			goTo("/" + gz_home + "/1");	
		else
			showMessage(gz_titleAttetion, gz_msgErrorChangeInfo, "cancel();");
	}
}

function logoutRES(response, method) {
	var res = JSON.parse(response);
	
	if (method == "logout") {
		if (res[0]["message"] == "success")
			goTo("/login/1");
		else
			showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
	}
}

function minha_contaRES(response, method) {
	var res = JSON.parse(response);
	
	if (method == "update") {
		if (res[0]["message"] == "success")
			showMessage(gz_titleAttetion, gz_msgSuccess, "goTo('/" + gz_home + "/1');");		
		else
			showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
	}
}

function mudar_fotoRES(response, method) {
	var res = JSON.parse(response);
	
	if (method == "update") {
		if (res[0]["message"] == "success")
			showMessage(gz_titleAttetion, gz_msgSuccess, "goTo('/" + gz_home + "/1');");		
		else
			showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
	}
}

/*
 * Insert your code here
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
 * Insert your code here
 */	 
 
/*
 * @example Execute after the render
 *
function screen_tableHDL() { }
 */

function loginHDL() {
	sD(cI("gz-menu"), "none");
	
	/* Insert your code here... */ 
}

/*
 * Insert your code here
 */	
function dashboardHDL() { 
	//graphic("temperaturas", temperaturasl, temperaturasc, "", "º", true, "#009688");
	graphic("temperaturas_diarias", temperaturas_diariasl, temperaturas_diariasc, "", "º", true, "#009688");
	//graphic("pressoes", pressoesl, pressoesc, "", "hPa", true, "#009688");
	graphic("pressao_ar", pressao_arl, pressao_arc, "", "hPa", false, "#009688");
	//graphic("humidades", humidadesl, humidadesc, "", "%", true, "#009688");
	//graphic("solos", solosl, solosc, "", "%", true, "#009688");
	//graphic("alturas", alturasl, alturasc, "", "m", true, "#009688");
	// graphic("temperaturas_diarias", temperaturas_diariasl, temperaturas_diariasc, "", "º", true, "#009688");
}

function altura_marHDL() { /* Insert your code here... */ }
				
function altura_marRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function humidade_arHDL() { /* Insert your code here... */ }
				
function humidade_arRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function humidade_soloHDL() { /* Insert your code here... */ }
				
function humidade_soloRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function medicoesHDL() { /* Insert your code here... */ }
				
function medicoesRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function menusHDL() { /* Insert your code here... */ }
				
function menusRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function perfil_telasHDL() { /* Insert your code here... */ }
				
function perfil_telasRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function perfisHDL() { /* Insert your code here... */ }
				
function perfisRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function permissoesHDL() { /* Insert your code here... */ }
				
function permissoesRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function pressao_arHDL() { /* Insert your code here... */ }
				
function pressao_arRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function statusHDL() { /* Insert your code here... */ }
				
function statusRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function telasHDL() { /* Insert your code here... */ }
				
function telasRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function temasHDL() { /* Insert your code here... */ }
				
function temasRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function temperatura_arHDL() { /* Insert your code here... */ }
				
function temperatura_arRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function usuariosHDL() { /* Insert your code here... */ }
				
function usuariosRES(response, method) {
	var res = JSON.parse(response);

	if (res[0]["message"] == "success")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
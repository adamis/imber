/**
 * Getz JS for applications 1.0.0
 * 
 * @author Mário Sakamoto <mskamot@gmail.com>
 * @license MIT http://www.opensource.org/licenses/MIT
 * @see http://mariosakamoto.com/getz
 * @since 2014-07-26
 */
 
/*
 * Languages
 * pt-BR
 * en-US
 */ 
var language = "pt-BR"; 

/* 
 * Texts
 */
if (language == "pt-BR") {
	var gz_inputSearch = "Pesquisar por...";
	var gz_titleAttetion = "Atenção!";
	var gz_titleWait = "Aguarde!";
	var gz_titleConfirmation = "Confirmação!";
	var gz_msgErrorForm = "Existem erros no formulário! Tente novamente.";
	var gz_msgErrorPermission = "Este usuário não possui permissão para executar essa ação!";
	var gz_msgWait = "Os dados estão sendo carregados...";
	var gz_msgNoItemSelected = "Nenhum item foi selecionado! Tente novamente.";
	var gz_msgMoreThanOneItemSelected = "Existe mais de um item selecionado! Tente novamente.";
	var gz_msgConfirmDelete = "Deseja realmente excluir a(s) linha(s) selecionada(s)?";
	var gz_msgCloseMsg = "Fechar esta mensagem";
	var gz_msgCancelOperation = "Cancelar a operação";
	var gz_msgConfirmOperation = "Confirmar a operação";
	var gz_msgUpdateScreen = "Atualizar esta tela";
	var gz_msgLastPage = "Ir para a última página";
	var gz_msgNextPage = "Avançar uma página";
	var gz_msgBackPage = "Voltar uma página";
	var gz_msgFirsPage = "Ir para a primeira página";
	var gz_titleOf = "de";
	var gz_titlePagination = "Itens - Página";
	var gz_msgErrorServer = "O servidor não conseguiu responder! Tente novamente.";
	var gz_msgErrorChangeInfo = "E-mail ou senha incorreta! Tente novamente.";
	var gz_msgSuccess = "Ação concluída com sucesso!";
} else if (language == "en-US") {
	var gz_inputSearch = "Search for...";
	var gz_titleAttetion = "Attetion!";
	var gz_titleWait = "Wait!";
	var gz_titleConfirmation = "Confirmation!";
	var gz_msgErrorForm = "There are errors in the form! Try again.";
	var gz_msgErrorPermission = "This user does not have permission to perform this action!";
	var gz_msgWait = "Data is loading...";
	var gz_msgNoItemSelected = "No item was selected! Try again.";
	var gz_msgMoreThanOneItemSelected = "There is more than one selected item! Try again.";
	var gz_msgConfirmDelete = "Are you sure to delete the selected row(s)?";
	var gz_msgCloseMsg = "Close this message";
	var gz_msgCancelOperation = "Cancel the operation";
	var gz_msgConfirmOperation = "Confirm the operation";
	var gz_msgUpdateScreen = "Refresh this screen";
	var gz_msgLastPage = "Go to the last page";
	var gz_msgNextPage = "Next page";
	var gz_msgBackPage = "Previous page";
	var gz_msgFirsPage = "Go to the first page";
	var gz_titleOf = "of";
	var gz_titlePagination = "Items - Page";
	var gz_msgErrorServer = "The server could not answer! Try again.";
	var gz_msgErrorChangeInfo = "The e-mail or password is incorrect! Try again.";
	var gz_msgSuccess = "Successfully completed the action!";
}

// Window has focus
var gz_refresh = false;

/* 
 * Screen
 */
var gz_screenSearch = "";
var gz_screenPosition = "";
var gz_screenTable = "";
var gz_screenBase = "";
var gz_screenTheme = "";

// Key access
var gz_ctrlKey = false;

/* 
 * Begin aplication
 */
window.onload = view;
window.onfocus = reload;

/**
 * View
 */
function view() {		
    /*
	 * Selected Menu
	 */
	if (gz_screen != "login")
		sD(gP(gI("gz-" + gz_screen)), "block");
	
	if (gz_method == "stateCreate") create();
	else if (gz_method == "stateRead") read();
	else if (gz_method == "stateUpdate") update();
	else if (gz_method == "stateCalled") called();
}

/**
 * Reload
 */
function reload() {
	if (gz_refresh) {
		if (gD(gI("gz-screen")) == "block")
			goScreen();
		else
			toPage(gz_position);
	}
}

/**
 * Initialize the request
 */
function initRequest() {
    if (window.XMLHttpRequest) {
        if (navigator.userAgent.indexOf("MSIE") != -1)
            isIE = true;

        return new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        isIE = true;
		
        try {   	
            return new ActiveXObject("Microsoft.XMLHTTP");	
        } catch(e) {
    	    try {
    	        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    	    } catch(e) { }
        }
    }
}

/**
 * Create
 */
function create() {
	gz_historyBack = gz_historyBack - 1;
	event();	
	mask();
	eval(gz_screen + "HDL();");
}

/**
 * Read
 */
function read() {
	gz_historyBack = 0;
	event();
	mask();

	if (gz_search != "")
		sV(gI("gz-search"), gz_search);

	if (gz_order != "")
		colorOrderBy(gz_order);
		
	colorLine();
	eval(gz_screen + "HDL();");
}

/** 
 * Update
 */
function update() {	
	gz_historyBack = gz_historyBack - 1;
	event();
	mask();
	eval(gz_screen + "HDL();");
}

/**
 * Called
 */
function called() {
	gz_historyBack = gz_historyBack - 1;
	event();
	
	if (gz_search != "")
		sV(gI("gz-search"), gz_search);

	if (gz_order != "")
		colorOrderBy(gz_order);
		
	colorLine();
	eval(gz_screen + "HDL();");
}

/**
 * Go to Screen
 *
 * @param {String} id
 */
function goScreen() {
	sD(gI("gz-form"), "none");
	
	var combo = gz_screenTable.split(".");
	var table = combo[1];

	if (gz_screenPosition == "")
		gz_screenPosition = 1;

	var url = "";

	if (gz_screenSearch != "")
		url = gz_root + "/ws/" + table + "/sys-screen/" + gz_screenSearch + "/" + gz_screenPosition;	
	else	
		url = gz_root + "/ws/" + table + "/sys-screen/" + gz_screenPosition;

	var formData = new FormData();
	formData.append("form", "");
	formData.append("base", gz_screenBase);

	var req = initRequest();
	req.open("POST", url, true);
	req.send(formData);	

	req.onreadystatechange = function() { 
		if (req.readyState == 4 && req.status == 200) {
			if (req.responseText == "session")
				goTo("/login/custom");
			else {
				theme(req.responseText);
				
				sH(gI(table + "-screen"), response(req.responseText))

				if (gz_screenSearch != "")
					sV(gI("gz-search"), gz_screenSearch);		
						
				if (gz_screenPosition != "") 
					paginationScreen(table, counter(req.responseText));

				sD(gI("gz-block"), "block");
				
				// sF(gI("gz-search"));
				
				colorLine();
			}
		}
	};
}

/**
 * Go to Screen
 *
 * @param {String} id
 * @param {Integer} line
 */
function screenHandler(id, line) {
	var combo = id.split(".");
	var table = combo[1];
	
	url = gz_root + "/ws/" + table + "/sys-screenHandler/" + line;

	var formData = new FormData();
	formData.append("form", "");
	formData.append("base", gz_screenBase);
	
	var req = initRequest();
	req.open("POST", url, true);
	req.send(formData);	

	req.onreadystatechange = function() { 
		if (req.readyState == 4 && req.status == 200) {
			if (req.responseText == "session")
				goTo("/login/custom");
			else {
				if (gC(gI(id)).indexOf("gz-option") > 0)
					sH(gI(id), gH(gI(id)) + response(req.responseText));
				else
					sH(gI(id), response(req.responseText));

				closeScreen();
				
				eval(combo[0] + "_" + combo[1] + "SHDL();");
			}
		}
	};
}

/**
 * gz_search in Screen
 */
function screenSearch() {
	gz_screenSearch = (gV(gI("gz-search")) == gz_inputSearch ||
			gV(gI("gz-search")) == "") ? "" : gV(gI("gz-search"));

	gz_screenPosition = 1;
	
	goScreen();
}

/**
 * Option Remove
 * 
 * @param {String} id Select
 */
function optionRemove(id) {
	gI(id).remove(gI(id).selectedIndex);
}

/**
 * Option Remove Event
 * 
 * @param {String} id Select
 * @param {Event} e Event
 */
function optionRemoveEvent(id, e) {
	if (e.keyCode == 13)
		optionRemove(id);
}

/**
 * Action
 *
 * @param {String} table
 */
function request(table, method) {
	showLoading();
	
	var url = "";
	var formCheck = true;

	if (method == "create")
		url = gz_root + "/ws/" + table + "/sys-" + method;
	else if (method == "update" || method == "delete")
		url = gz_root + "/ws/" + table + "/sys-" + method + "/" + gz_code;
	else
		url = gz_root + "/ws/" + table + "/" + method;
			
	var formCheck = true;	

	if (method == "create" || method == "update" || method == "login") {
		if (!validate())		
			formCheck = false;
	}
	
	if (formCheck) {	
		var formData = new FormData();
		formData.append("form", getForm());
		formData.append("base", gz_base);
		
		if (gI("upload") != undefined) {
			var fileInput = gI("upload");
			
			if (fileInput.value != "")
				formData.append("upload", fileInput.files[0]);
		}
		
		var req = initRequest();
		req.open("POST", url, true);
		req.send(formData);	
		
		req.onreadystatechange = function() {
			if (req.readyState == 4 && req.status == 200) {
				closeLoading();
				
				var res = JSON.parse(req.responseText);
				
				if (res[0]["message"] == "session")
					goTo("/login/1");
				else if (res[0]["message"] == "permission")
					showMessage(gz_titleAttetion, gz_msgErrorPermission, 
							"cancel();");
				else
					eval(table + "RES('" + req.responseText + "', '" + method + "');");
			}
		};	
	} else {
		closeLoading();
		
		showMessage(gz_titleAttetion, gz_msgErrorForm, "");	
	}
}

function requestHandler(method) {
	if (gz_base != "") {
		if (gz_search != "") {
			if (gz_order != "")
				goTo("/" + gz_screen + "/called/" + 
						gz_base + "/search/" + gz_search + "/" + 
						gz_position + "/" + gz_order + "/historyBack/" + gz_historyBack);		
			else
				goTo("/" + gz_screen + "/called/" + 
						gz_base + "/search/" + gz_search + "/" + 
						gz_position + "/historyBack/" + gz_historyBack);
		} else {
			if (gz_order != "")
				goTo("/" + gz_screen + "/called/" +
						gz_base + "/" + gz_position + "/" + 
						gz_order + "/historyBack/"  + gz_historyBack);							
			else
				goTo("/" + gz_screen + "/called/" +
						gz_base + "/" + gz_position + "/historyBack/" + gz_historyBack);	
		}
	} else {
		if (gz_search != "") {
			if (gz_order != "")
				goTo("/" + gz_screen + "/search/" + gz_search + 
						"/" + gz_position + "/" + gz_order);		
			else
				goTo("/" + gz_screen + "/search/" + gz_search + 
						"/" + gz_position);
		} else {
			if (gz_order != "")
				goTo("/" + gz_screen + "/" + gz_position + "/" + 
						gz_order);							
			else
				goTo("/" + gz_screen + "/" + gz_position);
		}
	}
}

/**
 * Response
 *
 * @param {String} r Response
 * @return {String} The Response
 */
function response(r) {
	var retArr = r.split("<size>");

	return retArr[0];
}

/**
 * Counter
 *
 * @param {String} r Response
 * @return {Integer} The Size
 */
function counter(r) {
	var retArr = r.split("<size>");
	var retSize = retArr[1].split("<theme>");
	
	return retSize[0];
}

/**
 * Theme
 *
 * @param {String} r Response
 */
function theme(r) {
	var retArr = r.split("<theme>");
	
	gz_screenTheme = retArr[1];
}

/**
 * Get Form Elements Values
 *
 * @return {String} The Values
 */
function getForm() {
	var one = true;
	var option = true;
	var get = "";
	var repeat = false;

	if (gI("gz-form") != undefined) {
		var fields = gI("gz-form");
		
		for (var i = 0; i < gL(fields); i++) {
			if (gY(fields.elements[i]) != "submit") {
				if (i == 0 || repeat) {
					repeat = false;

					if (gY(fields.elements[i]) == "checkbox") 
						get = fields.elements[i].checked;
					else {
						if (gC(fields.elements[i]).indexOf("gz-option") > 0) {
							var options = fields.elements[i].options;
							
							for (var j = 0; j < options.length; j++) {
								option = false;
								
								if (j == 0)
									get = options[j].value;
								else
									get += "<,>" + options[j].value;
							}
						} else {
							if (gY(fields.elements[i]) == "textarea") {
								/*
								 * @see nicEdit.js
								 */	
								var textStyle = document.getElementsByClassName("nicEdit-main");
								
								if (gH(textStyle[0]) != undefined)
									get = gH(textStyle[0]);			
								else {
									var normalized_enters = gV(fields.elements[i]).replace(/\r|\n/g, "\r\n");
									var text_with_br = normalized_enters.replace(/\r\n/g, "<br />");
									
									get = (gL(gV(fields.elements[i])) == 0) ? 
											"null" : text_with_br;
								}
							} else {
								if (gY(fields.elements[i]) == "file")
									repeat = true;
								else			
									get = (gL(gV(fields.elements[i])) == 0) ? 
											"null" : gV(fields.elements[i]);
							}
						}
					}
				} else {
					if (gY(fields.elements[i]) == "checkbox") 
						get += "<gz>" + fields.elements[i].checked;
					else {
						if (gC(fields.elements[i]).indexOf("gz-option") > 0) {
							var options = fields.elements[i].options;
							
							for (var j = 0; j < options.length; j++) {
								if (option)
									get += options[j].value;
								else
									get += "<,>" + options[j].value;
							}
						} else {	
							if (gY(fields.elements[i]) == "textarea") {
								/*
								 * @see nicEdit.js
								 */
								var textStyle = document.getElementsByClassName("nicEdit-main");

								if (gH(textStyle[0]) != undefined)
									get += "<gz>" + gH(textStyle[0]);				
								else {
									var normalized_enters = gV(fields.elements[i]).replace(/\r|\n/g, "\r\n");
									var text_with_br = normalized_enters.replace(/\r\n/g, "<br />");
									
									get += "<gz>" + 
											((gL(gV(fields.elements[i])) == 0) 
											? "null" : text_with_br);
								}
							} else {
								if (gY(fields.elements[i]) != "file") {
									if (get != "") {
										one = false;
										
										get += "<gz>" + 
												((gL(gV(fields.elements[i])) == 0) 
												? "null" : gV(fields.elements[i]));
									} else {
										one = true;
										
										get += ((gL(gV(fields.elements[i])) == 0) 
												? "null" : gV(fields.elements[i]));	
									}
								}
							}
						}
					}
				}
			}
		}
	}

	if (one)
		get += "<gz>";
		
	return get;
}

/**
 * Combo Pagination Size
 *
 * @param {Integer} size
 */
function pagination(size) {
	if (gI("gz-select-pagination") != undefined) {
		var limit = Math.ceil(size / gz_itensPerPage);
	
		for (var line = 1; line <= limit; line++) {
			gI("gz-select-pagination").options[line] = new Option(line, line);

			if (line < 9999) {
				if (gI("gz-select-pagination").options[line].text == gz_position)
					gI("gz-select-pagination").options[line].selected = true;
			}
		}
	}
}

/**
 * Pagination The Screen
 *
 * @param {String} table
 * @param {Integer} size
 */
function paginationScreen(table, size) {
	var footer = 	
		"<div id=\"gz-footer-screen\" class=\"dv-f-l dv-pt-mdpi dv-pb-mdpi\" onclick=\"clearSelection();\">" +
			"<div class=\"dv-f-l dv-mt-hdpi dv-mr-mdpi dv-mb-mdpi dv-ml-xdpi\">" +
				"<p>" + size + " " + gz_titlePagination + "</p>" +
			"</div>" +
			"<select id=\"gz-select-pagination\" " + 
					"class=\"gz-select-hdpi dv-f-l dv-mt-mdpi dv-mr-mdpi dv-mb-mdpi\" " +
					"onchange=\"goPageScreen()\"></select>" +
			"<div class=\"dv-f-l dv-mt-hdpi dv-mr-hdpi dv-mb-mdpi dv-pr-mdpi\">" +
				"<p>" + gz_titleOf + " " + Math.ceil(size / 5) + "</p>" +
			"</div>" +
			"<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mr-hdpi dv-mb-mdpi\" " +
					"onclick=\"goFirstScreen();\">" +
				"<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\"> " +
					"<img src=\"" + gz_root + "/res/img/ldpi/first.png\" /> " +
					"<span class=\"gz-span-top-right " + gz_screenTheme + "\"> " +
						gz_msgFirsPage +
					"</span> " +
				"</a> " +
			"</div>" +	
			"<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mr-hdpi dv-mb-mdpi\" " +
					"onclick=\"goBackScreen();\">" +
				"<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\"> " +
					"<img src=\"" + gz_root + "/res/img/ldpi/back.png\" /> " +
					"<span class=\"gz-span-top-right " + gz_screenTheme + "\"> " +
						gz_msgBackPage +
					"</span> " +
				"</a> " +
			"</div>" +
			"<div id=\"gz-button-next\" class=\"gz-button dv-f-l dv-mt-mdpi dv-mr-hdpi dv-mb-mdpi\" " + 
					"onclick=\"goNextScreen(" + size + ");\">" +
				"<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\"> " +
					"<img src=\"" + gz_root + "/res/img/ldpi/next.png\" /> " +
					"<span class=\"gz-span-top-right " + gz_screenTheme + "\"> " +
						gz_msgNextPage +
					"</span> " +
				"</a> " +
			"</div>" +	
			"<div id=\"gz-button-last\" class=\"gz-button dv-f-l dv-mt-mdpi dv-mr-hdpi dv-mb-mdpi\" " + 
					"onclick=\"goLastScreen(" + size + ");\">" +
				"<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\"> " +
					"<img src=\"" + gz_root + "/res/img/ldpi/last.png\" /> " +
					"<span class=\"gz-span-top-right " + gz_screenTheme + "\"> " +
						gz_msgLastPage +
					"</span> " +
				"</a> " +
			"</div>" +	
			"<div id=\"gz-button-refresh\" class=\"gz-button dv-f-r dv-mt-mdpi dv-mr-xdpi dv-mb-mdpi\" " + 
					"onclick=\"goScreen();\">" +
				"<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\"> " +
					"<img src=\"" + gz_root + "/res/img/ldpi/refresh.png\" /> " +
					"<span class=\"gz-span-top-left " + gz_screenTheme + "\"> " +
						gz_msgUpdateScreen +
					"</span> " +
				"</a> " +
			"</div>" +				
		"</div>";

	sH(gI(table + "-screen-pagination"), footer);

	if (gI("gz-select-pagination") != undefined) {
		for (line = 1; line <= Math.ceil(size / 5); line++) {
			gI("gz-select-pagination").options[line] = new Option(line, line);

			if (gI("gz-select-pagination").options[line].text == gz_screenPosition)
				gI("gz-select-pagination").options[line].selected = true;
		}
	}
}

/**
 * Go To Page
 *
 * @param {Integer} p Page Position
 */
function toPage(p) {	
	if (gz_base != "") {
		if (gz_search != "") {
			if (gz_order != "")
				goTo("/" + gz_screen + "/called/" + 
						gz_base + "/search/" + gz_search + "/" + p + "/" + gz_order + "/historyBack/" + gz_historyBack);
			else
				goTo("/" + gz_screen + "/called/" +
						gz_base + "/search/" + gz_search + "/" + p + "/historyBack/" + gz_historyBack);
		} else {
			if (gz_order != "")
				goTo("/" + gz_screen + "/called/" +  
						gz_base + "/" + p + "/" + gz_order + "/historyBack/" + gz_historyBack);	
			else
				goTo("/" + gz_screen + "/called/" +  
						gz_base + "/" + p + "/historyBack/" + gz_historyBack);	
		}	
	} else {
		if (gz_search != "") {
			if (gz_order != "")
				goTo("/" + gz_screen + "/search/" + gz_search + "/" + p + "/" +
						gz_order);	
			else
				goTo("/" + gz_screen + "/search/" + gz_search + "/" + p);
		} else {
			if (gz_order != "")
				goTo("/" + gz_screen + "/" + p + "/" + gz_order);		
			else
				goTo("/" + gz_screen + "/" + p);
		}
	}
}

/**
 * Go To Page With Combo Position
 */
function goPage() {
	if (gV(gI("gz-select-pagination")) != "")
		toPage(gV(gI("gz-select-pagination")));
}

/**
 * Go To Page With Combo gz_position in Called Screen
 */
function goPageScreen() {
	if (gL(gV(gI("gz-select-pagination"))) != 0) {				
		gz_screenPosition = gV(gI("gz-select-pagination"));

		goScreen();
	}
}

/**
 * Go To First Page Position
 */
function goFirst() {
	toPage(1);
}

/**
 * Go To First Page gz_position in Called Screen
 */
function goFirstScreen() {	
	gz_screenPosition = 1;

	goScreen();
}

/**
 * Go To Back Page Position
 */
function goBack() {
	var p = (gz_position * 1) - 1;

	if (p < 1)
		p = 1;

	toPage(p);
}

/**
 * Go To Back Page gz_position in Called Screen
 */
function goBackScreen() {
	var p = (gz_screenPosition * 1) - 1;

	if (p < 1)
		p = 1;
		
	gz_screenPosition = p;

	goScreen();
}

/**
 * Go To Next Page Position
 *
 * @param {Integer} size
 */
function goNext(size) {
	var p = (gz_position * 1) + 1;
	
	if (p >= Math.ceil(size / gz_itensPerPage))
		goLast(size);
	else
		toPage(p);
}

/**
 * Go To Next Page gz_position in Called Screen
 *
 * @param {Integer} size
 */
function goNextScreen(size) {
	var p = (gz_screenPosition * 1) + 1;

	if (p >= Math.ceil(size / 5))
		goLastScreen(size);
	else {
		gz_screenPosition = p;
		
		goScreen();
	}
}

/**
 * Go To Last Page Position
 *
 * @param {Integer} size
 */
function goLast(size) {
	if (size > gz_itensPerPage) {
		var zero = "";
		var p = 0;

		for (var i = gL("" + size); i <= gL("" + size); i++) {
			zero += "0"; 
		}

		var end = (Math.ceil(size / gz_itensPerPage)) + zero;
		
		/*
 		 * !important 10
		 */
		p = end - 10;
		p = (p / 10) + 1;
		
		toPage(p);
	}
}

/**
 * Go To Last Page gz_position in Called Screen
 *
 * @param {Integer} size
 */
function goLastScreen(size) {
	if (size > 5) {
		var zero = "";
		var p = 0;

		for (var i = gL("" + size); i <= gL("" + size); i++) {
			zero += "0"; 
		}

		var end = (Math.ceil(size / 5)) + zero;
		
		/*
 		 * !important 10
		 */
		p = end - 10;
		p = (p / 10) + 1;
 		
		gz_screenPosition = p;
		
		goScreen();
	}
}

/**
 * Event Construct
 */
function event() {
	document.body.onkeydown = function(event) {
		goToEvent(event);
	}

	document.body.onkeyup = function(event) {
		keyReset(event);
	}
}

/**
 * Go To The Specific Event
 *
 * @param {Event} e Event
 */
function goToEvent(e) {
	if (e.keyCode == 17)
		gz_ctrlKey = true;
	else if (e.keyCode == 13) {
		if (gD(gI("gz-message")) == "block") {
			
		} else if (getSelectedLineId() == "") {
			if (gz_method == "stateRead" || gz_method == "stateCalled")
				eval(gA(gI("gz-button-search"), "onclick"));
			else if (gz_method == "stateCreate" || gz_method == "stateUpdate" 
					|| gz_method == "statePrint") {
				if (gD(gI("gz-screen")) == "block")
					eval(gA(gI("gz-button-search"), "onclick"));
				else { 
					var fields = gI("gz-form");

					if (gL(fields) == 1) {
						if (fields[0] == document.activeElement)
							e.returnValue = false; 
					}
				}
			}		
		} else {
			if (gD(gI("gz-screen")) == "block")	
				screenHandler(gz_screenTable, getSelectedLineId());
			else {
				e.preventDefault();
				
				showUpdate();
			}
		}
	} else if (e.keyCode == 45) {		
		if (gD(gI("gz-screen")) == "block")		
			eval(gI("gz-button-create").getAttribute("onclick"));
		else {
			if (gI("gz-button-create").getAttribute("onclick") == "showCreate();")
				showCreate();
			else
				eval(gz_screen + "ACT();");	
		}
	} else if (e.keyCode == 46) {
		if (gz_method == "stateRead" || gz_method == "stateCalled")
			showDelete();
	} else if (e.keyCode == 37) {
		if (gz_method == "stateRead" || gz_method == "stateCalled") {
			if (gD(gI("gz-message")) == "none" || gD(gI("gz-message")) == "") {
				if (gI("gz-search") != document.activeElement)
					goBack();
			}
		} else if (gD(gI("gz-screen")) == "block") {
			if (gI("gz-search") != document.activeElement)
				goBackScreen();
		}
	} else if (e.keyCode == 38) {
		if (gz_method == "stateRead" || gz_method == "stateCalled") {
			if (gD(gI("gz-message")) == "none" || gD(gI("gz-message")) == "") {
				if (gz_ctrlKey) {
					if (getSelectedLineId() != "") {
						if (getSelectedLineUp() != 0)
							selected(getSelectedLineUp() - 1);
					} else
						selected(getCountLine() - 1);
				} else {
					if (getSelectedLineId() != "") {
						if (getSelectedLineUp() != 0)
							selected(getSelectedLineUp() - 1);
					} else
						selected(getCountLine() - 1);
				}
			}
		} else if (gD(gI("gz-screen")) == "block") {
			if (getSelectedLineId() != "") {
				if (getSelectedLineUp() != 0)
					selected(getSelectedLineUp() - 1);
			} else
				selected(getCountLine() - 1);
		}
	} else if (e.keyCode == 39) {
		if (gz_method == "stateRead" || gz_method == "stateCalled") {
			if (gD(gI("gz-message")) == "none" || gD(gI("gz-message")) == "") {
				if (gI("gz-search") != document.activeElement)
					eval(gA(gI("gz-button-next"), "onclick"));
			}
		} else if (gD(gI("gz-screen")) == "block") {
			if (gI("gz-search") != document.activeElement)
				eval(gA(gI("gz-button-next"), "onclick"));
		}
	} else if (e.keyCode == 40) {
		if (gz_method == "stateRead" || gz_method == "stateCalled") {
			if (gD(gI("gz-message")) == "none" || gD(gI("gz-message")) == "") {
				if (getSelectedLineId() != "") {	
					if (getSelectedLine() != (getCountLine() - 1))
						selected(getSelectedLine() + 1);
				} else
					selected(0);
			}
		} else if (gD(gI("gz-screen")) == "block") {
			if (getSelectedLineId() != "") {
				if (getSelectedLine() != (getCountLine() - 1))
					selected(getSelectedLine() + 1);
			} else
				selected(0);
		}
	} else if (e.keyCode == 27) {
		if (gD(gI("gz-message")) == "block") {
			if (gH(gI("gz-message-title")) == gz_titleAttetion ||
					gH(gI("gz-message-title")) == gz_titleConfirmation ||
					gH(gI("gz-message-title")) == gz_titleWait)
				closeMessage();
		} else {						
			if (gD(gI("gz-screen")) == "block")
				closeScreen();
			else if (gD(gI("gz-form-screen")) == "block")
				window.close();
			else if (gz_method == "stateCreate" || gz_method == "stateUpdate")
				cancel();
			else {
				if (getSelectedLineId() != "")
					clearSelection();
			}
		}
	} else if (e.keyCode == 36) {
		if (gz_method == "stateRead" || gz_method == "stateCalled") {
			if (gD(gI("gz-message")) == "none" || gD(gI("gz-message")) == "")
				goFirst();
		} else if (gD(gI("gz-screen")) == "block")
			goFirstScreen();
	} else if (e.keyCode == 35) {
		if (gz_method == "stateRead" || gz_method == "stateCalled") {
			if (gD(gI("gz-message")) == "none" || gD(gI("gz-message")) == "")
				eval(gA(gI("gz-button-last"), "onclick"));
		} else if (gD(gI("gz-screen")) == "block")
			eval(gA(gI("gz-button-last"), "onclick"));
	} else if (e.keyCode == 33) {
		if (gz_method == "stateRead" || gz_method == "stateCalled") {
			if (gD(gI("gz-message")) == "none" || gD(gI("gz-message")) == "")
				eval(gA(gI("gz-button-next"), "onclick"));
		} else if (gD(gI("gz-screen")) == "block")
			eval(gA(gI("gz-button-next"), "onclick"));
	} else if (e.keyCode == 34) {
		if (gz_method == "stateRead" || gz_method == "stateCalled") {
			if (gD(gI("gz-message")) == "none" || gD(gI("gz-message")) == "")
				goBack();
		} else if (gD(gI("gz-screen")) == "block")
			goBackScreen();
	}
}

/**
 * Console rule Reset Key
 *
 * @param {Event} e Event
 */
function keyReset(e) {
	if (e.keyCode == 17)
		gz_ctrlKey = false;
}

/*
 * Remove CTRL + J
 */
function ctrlJ(e) {
	var tecla = e.keyCode;
	var ctrl = e.ctrlKey;

	if (ctrl && tecla == 74)
		e.returnValue = false;
}

/**
 * Go To Table Link
 *
 * @param {String} table
 * @since 1.0.0
 */
function goToTable(table) {
	location.href = gz_root + gz_module + "/" + table + "/1";
}

/**
 * Target blank
 *
 * @param {String} table
 */
function target_blank(table) {
	window.open(gz_root + gz_module + "/" + table + "/1");
}

/**
 * Go To Link
 *
 * @param {String} link
 */
function goTo(link) {
	location.href = gz_root + gz_module + link;
}

/**
 * Go To Link With Target Blank
 *
 * @param {String} link
 */
function goToBlank(link) {
	window.open(gz_root + gz_module + link);
}

/**
 * Similar <a href="link" target="_blank"></a>
 *
 * @param {String} link
 */
function href(link) {
	window.open(link);
}

/**
 * Go To Link With Searh
 *
 * @param {String} link
 */
function goSearch() {
	if (gz_base != "") {
		goTo(gV(gI("gz-search")) == gz_inputSearch ||
				gV(gI("gz-search")) == "" 
				? "/" + gz_screen + "/called/" + "/" + gz_base + "/1" + "/historyBack/" + gz_historyBack
				: "/" + gz_screen + "/called/" + "/" + gz_base + 
				"/search/" + removeBar(gV(gI("gz-search"))) + "/1" + "/historyBack/" + gz_historyBack);
	} else { 
		goTo(gV(gI("gz-search")) == gz_inputSearch ||
				gV(gI("gz-search")) == "" 
				? "/" + gz_screen + "/1"
				: "/" + gz_screen + "/search/" + 
				removeBar(gV(gI("gz-search"))) + "/1");
	}
}

/**
 * Render Color Line
 */
function colorLine() {
	var table = gT("table");

    for (var i = 0; i < gL(table); i++) {
    	var tr = table[i].getElementsByTagName("tr");

        for (var j = 0; j < gL(tr); j++) {
			if (j == 0)
				sC(tr[j], "noSelected");

			var td = tr[j].getElementsByTagName("td");

			for (var k = 0; k < gL(td); k++) {
				sBt(td[k], "solid 1px #e9e9e9");
				sBb(td[k], "solid 1px transparent");
			}

        	if (j % 2 == 0)
        		sG(tr[j], "transparent");
        	else 
        		sG(tr[j], "transparent");
        }
    }
}

/**
 * On Focus Line
 *
 * @param {Integer} line
 */
function onFocus(line) {
    if (gC(gI(line)) != "selected") {
		var td = gI(line).getElementsByTagName("td");
	
		for (var i = 0; i < gL(td); i++) {
			sBt(td[i], "solid 1px #90caf9");
			sBb(td[i], "solid 1px #90caf9");
		}

    	sG(gI(line), "linear-gradient(#ffffff, #e3f2fd)");
	}
}

/**
 * Out Focus Line
 *
 * @param {Integer} line
 */
function outFocus(line) {
    if (gC(gI(line)) != "selected") {
		var td = gI(line).getElementsByTagName("td");
	
		for (var i = 0; i < gL(td); i++) {
			sBt(td[i], "solid 1px #e9e9e9");
			sBb(td[i], "solid 1px transparent");
		}
		
    	if (line % 2 == 0)
    		sG(gI(line), "transparent");
    	else
    		sG(gI(line), "transparent");
    }
}

/**
 * Selected Line
 *
 * @param {Integer} line
 */
function selected(line) {
	gI("gz-search").blur();
	gI("gz-select-pagination").blur();

	if (gC(gI(line)) == "selected") {
		if (gD(gI("gz-screen")) == "block")
			screenHandler(gz_screenTable, getSelectedLineId());
		else if (gz_ctrlKey) {
			if (gC(gI(line)) == "selected") {
				if (line % 2 == 0)
					sG(gI(line), "transparent");
				else
					sG(gI(line), "transparent");
					
				sC(gI(line), "noSelected");
			} else {
				sG(gI(line), "linear-gradient(#ffffff, #e3f2fd)");
				sC(gI(line), "selected");
			}
		} else
			showUpdate();
	} else {
		if (gz_ctrlKey) {
			var td = gI(line).getElementsByTagName("td");
		
			for (var i = 0; i < gL(td); i++) {
				sBt(td[i], "solid 1px #90caf9");
				sBb(td[i], "solid 1px #90caf9");
			}

			sG(gI(line), "linear-gradient(#ffffff, #e3f2fd)");
			sC(gI(line), "selected");
		} else {
			var table = gT("table");
			
			for (var i = 0; i < gL(table); i++) {
				var tr = gN(table[i], "tr");
				
				for (var j = 0; j < gL(tr); j++) {
					sC(tr[j], "noSelected");
				}
			}

			colorLine();
			
			sC(gI(line), "selected");
			
			var td = gI(line).getElementsByTagName("td");
		
			for (var i = 0; i < gL(td); i++) {
				sBt(td[i], "solid 1px #90caf9");
				sBb(td[i], "solid 1px #90caf9");
			}

			sG(gI(line), "linear-gradient(#ffffff, #e3f2fd)");
		}
	}
}

/**
 * Selected All Line
 */
function selectedAll() {
	gI("gz-search").blur();
	gI("gz-select-pagination").blur();
	
	var table = gT("table");
	
	for (var i = 0; i < gL(table); i++) {
		var tr = gN(table[i], "tr");
		
		for (var j = 0; j < gL(tr); j++) { 
			if (j > 0) {
				sG(tr[j], "linear-gradient(#ffffff, #e3f2fd)");
				sC(tr[j], "selected");
				
				var td = gI(tr[j].id).getElementsByTagName("td");
			
				for (var k = 0; k < gL(td); k++) {
					sBt(td[k], "solid 1px #90caf9");
					sBb(td[k], "solid 1px #90caf9");
				}		
			}
		}
	}
}

/**
 * Clear Selected Line
 */
function clearSelection() {
	var table = gT("table");
	
	for (var i = 0; i < gL(table); i++) {
		var tr = gN(table[i], "tr");
		
		for (var j = 0; j < gL(tr); j++) {
			sC(tr[j], "noSelected");
		}
	}

	colorLine();
}

/**
 * Get Selected Line
 *
 * @return {Integer} The Selected Line
 */
function getSelectedLine() {
	var ret = "";
	var table = gT("table");
	var tr = gN(table[0], "tr");

	for (var i = 0; i < gL(tr); i++) {
		if (gC(tr[i]) == "selected")
			ret = i - 1;	
	}

	return ret;
}

/**
 * Get Line Up
 *
 * @param {Integer} The Selected Line Up
 */
function getSelectedLineUp() {
	var ret = "";
	var table = gT("table");
	var tr = gN(table[0], "tr");
	
	for (var i = 0; i < gL(tr); i++) {
		if (gC(tr[i]) == "selected")
			return (i - 1);
	}

    return ret;
}

/**
 * Get Selecteds Lines Ids
 *
 * @return {String} The Selecteds Lines
 */
function getSelectedLineId() {
	var ret = "";
	var table = gT("table");
	
    for (var i = 0; i < gL(table); i++) {
		var tr = gN(table[i], "tr");
		
        for (var j = 0; j < gL(tr); j++) {
        	if (gC(tr[j]) == "selected") {
				var td = gN(tr[j], "td");

				ret += "<gz>" + gH(td[0]);
        	}	
        }
    }

    return ret;
}

/**
 * Get No Selecteds Lines
 *
 * @return {Integer} The No Selecteds Lines
 */
function getNoSelectedLine() {
	var ret = 0;
	var table = gT("table");
	
    for (var i = 0; i < gL(table); i++) {
		var tr = gN(table[i], "tr");
		
        for (var j = 0; j < gL(tr); j++) {
        	if (gC(tr[j]) == "noSelected")
				ret++;
        }
    }

    return ret;
}

/**
 * Get Line Size
 *
 * @return {Integer} The Size
 */
function getCountLine() {
	var ret = "";
	var table = gT("table");
	
    for (var i = 0; i < gL(table); i++) {
		var tr = gN(table[i], "tr");
		
        for (var j = 0; j < gL(tr); j++) {
			ret = j;
        }
    }

    return ret;
}

/**
 * Show Loading
 */
function showLoading() {
	sD(gI("gz-loading"), "block");

	sH(gI("gz-loading"),
			"<h1 id=\"gz-message-title\" class=\"dv-ta-l dv-mt-hdpi dv-mb-mdpi dv-pb-mdpi\">" + gz_titleWait + "</h1>" +
			"<p class=\"dv-ta-l dv-pt-mdpi dv-mb-xdpi\">" + gz_msgWait + "</p>" +	
			"<div id=\"gz-loader\" class=\"dv-mt-xdpi\"></div>" +
		"</div>");

	sD(gI("gz-block"), "block");
}

/**
 * Close Loading
 */
function closeLoading() {
	sD(gI("gz-loading"), "none");
	sD(gI("gz-block"), "none");
}

/**
 * Show Message
 *
 * @param {String} gz_title 
 * @param {String} message
 * @param {Function} action
 */
function showMessage(gz_title , message, action) {
	sD(gI("gz-block"), "block");
	sD(gI("gz-message"), "block");

	if (gz_title == gz_titleConfirmation) {
		sH(gI("gz-message"),
				"<h1 id=\"gz-message-title\" class=\"dv-ta-l dv-mt-hdpi dv-mb-mdpi dv-pb-mdpi\">" + 
						gz_title  + "</h1>" +
				"<p class=\"dv-ta-l dv-pt-mdpi dv-mb-mdpi dv-pb-mdpi\">" + message + "</p>" +
				"<div class=\"gz-button dv-f-l dv-mt-hdpi dv-mr-mdpi\">" +
					"<a href=\"#\" onclick=\"" + action + " closeMessage(); return false;\"  class=\"gz-tooltip\">" +
						"<img src=\"" + gz_root + "/res/img/ldpi/ok.png\" />" +
						"<span class=\"gz-span-msg\">" +
							gz_msgConfirmOperation +
						"</span>" +
					"</a>" +
				"</div>" +
				"<div class=\"gz-button dv-f-l dv-mt-hdpi dv-ml-mdpi\">"+					
					"<a id=\"gz-a-cancel\" href=\"#\" onclick=\"closeMessage(); return false;\"  class=\"gz-tooltip\">" +
						"<img src=\"" + gz_root + "/res/img/ldpi/cancel.png\">" +
						"<span class=\"gz-span-msg\">" +
							gz_msgCancelOperation +
						"</span>" +
					"</a>" +
				"</div>");

		sF(gI("gz-a-cancel"));
	} else if (gz_title == gz_titleAttetion) {
		sH(gI("gz-message"),
				"<h1 id=\"gz-message-title\" class=\"dv-ta-l dv-mt-hdpi dv-mb-mdpi dv-pb-mdpi\">" + 
						gz_title  + "</h1>" +
				"<p class=\"dv-ta-l dv-pt-mdpi dv-mb-mdpi dv-pb-mdpi\">" + message + "</p>" +
				"<div class=\"gz-button dv-f-l dv-mt-hdpi\">" +
					"<a id=\"gz-a-action\" href=\"#\" onclick=\"closeMessage(); " + action + " return false;\"  class=\"gz-tooltip\">" +
						"<img src=\"" + gz_root + "/res/img/ldpi/ok.png\">" +
						"<span class=\"gz-span-msg\">" +
							gz_msgCloseMsg +
						"</span>" +
					"</a>" +
				"</div>");

		sF(gI("gz-a-action"));
	} else if (gz_title == gz_titleWait) {
		sH(gI("gz-message"),
				"<h1 id=\"gz-message-title\" class=\"dv-ta-l dv-mt-hdpi dv-mb-mdpi dv-pb-mdpi\">" + 
						gz_title  + "</h1>" +
				"<p class=\"dv-ta-l dv-pt-mdpi dv-mb-mdpi dv-pb-mdpi\">" + message + "</p>" +	
				"<img src=\"" + gz_root + "/res/img/ldpi/loading.gif\" class=\"dv-mt-hdpi\"/>" +
			"</div>");
	}
}

/**
 * Close Message
 */
function closeMessage() {
	sD(gI("gz-message"), "none");
	sD(gI("gz-block"), "none");
}

/**
 * Call For Any Screen
 *
 * @param {String} id Table Screen
 * @param {String} selectId Select
 */
function showScreen(id, selectId) {
	gz_refresh = true;
	gz_screenTable = id;

	var selectBase = gV(gI(selectId));
	var combo = gz_screenTable.split(".");
	var table = combo[1];

	if (selectId != "") {
		if (selectBase == "")
			showMessage(gz_titleAttetion, gz_msgNoItemSelected, "");
		else {
			gz_screenBase = gz_base + "<gz>" + selectBase;
			
			sD(gI("gz-screen"), "block");

			sH(gI("gz-screen"), 
					"<div id=\"" + table + "-screen\"></div>" +
					"<div id=\"" + table + "-screen-pagination\"></div>");

			sD(gI("gz-block"), "block");

			goScreen();
		}
	} else {
		gz_screenBase = gz_base;
	
		sD(gI("gz-screen"), "block");

		sH(gI("gz-screen"), 
				"<div id=\"" + table + "-screen\"></div>" +
				"<div id=\"" + table + "-screen-pagination\"></div>");

		sD(gI("gz-block"), "block");

		goScreen();
	}
}

/**
 * Call For Any Screen with a filter
 *
 * @param {String} id Table Screen
 * @param {Integer} filter Filter
 */
function showFilterScreen(id, filter) {
	gz_refresh = true;
	gz_screenTable = id;

	var combo = gz_screenTable.split(".");
	var table = combo[1];

	if (filter != "") {
		gz_screenBase = gz_base + "<gz>" + filter;
		
		sD(gI("gz-screen"), "block");

		sH(gI("gz-screen"), 
				"<div id=\"" + table + "-screen\"></div>" +
				"<div id=\"" + table + "-screen-pagination\"></div>");

		sD(gI("gz-block"), "block");

		goScreen();
	} else {
		gz_screenBase = gz_base;
	
		sD(gI("gz-screen"), "block");

		sH(gI("gz-screen"), 
				"<div id=\"" + table + "-screen\"></div>" +
				"<div id=\"" + table + "-screen-pagination\"></div>");

		sD(gI("gz-block"), "block");

		goScreen();
	}
}

/**
 * Close Called Screen
 */
function closeScreen() {
	gz_refresh = false;
	
	sD(gI("gz-form"), "");
	sD(gI("gz-screen"), "none");
	sD(gI("gz-block"), "none");

	clearSelection();

	sF(gI(gz_screenTable));

	gz_screenTable = "";
	gz_screenSearch = "";
	gz_screenPosition = "";
}

/**
 * Screen Enter Event
 * 
 * @param {String} id Table Screen
 * @param {String} selectId Select
 * @param {Event} e Event
 */
function showScreenEvent(id, selectId, e) {
	if (e.keyCode == 13) {
		e.preventDefault();
		
		showScreen(id, selectId);
	}
}

/**
 * Screen Enter Event
 * 
 * @param {String} id Table Screen
 * @param {Integer} filter Filter
 * @param {Event} e Event
 */
function showFilterScreenEvent(id, filter, e) {
	if (e.keyCode == 13) {
		e.preventDefault();
		
		showFilterScreen(id, filter);
	}
}

/**
 * Check Empty in Search
 *
 * @param {String} id Input Id
 */
function emptySearch(id) {
	var element = gI(id);
	var defaultValue = element.defaultValue;
	var value = gV(element);
    
	if (defaultValue == value)
		sV(element, "");

	sO(element, "#455a64");
	
	clearSelection();
}

/**
 * gz_search Default Value
 *
 * @param {String} id Table Screen
 */
function showSearch(id) {
	var element = gI(id);
	var defaultValue = element.defaultValue;
	var value = gV(element);    

	if (value == "")
		sV(element, gz_inputSearch);

	sO(element, "#9e9e9e");
}

function historyBack() {
	window.history.go(-1);
}

function cancel() {
	toPage(gz_position);
}

/**
 * Go To Create Screen
 */
function showCreate() {
	if (gz_screenTable != "") {
		var screenName = gz_screenTable.split(".");
			
		goToBlank("/" + screenName[1] + "/create/");				
	} else {
		if (gz_base != "") {
			if (gz_search != "") {
				if (gz_order != "")
					goTo("/" + gz_screen + "/called/" +
							gz_base + "/create/" + gz_search + "/" + gz_position + "/" + gz_order + "/historyBack/" + gz_historyBack);			
				else
					goTo("/" + gz_screen + "/called/" +  
							gz_base + "/create/" + gz_search + "/" + gz_position + "/historyBack/" + gz_historyBack);
			} else {
				if (gz_order != "")
					goTo("/" + gz_screen + "/called/" +  
							gz_base + "/create/" + gz_position + "/" + gz_order + "/historyBack/" + gz_historyBack);			
				else
					goTo("/" + gz_screen + "/called/" + 
							gz_base + "/create/" + gz_position + "/historyBack/" + gz_historyBack);
			}
		} else { 
			if (gz_search != "") {
				if (gz_order != "")
					goTo("/" + gz_screen + "/create/" + gz_search + "/" + gz_position + "/" + gz_order);			
				else
					goTo("/" + gz_screen + "/create/" + gz_search + "/" + gz_position);
			} else {
				if (gz_order != "")
					goTo("/" + gz_screen + "/create/" + gz_position + "/" + gz_order);			
				else
					goTo("/" + gz_screen + "/create/" + gz_position);
			}
		}
	}
}

/**
 * Go To Update Screen
 */
function showUpdate() {
	var lines = getSelectedLineId().split("<gz>");

	if (gL(lines) > 2) {
		showMessage(gz_titleAttetion, gz_msgMoreThanOneItemSelected, "");		
	} else {
		if (gz_base != "") {
			if (gz_search != "") {
				if (gz_order != "")
					goTo("/" + gz_screen + "/called/" + gz_base + 
							"/update/" + lines[1] + "/" + gz_search + "/" + gz_position + 
							"/" + gz_order + "/historyBack/" + gz_historyBack);				
				else
					goTo("/" + gz_screen + "/called/" + gz_base + 
							"/update/" + lines[1] + "/" + gz_search + "/" + gz_position + "/historyBack/" + gz_historyBack);
			} else {
				if (gz_order != "")
					goTo("/" + gz_screen + "/called/" + gz_base + 
							"/update/" + lines[1] + "/" + gz_position + "/" + gz_order + "/historyBack/" + gz_historyBack);				
				else 
					goTo("/" + gz_screen + "/called/" + gz_base + 
							"/update/" + lines[1] + "/" + gz_position + "/historyBack/" + gz_historyBack);
			}
		} else { 
			if (gz_search != "") {
				if (gz_order != "")
					goTo("/" + gz_screen + "/update/" + lines[1] + "/" + gz_search + "/" +
							gz_position + "/" + gz_order);				
				else
					goTo("/" + gz_screen + "/update/" + lines[1] + "/" + gz_search + "/" +
							gz_position);
			} else {
				if (gz_order != "")
					goTo("/" + gz_screen + "/update/" + lines[1] + "/" + gz_position + 
							"/" + gz_order);	
				else
					goTo("/" + gz_screen + "/update/" + lines[1] + "/" + gz_position);
			}
		}
	}
}

/**
 * Go To Delete Screen
 */
function showDelete() {
	if (getSelectedLineId() != "")
		showMessage(gz_titleConfirmation, gz_msgConfirmDelete, 
				"goDelete('" + getSelectedLineId() + "');");
	else
		showMessage(gz_titleAttetion, gz_msgNoItemSelected, "");
}

/**
 * Go To Called Screen
 *
 * @param {String} t Table Screen
 */
function goCalled(t) {
	var lines = getSelectedLineId().split("<gz>");

	if (getSelectedLineId() == "")
		showMessage(gz_titleAttetion, gz_msgNoItemSelected, "");
	else if (lines.length > 2) {
		showMessage(gz_titleAttetion, gz_msgMoreThanOneItemSelected, "");
	} else			
		goTo("/" + t + "/called/" + lines[1] + "/1/historyBack/" + gz_historyBack);
}

/**
 * Go To Called Screen with base
 *
 * @param {String} t Table Screen
 */
function goCalledBase(t) {
	if (gz_base == "")
		showMessage(gz_titleAttetion, gz_msgNoItemSelected, "");
	else			
		goTo("/" + t + "/called/" + gz_base + "/1/historyBack/" + gz_historyBack);
}

/**
 * Go To Called Screen With Search
 *
 * @param {String} t Table Screen
 */
function goCalledSearch(t) {	
	goTo(gV(gI("gz-search")) == gz_inputSearch ||
			gV(gI("gz-search")) == "" 
			? "/" + t + "/called/" + gz_base + "/1/historyBack/" + gz_historyBack
			: "/" + t + "/called/" + gz_base + "/search/" + 
			gV(gI("gz-search")) + "/1/historyBack/" + gz_historyBack);
}

/**
 * Go To Print Screen
 */
function goPrint() {
	goToBlank("/" + gz_screen + "/print");
}

/**
 * Go To Report Screen
 *
 * @param {String} r Report
 */
function goReport(r) {
	goToBlank("/" + gz_screen + "/report/" + r + "/" + removeBar(getForm()));
}

/**
 * Remove Bar
 *
 * @param {String} str String
 */
function removeBar(str) {
	return str.replace(/\//g, "-");
}

/**
 * Add Bar
 *
 * @param {String} str String
 */
function addBar(str) {
	return str.replace(/\-/g, "/");
}

/**
 * Delete Action
 *
 * @param {Integer} line
 */
function goDelete(line) {
	if (getNoSelectedLine() == 1)
		gz_position = gz_position - 1;
	else if (getCountLine() == 1)
		gz_position = gz_position - 1;

	if (gz_position < 1)
		gz_position = 1;
		
	gz_code = line;
		
	request(gz_screen, "delete");
}

/**
 * Ordenation
 *
 * @param {String} order
 */
function orderBy(order) {
	var type = "";
	
	var table = gT("table");

	if (gC(gI(order)) == "ASC")
		type = "DESC";
	else
		type = "ASC";
		
	if (gz_base != "") {
		if (gz_search != "")
			goTo("/" + gz_screen + "/called/" + 
					gz_base + "/search/" + gz_search + "/" + gz_position + "/" + 
					order + "<gz>" + type + "/historyBack/" + gz_historyBack);
		else
			goTo("/" + gz_screen + "/called/" +
					gz_base + "/" + gz_position + "/" + order + "<gz>" + type + "/historyBack/" + gz_historyBack);
	} else {
		if (gz_search != "")
			goTo("/" + gz_screen + "/search/" + gz_search + "/" + gz_position +
					"/" + order + "<gz>" + type);
		else
			goTo("/" + gz_screen + "/" + gz_position + "/" + order + 
					"<gz>" + type);	
	}
}

/**
 * Set Effect in Order
 *
 * @param {String} o Order
 */ 
function colorOrderBy(o) {
	var order = o.split("<gz>");

	var table = gT("table");
	
    for (var i = 0; i < gL(table); i++) {
		var th = gN(table[i], "th");

        for (var j = 0; j < gL(th); j++) {
			if (th[j].id == order[0]) {
				if (order[1] == "ASC") {
					sC(gI(order[0]), "ASC");
					// sO(gI(order[0]), "#2C3E50");
					
					sG(gI(order[0]), "url(" + gz_root + 
							"/res/img/ldpi/up.png) no-repeat right center, linear-gradient(#ffffff, #e9e9e9)");
				} else {
					sC(gI(order[0]), "DESC");
					// sO(gI(order[0]), "#2C3E50");
					
					sG(gI(order[0]), "url(" + gz_root + 
							"/res/img/ldpi/down.png) no-repeat right center, linear-gradient(#ffffff, #e9e9e9)");
				}
			}
        }
    }
}

/**
 * Mask Preparation
 */
function mask() {
	var pattern = "";
	
	var inputs = gT("input");

	for (var i = 0; i < gL(inputs); i++) {
		if (gC(inputs[i]).indexOf("gz-datetime") > 0)
			pattern = "__/__/____ __:__";
		else if (gC(inputs[i]).indexOf("gz-date") > 0)
			pattern = "__/__/____";
		else if (gC(inputs[i]).indexOf("gz-time") > 0)
			pattern = "__:__:__";
		else if (gC(inputs[i]).indexOf("gz-integer") > 0)
			sA(inputs[i], "onkeypress", "integer(this, event);");
		else if (gC(inputs[i]).indexOf("gz-double") > 0) {
			sA(inputs[i], "onkeypress", "decimal(this, event);");
			sA(inputs[i], "onkeydown", "decimalClean(this, event);");
		} else if (gC(inputs[i]).indexOf("gz-cpf") > 0)
			pattern = "___.___.___-__";
		else if (gC(inputs[i]).indexOf("gz-phone") > 0)
			pattern = "(__) ____-____";
		else if (gC(inputs[i]).indexOf("gz-celphone") > 0)
			pattern = "(__) _-____-____";
		else if (gC(inputs[i]).indexOf("gz-cep") > 0)
			pattern = "_____-___";
		
		if (gC(inputs[i]).indexOf("gz-required") > 0) {
			sA(inputs[i], "onfocus", "maskOnFocus(this);");
			sA(inputs[i], "onblur", "isNull(this);");
		} 

		if (pattern != "") {
			sA(inputs[i], "onkeypress", "maskMe(this, event, '" 
					+ pattern + "');");

			if (gz_method!= "stateRead") {
				sA(inputs[i], "onfocus", "maskOnFocus(this);");
				sA(inputs[i], "onblur", "isMask(this, '" + pattern + "');");
			}
		}

		pattern = "";
	}

	var selects = gT("select");
	
	for (var i = 0; i < gL(selects); i++) {
		if (gC(selects[i]).indexOf("gz-option") > 0) {
		
			sA(selects[i], "onclick", "");
			sA(selects[i], "onkeydown", "");

			var option = 
					"<div class=\"gz-button dv-f-l\" " +
						"onclick=\"showScreen('" + selects[i].id + "');\" " +
						"onkeydown=\"showScreenEvent('" + selects[i].id + "', event);\"> " +

						"<a href=\"#\"> " +

							"<img src=\"" + gz_root + gz_package + "/res/img/ldpi/create.png\" /> " +

						"</a> " +

					"</div> " +
					
					"<div class=\"gz-button dv-f-l dv-ml-hdpi\" " +
							"onclick=\"optionRemove('" + selects[i].id + "');\" " +
							"onkeydown=\"optionRemoveEvent('" + selects[i].id + "', event);\"> " +

						"<a href=\"#\"> " +

							"<img src=\"" + gz_root + gz_package + "/res/img/ldpi/delete.png\" /> " +

						"</a> " +

					"</div> ";

			sH(gI(selects[i].id + ".option"), option);
		}	
		
		sA(selects[i], "onfocus", "maskOnFocus(this);");
		sA(selects[i], "onblur", "isNull(this);");
	}
}

/**
 * Mask Effect
 *
 * @param {Element } element
 * @param {Event} event
 * @param {String} pattern
 */
function maskMe(element, event, pattern) {
	if (event.keyCode< 48 || event.keyCode> 57)
		event.returnValue = false;
	else {
		var position = [];
		var mask = [];

		for (var i = 0; i < gL(pattern); i++) {
			if (pattern.charAt(i) != "_") {
				position.push(i);
				mask.push(pattern.charAt(i));
			}
		}

		for (var j = 0; j < gL(position); j++) {
			if (gL(gV(element)) == position[j])
				sV(element, gV(element) + mask[j]);

			if (gL(gV(element)) == gL(pattern))
				sV(element, gV(element).substring(0, gL(pattern) - 1));
		}
	}
}

/**
 * Mask Focus
 *
 * @param {Element} element
 */
function maskOnFocus(element) {
	sG(element, "linear-gradient(#ffffff, #e3f2fd)");
	sB(element, "solid 1px #90caf9");
}

/**
 * Mask Check
 *
 * @param {Element} element
 * @param {String} pattern
 */
function isMask(element, pattern) {
	mask = true;
	
	if (gL(gV(element)) == gL(pattern)) {
		for (var i = 0; i < gL(pattern); i++) {
			if (pattern.charAt(i) == "_") {
				if (isNaN(gV(element).charAt(i))) {
					mask = false;
					
					break;
				}
			} else {
				if (pattern.charAt(i) != gV(element).charAt(i)) {
					mask = false;
					
					break;
				}
			}
		}

		if (mask) {
			sG(element, "linear-gradient(#ffffff, #fafafa)");
			sB(element, "solid 1px #e9e9e9");
		} else {
			sG(element, "linear-gradient(#ffffff, #ffebee)");
			sB(element, "solid 1px #ef9a9a");
		}
	} else {
		if (element.value.length == 0) {
			sG(element, "linear-gradient(#ffffff, #fafafa)");
			sB(element, "solid 1px #e9e9e9");
		} else {
			sG(element, "linear-gradient(#ffffff, #ffebee)");
			sB(element, "solid 1px #ef9a9a");
		}
	}
}

/**
 * Null Check
 *
 * @param {Element} element
 */
function isNull(element) {
	if (gL(gV(element)) == 0) {
		sG(element, "linear-gradient(#ffffff, #ffebee)");
		sB(element, "solid 1px #ef9a9a");
	} else {
		sG(element, "linear-gradient(#ffffff, #fafafa)");
		sB(element, "solid 1px #e9e9e9");
	}
}

/**
 * Integer Check
 *
 * @param {Element} element
 * @param {Event} event
 */
function integer(element, event) {
	if (event.keyCode< 48 || event.keyCode> 57)
		event.returnValue = false;
}

/**
 * Decimal Effect
 *
 * @param {Element} element
 * @param {Event} event
 */
function decimal(element, event) {
	if (event.keyCode< 48 || event.keyCode> 57)
		event.returnValue = false;
	else {
		event.returnValue = false;
		
		var mask = "";
		
		var metadata = gV(element).replace(/\,/g, "").replace(/\./g, "") + 
				String.fromCharCode(event.keyCode);	
		
		if (metadata.charAt(0) == "0" && metadata.charAt(1) == "0")
			metadata = metadata.replace("00", "");
		else if (metadata.charAt(0) == "0")
			metadata = metadata.replace("0", "");

		if (gL(metadata) == 1)
			mask = "0,0" + metadata;
		else if (gL(metadata) == 2)
			mask = "0," + metadata;
		else if (gL(metadata) == 3) 
			mask = metadata.charAt(0) + "," + metadata.charAt(1) + 
					metadata.charAt(2);
		else if (gL(metadata) > 3) {
			var number = metadata.substring(0, (gL(metadata) - 2));
			var decimal = metadata.substring((gL(metadata) - 2), gL(metadata));
			
			var position = 0;
			
			for (var i = (gL(number) - 1); i >= 0; i--) {
				if (position == 3) {
					position = 0;
					
					mask = number.charAt(i) + "." + mask;
				} else 
					mask = number.charAt(i) + mask

				position++;
			}
			
			mask = mask + "," + decimal;
		}
		
		sV(element, mask);
	}
}

/**
 * Decimal Back Space
 *
 * @param {Element} element
 * @param {Event} event
 */
function decimalClean(element, event) {
	if (event.keyCode == 8) {
		event.returnValue = false;
		
		var mask = "";

		var metadata = gV(element).replace(/\,/g, "").replace(/\./g, "") + 
				String.fromCharCode(event.keyCode);
							
		var data = metadata.substring(0, (gL(metadata) - 2));
		
		if (data.charAt(0) == "0" && data.charAt(1) == "0")
			data = data.replace("00", "");
		else if (data.charAt(0) == "0")
			data = data.replace("0", "");
		
		if (gL(data) == 1)
			mask = "0,0" + data;
		else if (gL(data) == 2)
			mask = "0," + data;
		else if (gL(data) == 3) 
			mask = data.charAt(0) + "," + data.charAt(1) + 
					data.charAt(2);
		else if (gL(data) > 3) {
			var number = data.substring(0, (gL(data) - 2));
			var decimal = data.substring((gL(data) - 2), gL(data));
			
			var position = 0;
			
			for (var i = (gL(number) - 1); i >= 0; i--) {
				if (position == 3) {
					position = 0;
					
					mask = number.charAt(i) + "." + mask;
				} else 
					mask = number.charAt(i) + mask

				position++;
			}
			
			mask = mask + "," + decimal;
		}
		
		sV(element, mask);
	}
}

/**
 * Check Form
 *
 * @return {Boolean} The Validation
 */
function validate() {
	var ret = true;

	if (gI("gz-form") != undefined) {
		var fields = gI("gz-form");

		for (var i = 0; i < gL(fields); i++) {
			if (gY(fields.elements[i]) != "submit") {
				if (gG(fields.elements[i]) == 
						"linear-gradient(rgb(255, 255, 255), rgb(255, 235, 238))")
					ret = false;

				if (gC(fields.elements[i]).indexOf("gz-required") > 0) {
					if (gV(fields.elements[i]) == "") {
						sG(fields.elements[i], "linear-gradient(#ffffff, #ffebee)");
						sB(fields.elements[i], "solid 1px #ef9a9a");
						
						ret = false;
					}
				}
			}
		}
	}

	return ret;
}

/**
 * Date Time
 *
 * @return {Date} The Date
 */
function getDateTime() {
	var data = new Date();
	
	var dia = gL(data.getDate().toString()) == 1 
			? "0" + data.getDate() : data.getDate() ;
			
	var mes = gL((data.getMonth() + 1).toString()) == 1 
			? "0" + (data.getMonth() + 1) : (data.getMonth() + 1) ;

	var ano = data.getFullYear();
	
	return dia + "/" + mes + "/" + ano;
}

/**
 * Get Root
 *
 * @param {String} module
 */
function getRoot(module) {
	var modArr = module.split("/");

	if (modArr.length > 2) {
		var ret = "";
		
		for (var i = 1; i < modArr.length - 1; i++) {
			ret += "/" + modArr[i];
		}

		return ret;
	} else
		return "";
}

/**
 * Get Module
 *
 * @param {String} module
 */
function getModule(module) {
	var modArr = module.split("/");
	
	if (modArr.length > 0) {
		for (i = 0; i < modArr.length; i++) {
			module = modArr[i] ;
		}
	}

	return module;
}

/**
 * Image preview
 */
function imagePreview() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(gI("upload").files[0]);

	oFReader.onload = function (oFREvent) {
		gI("preview").src = oFREvent.target.result;
	};
}

/**
 * Menus show
 *
 * @param {String} element
 */
function menuShow(element) {
	sD(gI("gz-cadastros"), "none");
	sD(gI("gz-configuracoes"), "none");
	
	sD(gI(element), "block");
	
	/*
	if (gD(gI(element)) == "none")
		sD(gI(element), "block");
	else
		sD(gI(element), "none");
	*/
}

/**
 * @param {Element} element
 */
function zoom(element) {
	var elementId = element.id.split("-");

	gI("zoom-img-" + elementId[1]).src = element.src;
	gI("zoom-img-" + elementId[1]).height = "100";
}

/**
 * Submit login
 *
 * @param {Event} e
 */
function loginOnKeyPress(e) {
	if (e.keyCode == 13)
		request('login', 'login');
}

/**
 * Clean the select
 *
 * @param {String} id
 * @param {Event} e
 */
function clean(id, e) {
	if (e.keyCode == 13 || e.keyCode == undefined) {
		var select = document.getElementById(id);
		var length = select.options.length;
		
		for (i = 0; i < length; i++) {
			select.options[i] = null;
		}
	}
}

/**
 * Graphic generator
 *
 * @param {String} id
 * @param {Array} lines
 * @param {Array} columns
 * @param {String} preValue
 * @param {String} posValue
 * @param {Boolean} convertToDecimal
 */	
function graphic(id, lines, columns, 
		preValue = "", posValue = "", convertToDecimal = true,
		lineColor = "#bdbdbd") {

	/*
	 * Set div width
	 */
	sA(gI(id + "l"), "style", "width: " + (columns.length * 64) + "px; margin: 0 auto;"); 
	sA(gI(id + "c"), "style", "width: " + (columns.length * 64) + "px; margin: 0 auto;");
	
	/*
	 * Set line items
	 */
	var lineItems = "";
	
	var month = 4;
	
	for (var i = 0; i < lines.length; i++) {
		var date = new Date();
		date.setMonth(date.getMonth() - month);
		
		lineItems += "<p id='" + id + i + "l' class='dv-f-l dv-ta-c gz-bold' style='width: 64px;'></p>";
				
		month--;
	}
	
	lineItems += "<div class='dv-clear'></div>";
	
	sH(gI(id + "l"), lineItems);
	
	/*
	 * Set column items
	 */
	var columnItems = "";
	
	for (var i = 0; i < columns.length; i++) {
		columnItems += "<p id='" + id + i + "c' class='dv-f-l dv-ta-c gz-bold' style='width: 64px;'></p>";
	}
	
	columnItems += "<div class='dv-clear'></div>";
	
	sH(gI(id + "c"), columnItems);
	
	/*
	 * Canvas
	 */
	var canvas = document.getElementById(id);
	canvas.setAttribute("width", columns.length * 64);
	canvas.setAttribute("height", 100);
	
	/* 
	 * Context
	 */
	var context = canvas.getContext("2d");
	context.fillStyle = "#fff";
	context.strokeStyle = lineColor;
	context.fillRect(0, 0, window.innerWidth, 100);

	// Range of pixels
	var range = 0;

	/*
	 * Bigest and lowest value from line
	 */
	var valuesMax = Math.max.apply(Math, lines);
	var valuesMin = Math.min.apply(Math, lines);
	var subtraction = valuesMax - valuesMin;
	
	/*
	 * Set line values
	 */
	for (var i = 0; i < lines.length; i++) {
		sH(gI(id + i + "l"), preValue + (convertToDecimal ? 
				toDecimal(lines[i]) : lines[i]) + posValue);
				
		var value = ((valuesMax - lines[i]) == 0 ? 0.99 : (valuesMax - lines[i]));		
		var percentual = (value * 100) / (subtraction == 0 ? 0.99 : subtraction);
		
		lines[i] = 100 - percentual;
	}
	
	/*
	 * Set column values
	 */
	for (var i = 0; i < columns.length; i++) {
		sH(gI(id + i + "c"), columns[i]);
	}
	
	// Interval
	var interval = setInterval(builder, 10);
	
	/*
	 * Builder
	 */
	function builder() {
		if (range > window.innerWidth)
			clearInterval(interval);
			
		var j = 0;

		for (var i = 0; i < lines.length; i++) {
			// 32, 96, 160, 224, 288, 352...
			j = (32 * (i + 1)) + (32 * i);
			
			if (range == j) {
				context.lineTo(range, 100 - lines[i]);
				context.stroke();
			}
		}
		
		// 8 pixels
		range += 8;
	}
}

/**
 * Pizza generator
 *
 * @param {String} id
 */	
function pizza(id) {
	var data_table = gI(id + "t");
	var canvas = gI(id);
	var td_index = 1;
	var tds, data = [], color, colors = [], value = 0, total = 0;
	var trs = data_table.getElementsByTagName("tr");
	
	for (var i = 0; i < trs.length; i++) {
		tds = trs[i].getElementsByTagName("td");

		if (tds.length === 0) 
			continue;

		value = parseFloat(tds[td_index].innerHTML);

		data[data.length] = value;
		total += value;

		color = getColor(i);
		colors[colors.length] = color;
	}

	/* 
	 * exit if canvas is not supported
	 */
	if (typeof canvas.getContext === "undefined")
		return;

	var ctx = canvas.getContext("2d");
	var canvas_size = [canvas.width, canvas.height];
	var radius = Math.min(canvas_size[0], canvas_size[1]) / 2;
	var center = [canvas_size[0]/2, canvas_size[1]/2];

	var sofar = 0;
	
	for (var piece in data) {
		var thisvalue = data[piece] / total;

		ctx.beginPath();
		ctx.moveTo(center[0], center[1]);
	
		ctx.arc(  
			center[0],
			center[1],
			radius,
			Math.PI * (- 0.5 + 2 * sofar),
			Math.PI * (- 0.5 + 2 * (sofar + thisvalue)),
			false
		);

		ctx.lineTo(center[0], center[1]);
		ctx.closePath();
		ctx.fillStyle = colors[piece];
		ctx.fill();

		sofar += thisvalue;
	}
}

function getColor(position) {
	return "#80cbc4";
}

/**
 * Decimal converter
 *
 * @param {Double} value
 */
function toDecimal(value) {
	if (value == 0)
		return 0;
	else {
		var mask = "";
		
		var metadata = value.replace(/\,/g, "").replace(/\./g, "");	
		
		if (metadata.charAt(0) == "0" && metadata.charAt(1) == "0")
			metadata = metadata.replace("00", "");
		else if (metadata.charAt(0) == "0")
			metadata = metadata.replace("0", "");

		if (gL(metadata) == 1)
			mask = "0,0" + metadata;
		else if (gL(metadata) == 2)
			mask = "0," + metadata;
		else if (gL(metadata) == 3) 
			mask = metadata.charAt(0) + "," + metadata.charAt(1) + 
					metadata.charAt(2);
		else if (gL(metadata) > 3) {
			var number = metadata.substring(0, (gL(metadata) - 2));
			var decimal = metadata.substring((gL(metadata) - 2), gL(metadata));
			
			var position = 0;
			
			for (var i = (gL(number) - 1); i >= 0; i--) {
				if (position == 3) {
					position = 0;
					
					mask = number.charAt(i) + "." + mask;
				} else 
					mask = number.charAt(i) + mask

				position++;
			}
			
			mask = mask + "," + decimal;
		}
		
		return mask;
	}
}

/*
 * Image position
 */
var newImage = false; 
 
/**
 * Image preview with default margin
 */ 
function imagePreviewMargin() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(gI("upload").files[0]);

	oFReader.onload = function (oFREvent) {
		gI("preview-margin").style = "width: 270px; height: 160px; background: url(" + oFREvent.target.result + 
			") no-repeat center 0%; webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;";
	};
	
	newImage = true;
} 
 
/**
 * Image preview with margin
 *
 * @param {Object} obj
 * @param {String} background
 */  
function positionPreviewUpdate(obj, background) {
	if (newImage) 
		positionPreviewCreate(obj);
	else
		gI("preview-margin").style = "width: 270px; height: 160px; background: url(" + background + 
				") no-repeat center " + obj.value + 
				"%; webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;";	
}

/**
 * Image preview with margin
 *
 * @param {Object} obj
 */  
function positionPreviewCreate(obj) {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(gI("upload").files[0]);
	
	oFReader.onload = function (oFREvent) {
		gI("preview-margin").style = "width: 270px; height: 160px; background: url(" + oFREvent.target.result + 
			") no-repeat center " + obj.value + 
			"%; webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;";
	};
}
/**
 * Getz JS for pages 1.0.0
 * 
 * @author Mário Sakamoto <mskamot@gmail.com>
 * @license MIT http://www.opensource.org/licenses/MIT
 * @see http://mariosakamoto.com/getz
 * @since 2014-07-26
 */

// Begin aplication
window.onload = page;

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
    	        return new ActiveXObject("Msxml2.XMLHTTP");
    	    } catch(e) { }
        }
    }
}

/**
 * Get form elements values
 *
 * @return {String} Values
 */
function getForm() {
	var one = true;
	var option = true;
	var get = "";

	if (gI("gz-form") != undefined) {
		var fields = gI("gz-form");
		
		for (var i = 0; i < gL(fields); i++) {
			if (gY(fields.elements[i]) != "submit") {
				if (i == 0) {
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
								if (gY(fields.elements[i]) != "file")
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

function page() {
	eval(gz_screen + "HDL();");
}

/**
 * Go to page with combo position
 */
function goPage() {
	if (gV(gI("gz-select-pagination")) != "")
		goTo("/" + gz_screen + "/" + (gz_code != "" ? gz_code + "/" : "") + 
				gV(gI("gz-select-pagination")));
}

/**
 * Go to link
 *
 * @param {String} link
 */
function goTo(link) {
	location.href = gz_root + link;
}

/**
 * Href
 *
 * @param {String} screen
 * @param {Integer} code
 */
function href2(screen, code) {
	if (code != undefined && code != "")
		location.href = gz_root + gz_module + "/" + screen + "/" + code + "/1";
	else
		location.href = gz_root + gz_module + "/" + screen + "/1";
}
/**
 * Flygon 1.0.0
 * 
 * @author Mário Sakamoto <mskamot@gmail.com>
 * @license MIT http://www.opensource.org/licenses/MIT
 * @see http://mariosakamoto.com/flygon
 * @see http://mariosakamoto.com/jsmin
 * @since 2014-07-26
 */

/**
 * @example Insert this code in the end of <body></body>
 *
<script>
	// Your screens id
 	var fg_screens = ["fg-01", "fg-02", "fg-03", ...];
	
	(function() {
		document.body.onkeypress = function(event) { 
			flygon(event); 
		}
	})();
</script>
 */

/* 
 * Initialize vars
 */
var fg_screens; 
var fg_screen = 0;

function backgroundColor(value) {
	if (value.trim().length == 7)
		sG(gT("body")[0], value.trim());
}

function textColor(value) {
	if (value.trim().length == 7) {
		for (var i = 0; i < gT("h1").length; i++) {
			sO(gT("h1")[i], value.trim());
		}
		
		for (var i = 0; i < gT("h3").length; i++) {
			sO(gT("h3")[i], value.trim());
		}
	}
}

/*
function textColor(value) {
	if (value.trim().length == 7) {
		for (var i = 0; i < gT("h1").length; i++) {
			sO(gT("h1")[i], value.trim());
		}
		
		for (var i = 0; i < gT("h3").length; i++) {
			sO(gT("h3")[i], value.trim());
		}
		
		var fgDown = gS("fg-down");

		for (var i = 0; i < fgDown.length; i++) {
			sB(fgDown[i], "solid 1px " + value);
			
			if (parseInt(value.replace(/\#/g, ""), 16) < 12000000)
				sG(fgDown[i], "url('../../res/img/ldpi/fg-down.png') no-repeat center");
			else
				sG(fgDown[i], "url('../../res/img/ldpi/fg-white-down.png') no-repeat center");

			//if (parseInt(value.replace(/\#/g, ""), 16) > 12000000)
				//sC(fgDown[i], "fg-white-down");
		}
		
		var fgTop = gS("fg-top");

		for (var i = 0; i < fgTop.length; i++) {
			sB(fgTop[i], "solid 1px " + value);
			
			if (parseInt(value.replace(/\#/g, ""), 16) < 12000000)
				sG(fgTop[i], "url('../../res/img/ldpi/fg-top.png') no-repeat center");
			else
				sG(fgTop[i], "url('../../res/img/ldpi/fg-white-top.png') no-repeat center");

			//if (parseInt(value.replace(/\#/g, ""), 16) > 12000000)
				//sC(fgDown[i], "fg-white-down");
		}
		
		var fgDelete = gS("fg-delete");

		for (var i = 0; i < fgDelete.length; i++) {
			sB(fgDelete[i], "solid 1px " + value);
			
			if (parseInt(value.replace(/\#/g, ""), 16) < 12000000)
				sG(fgDelete[i], "url('../../res/img/ldpi/fg-delete.png') no-repeat center");
			else
				sG(fgDelete[i], "url('../../res/img/ldpi/fg-white-delete.png') no-repeat center");
		}
		
		var fgCreate = gS("fg-create");

		for (var i = 0; i < fgCreate.length; i++) {
			sB(fgCreate[i], "solid 1px " + value);
			
			if (parseInt(value.replace(/\#/g, ""), 16) < 12000000)
				sG(fgCreate[i], "url('../../res/img/ldpi/fg-create.png') no-repeat center");
			else
				sG(fgCreate[i], "url('../../res/img/ldpi/fg-white-create.png') no-repeat center");
		}
	}
}
*/

/**
 * onblur="fgUpdate('presentations', <one(presentations)><gz>presentations.id</gz></one>, this.textContent);"
 */
function fgUpdate(table, code, value) {
	var url = gz_root + "/ws/" + table + "/update/" + code;

	var formData = new FormData();
	formData.append("form", value.trim() + "<gz>");
	formData.append("base", gz_base);

	var req = initRequest();
	req.open("POST", url, true);
	req.send(formData);	
	
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) { }
	};
}

function fgDelete(code) {
	var url = gz_root + "/ws/slides/delete/" + code;

	var formData = new FormData();
	formData.append("form", "");
	formData.append("base", gz_base);

	var req = initRequest();
	req.open("POST", url, true);
	req.send(formData);	
	
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) { alert(req.responseText); }
	};
}

/**
 * Flygon
 *
 * @param {Event} e
 */
function flygon(e) {
	if (e.keyCode == 38) {
		if (fg_screen == 0) {
			fg_screen = 0;
			moveToHome();
		} else {
			fg_screen--;
			moveToTop(fg_screens[fg_screen]);
		}
	} else if (e.keyCode == 40) { 
		if (fg_screen == fg_screens.length - 1) {
			fg_screen = 0;
			moveToHome();
		} else {
			fg_screen++;
			moveToDown(fg_screens[fg_screen]);
		}
	}
}

/**
 * Get location
 *
 * @param {Object} obj
 * @return {Integer} location
 */
function getLocation(obj){
	var location = 0;
	
	if (obj.offsetParent) {
		do {
			location += obj.offsetTop;
		} while (obj = obj.offsetParent)
	}

	return location;
}

/**
 * Move to home
 */
function moveToTop(id) {
	var location = getLocation(gI(id));
	var until = 0;

	var forever = window.setInterval(
		function() {
			window.scrollBy(0, -10);
			until += 10;
			
			if (until > location) {
				clearInterval(forever);
				
				for (var i = 0; i < fg_screens.length; i++) {
					if (fg_screens[i] == id)
						fg_screen = i;
				}
				
				if (fg_screen == 0)
					moveToHome();
				else
					window.scrollBy(0, (until - location));
			}
		}, 1
	);
}

/**
 * Move to down
 *
 * @param {String} id
 */
function moveToDown(id) {
	var location = getLocation(gI(id)) - window.pageYOffset;
	var until = 0;

	var forever = window.setInterval(
		function() {
			window.scrollBy(0, 10);
			until += 10;
			
			if (until > location) {
				clearInterval(forever);

				for (var i = 0; i < fg_screens.length; i++) {
					if (fg_screens[i] == id)
						fg_screen = i;
				}
				
				if (fg_screen != fg_screens.length - 1)
					window.scrollBy(0, (until - location) * -1);
			}
		}, 1
	);
}

/**
 * Move to home
 */
function moveToHome() {
	var location = window.pageYOffset;
	var until = 0;

	var forever = window.setInterval(
		function() {
			if (until > location) {
				clearInterval(forever);
				
				fg_screen = 0;
			}
			
			window.scrollBy(0, -20);
			until += 20;
		}, 1
	);
}

/**
 * Show menu
 */
function showMenu() {
	if (gD(gI("fg-menu")) == "none")
		sD(gI("fg-menu"), "block");
	else
		sD(gI("fg-menu"), "none");
}
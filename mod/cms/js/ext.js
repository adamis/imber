/**
 * Extras
 *
 * @author Mário Sakamoto <msakamoto.dev@gmail.com>
 * @license MIT
 * @see http://mariosakamoto.com/getz
 */
 
var newImage = false; 
 
function imagePreviewMargin(id) {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(gI("upload").files[0]);

	oFReader.onload = function (oFREvent) {
		gI("preview-margin").style = "width: 270px; height: 160px; background: url(" + oFREvent.target.result + 
			") no-repeat center 0%; webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;";
	};
	
	newImage = true;
} 
 
function positionPreviewUpdate(obj, background) {
	if (newImage) 
		positionPreviewCreate(obj);
	else
		gI("preview-margin").style = "width: 270px; height: 160px; background: url(" + background + 
				") no-repeat center " + obj.value + 
				"%; webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;";	
}

function positionPreviewCreate(obj) {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(gI("upload").files[0]);
	
	oFReader.onload = function (oFREvent) {
		gI("preview-margin").style = "width: 270px; height: 160px; background: url(" + oFREvent.target.result + 
			") no-repeat center " + obj.value + 
			"%; webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;";
	};
}

function showCustomMessage() {
	sD(gI("gz-block"), "block");
	sD(gI("gz-custom-message"), "block");
}

function closeCustomMessage() {
	sD(gI("gz-block"), "none");
	sD(gI("gz-custom-message"), "none");
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
 *
 * @example
 * graphic("@_DOCUMENTO_BY_ID", 
	[(Math.random() * 100).toFixed(2), (Math.random() * 100).toFixed(2), (Math.random() * 100).toFixed(2)], 
	["Jan", "Feb", "Mar"], "$");
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
	
	// Which TD contains the data
	var td_index = 1;

	// Get the data[] from the table
	var tds, data = [], color, colors = [], value = 0, total = 0;
	
	// All TRs
	var trs = data_table.getElementsByTagName("tr");
	
	for (var i = 0; i < trs.length; i++) {
		// All TRs
		tds = trs[i].getElementsByTagName("td");

		if (tds.length === 0) continue; //  no TDs here, move on

		// get the value, update total
		value = parseFloat(tds[td_index].innerHTML);

		data[data.length] = value;
		total += value;

		// random color
		color = getColor(i);
		colors[colors.length] = color; // save for later
	}

	// exit if canvas is not supported
	if (typeof canvas.getContext === "undefined") { return; }

	// get canvas context, determine radius and center
	var ctx = canvas.getContext("2d");
	var canvas_size = [canvas.width, canvas.height];
	var radius = Math.min(canvas_size[0], canvas_size[1]) / 2;
	var center = [canvas_size[0]/2, canvas_size[1]/2];

	var sofar = 0; // keep track of progress
	
	// loop the data[]
	for (var piece in data) {
		var thisvalue = data[piece] / total;

		ctx.beginPath();
		ctx.moveTo(center[0], center[1]); // center of the pie
		ctx.arc(  // draw next arc
			center[0],
			center[1],
			radius,
			Math.PI * (- 0.5 + 2 * sofar), // -0.5 sets set the start to be top
			Math.PI * (- 0.5 + 2 * (sofar + thisvalue)),
			false
		);

		ctx.lineTo(center[0], center[1]); // line back to the center
		ctx.closePath();
		ctx.fillStyle = colors[piece];    // color
		ctx.fill();

		sofar += thisvalue; // increment progress tracker
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
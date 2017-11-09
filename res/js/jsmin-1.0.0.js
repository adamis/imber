/**
 * Jsmin 1.0.0
 * 
 * @author Mário Sakamoto <mskamot@gmail.com>
 * @license MIT http://www.opensource.org/licenses/MIT
 * @see http://mariosakamoto.com/jsmin
 * @since 2014-07-26
 */

/**
 * Set attribute
 *
 * @param {Element} e Element
 * @param {String} a Attribute
 * @param {String} f Function
 */
function sA(e, a, f) {
	try {
		e.setAttribute(a, f);
	} catch(e) { }
}

/**
 * Get attribute
 *
 * @param {Element} e Element
 * @param {String} a Attribute
 * @return {String} Function
 */
function gA(e, a) {
	try {
		return e.getAttribute(a);
	} catch(e) { }
}

/**
 * Set border
 *
 * @param {Element} e Element
 * @param {String} b Border
 */
function sB(e, b) {
	try {
		e.style.border = b;
	} catch(e) { }
}

/**
 * Get border
 *
 * @param {Element} e Element
 * @return {String} Border
 */
function gB(e) {
	try {
		return e.style.border;
	} catch(e) { }
}

/**
 * Set border top
 *
 * @param {Element} e Element
 * @param {String} b Border top
 */
function sBt(e, b) {
	try {
		e.style.borderTop = b;
	} catch(e) { }	
}

/**
 * Get border top
 *
 * @param {Element} e Element
 * @return {String} Border top
 */
function gBt(e) {
	try {
		return e.style.borderTop;
	} catch(e) { }
}

/**
 * Set border right
 *
 * @param {Element} e Element
 * @param {String} b Border right
 */
function sBr(e, b) {
	try {
		e.style.borderRight = b;
	} catch(e) { }	
}

/**
 * Get border right
 *
 * @param {Element} e Element
 * @return {String} Border right
 */
function gBr(e) {
	try {
		return e.style.borderRight;
	} catch(e) { }
}

/**
 * Set border bottom
 *
 * @param {Element} e Element
 * @param {String} b Border bottom
 */
function sBb(e, b) {
	try {
		e.style.borderBottom = b;
	} catch(e) { }
}

/**
 * Get border bottom
 *
 * @param {Element} e Element
 * @return {String} Border bottom
 */
function gBb(e) {
	try {
		return e.style.borderBottom;
	} catch(e) { }
}

/**
 * Set border left
 *
 * @param {Element} e Element
 * @param {String} b Border left
 */
function sBl(e, b) {
	try {
		e.style.borderLeft = b;
	} catch(e) { }
}

/**
 * Get border left
 *
 * @param {Element} e Element
 * @return {String} Border left
 */
function gBl(e) {
	try {
		return e.style.borderLeft;
	} catch(e) { }
}

/**
 * Set class
 *
 * @param {Element} e Element
 * @param {String} c Class
 */
function sC(e, c) {
	try {
		e.className = c;
	} catch(e) { }
}

/**
 * Get class
 *
 * @param {Element} e Element
 * @return {String} Class
 */
function gC(e) {
	try {
		return e.className;
	} catch(e) { }
}

/**
 * Set display
 *
 * @param {Element} e Element
 * @param {String} d Display
 */
function sD(e, d) {
	try {
		e.style.display = d;
	} catch(e) { }	
}

/**
 * Get display
 *
 * @param {Element} e Element
 * @return {String} Display
 */
function gD(e) {
	try {
		return e.style.display;
	} catch(e) { }
}

/**
 * Set height
 *
 * @param {Element} e Element
 * @param {String} h Height
 */
function sE(e, h) {
	try {
		e.style.height = h;
	} catch(e) { }	
}

/**
 * Get height
 *
 * @param {Element} e Element
 */
function gE(e) {
	try {
		return e.style.height;
	} catch(e) { }	
}

/**
 * Get display
 *
 * @param {Element} e Element
 * @return {String} Display
 */
function gD(e) {
	try {
		return e.style.display;
	} catch(e) { }
}

/**
 * Set focus
 *
 * @param {Element} e Element
 */
function sF(e) {
	try {
		e.focus();
	} catch(e) { }
}

/**
 * Set background
 *
 * @param {Element} e Element
 * @param {String} g Background
 */
function sG(e, g) {
	try {
		e.style.background = g;
	} catch(e) { }
}

/**
 * Get background
 *
 * @param {Element} e Element
 * @return {String} Background
 */
function gG(e) {
	try {
		return e.style.background;
	} catch(e) { }
}

/**
 * Set HTML
 *
 * @param {Element} e Element
 * @param {String} h HTML
 */
function sH(e, h) {
	try {
		e.innerHTML = h;
	} catch(e) { }
}

/**
 * Get HTML
 *
 * @param {Element} e Element
 * @return {String} HTML
 */
function gH(e) {
	try {
		return e.innerHTML;
	} catch(e) { }
}

/**
 * Get id
 *
 * @param {String} i Id
 * @return {Element} Element
 */
function gI(i) {
	try {
		return document.getElementById(i);
	} catch(e) { }
}

/**
 * Get length
 *
 * @param {Element} e Element
 * @return {Integer} Length
 */
function gL(e) {
	try {
		return e.length;
	} catch(e) { }
}

/**
 * Get childs
 *
 * @param {Element} e Element
 * @param {String} c Child
 * @return {Array} Elements
 */
function gN(e, c) {
	try {
		return e.getElementsByTagName(c);
	} catch(e) { }
}

/**
 * Set color
 *
 * @param {Element} e Element
 * @param {String} o Color
 */
function sO(e, o) {
	try {
		e.style.color = o;
	} catch(e) { }	
}

/**
 * Get parent node
 *
 * @param {Element} e Element
 * @return {Element} Element
 */
function gP(e) {
	try {
		return e.parentNode;
	} catch(e) { }
}

/**
 * Get classes
 *
 * @param {String} c Classes
 * @return {Array} Elements
 */
function gS(c) {
	try {
		return document.getElementsByClassName(c);
	} catch(e) { }
}

/**
 * Get tag name
 *
 * @param {String} n
 * @return {Array} Elements
 */
function gT(n) {
	try {
		return document.getElementsByTagName(n);
	} catch(e) { }
}

/**
 * Set value
 *
 * @param {Element} e Element
 * @param {String} v Value
 */
function sV(e, v) {
	try {
		e.value = v;
	} catch(e) { }
}

/**
 * Get value
 *
 * @param {Element} e Element
 * @return {String} Value
 */
function gV(e) {
	try {
		return e.value;
	} catch(e) { }
}

/**
 * Set width
 *
 * @param {Element} e Element
 * @param {String} w Width
 */
function sW(e, w) {
	try {
		e.style.width = w;
	} catch(e) { }	
}

/**
 * Get width
 *
 * @param {Element} e Element
 */
function gW(e) {
	try {
		return e.style.width;
	} catch(e) { }	
}

/**
 * Get type
 *
 * @param {Element} e Element
 * @return {String} Type
 */
function gY(e) {
	try {
		return e.type;
	} catch(e) { }
}
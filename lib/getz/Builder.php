<?php

	/**
	 * Builder
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 */
	 
	namespace lib\getz;

	class Builder {
	
		public function __construct() { }

		/**
		 * @param {String} table
		 * @param {Array} fields
		 * @param {String} fk
		 * @param {String} call
		 */
		public function view($table, $fields, $fk, $call) {
			$ret = "";
			$create = "";
			$print = "";
			$update = "";
			$like = "";
			$count = 0;
			
			foreach ($fields as $field => $type) {	
				$count++;
				
				if ($count == 2)
					$like = $field;

				if ($count > 1) {
					if ($type != "new") {
						if ($type != "now") {
							if ($type == "photo") {
								$create .= "
							
			<!-- " . ucfirst($field) . " -->
			
			<div class=\"gz-block dv-f-l\">
		
				<div class=\"gz-label-mdpi dv-f-l dv-pt-mdpi dv-pb-mdpi\">" . ucfirst($field) . "</div>
			
			</div>
			
			<div class=\"gz-block dv-f-l\">
							
				<input type=\"file\" id=\"upload\" name=\"upload\" class=\"gz-textbox-mdpi dv-f-l dv-mt-ldpi\"
						onchange=\"imagePreview();\">
				
			</div>
			
			<div class=\"gz-block dv-f-l\">
							
				<img id=\"preview\" width=\"270\" src=\"...\" class=\"dv-pb-mdpi\" />
						
			</div>";
							} else if ($type == "upload") {
								$create .= "
							
			<!-- " . ucfirst($field) . " -->
			
			<div class=\"gz-block dv-f-l\">
		
				<div class=\"gz-label-mdpi dv-f-l dv-pt-mdpi dv-pb-mdpi\">" . ucfirst($field) . "</div>
			
			</div>
			
			<div class=\"gz-block dv-f-l\">
							
				<input type=\"file\" id=\"upload\" name=\"upload\" class=\"gz-textbox-mdpi dv-f-l dv-mt-ldpi\">

			</div>";
							} else {
								$create .= "
						
			<!-- " . ucfirst($field) . " -->
			
			<div class=\"gz-block dv-f-l\">
		
				<div class=\"" . (($type == "string32") || ($type == "string64") ? "gz-label-mdpi" : "gz-label-ldpi") . " dv-f-l dv-pt-mdpi dv-pb-mdpi\">" . ucfirst($field) . "</div>
			
			</div>
			
			<div class=\"gz-block dv-f-l\">";

								if ($type == "string64") {
									$create .= "
							
				<textarea class=\"gz-textarea-mdpi dv-f-l dv-mt-ldpi\"
						id=\"" . $table . "." . $field . "\" name=\"" . $table . "." . $field . "\"></textarea>
				
			</div>";				
								} else {
									$create .= "
							
				<input class=\"" . ($type == "string32" ? "gz-textbox-mdpi" : "gz-textbox-ldpi") . " dv-f-l dv-mt-ldpi" . 
				($type == "integer" ? " gz-integer" : 
				($type == "double" ? " gz-double" : 
				($type == "cnpj" ? " gz-cnpj" : 
				($type == "cep" ? " gz-cep" : 
				($type == "phone" ? " gz-phone" :
				($type == "cpf" ? " gz-cpf" :
				($type == "time" ? " gz-time" : 
				($type == "date" ? " gz-date" : 
				($type == "datetime" ? " gz-datetime" : ""))))))))) . "\" type=\"text\" 
						id=\"" . $table . "." . $field . "\" name=\"" . $table . "." . $field . "\" value=\"\">
				
			</div>";
								}
							}
						}
					}
				
					if ($type != "new") {
						if ($type != "now") {
							if ($type == "photo") {
								$update .= "
							
				<!-- " . ucfirst($field) . " -->
				
				<div class=\"gz-block dv-f-l\">
			
					<div class=\"gz-label-mdpi dv-f-l dv-pt-mdpi dv-pb-mdpi\">" . ucfirst($field) . "</div>
				
				</div>
				
				<div class=\"gz-block dv-f-l\">
								
					<input type=\"file\" id=\"upload\" name=\"upload\" class=\"gz-textbox-mdpi dv-f-l dv-mt-ldpi\"
							onchange=\"imagePreview();\">
					
				</div>
				
				<div class=\"gz-block dv-f-l\">
								
					<img id=\"preview\" width=\"270\" class=\"dv-pb-mdpi\"
							src=\"@_ROOT/res/img/mdpi/<gz>" . $table . "." . $field . "</gz>\" />
					
				</div>";
							} else if ($type == "upload") {
								$update .= "
							
				<!-- " . ucfirst($field) . " -->
				
				<div class=\"gz-block dv-f-l\">
			
					<div class=\"gz-label-mdpi dv-f-l dv-pt-mdpi dv-pb-mdpi\">" . ucfirst($field) . "</div>
				
				</div>
				
				<div class=\"gz-block dv-f-l\">
								
					<input type=\"file\" id=\"upload\" name=\"upload\" class=\"gz-textbox-mdpi dv-f-l dv-mt-ldpi\">
					
				</div>";	
							} else {
								$update .= "
						
				<!-- " . ucfirst($field) . " -->
				
				<div class=\"gz-block dv-f-l\">
		
					<div class=\"" . (($type == "string32") || ($type == "string64") ? "gz-label-mdpi" : "gz-label-ldpi") . " dv-f-l dv-pt-mdpi dv-pb-mdpi\">" . ucfirst($field) . "</div>

				</div>

				<div class=\"gz-block dv-f-l\">";
				
								if ($type == "string64") {
									$update .= "
							
					<textarea class=\"gz-textarea-mdpi dv-f-l dv-mt-ldpi\"
							id=\"" . $table . "." . $field . "\" name=\"" . $table . "." . $field . "\"><gz>" . $table . "." . $field . ".format</gz></textarea>
				
				</div>";				
								} else {	
									$update .= "
					
					<input class=\"" . ($type == "string32" ? "gz-textbox-mdpi" : "gz-textbox-ldpi") . " dv-f-l dv-mt-ldpi" . 
				($type == "integer" ? " gz-integer" : 
				($type == "double" ? " gz-double" : 
				($type == "cnpj" ? " gz-cnpj" : 
				($type == "cep" ? " gz-cep" : 
				($type == "phone" ? " gz-phone" :
				($type == "cpf" ? " gz-cpf" :
				($type == "time" ? " gz-time" : 
				($type == "date" ? " gz-date" : 
				($type == "datetime" ? " gz-datetime" : ""))))))))) . "\" type=\"text\" 
							id=\"" . $table . "." . $field . "\" name=\"" . $table . "." . $field . "\" value=\"<gz>" . $table . "." . $field . "</gz>\">
				
				</div>";
								}
							}
						}
					}
				}	
			}

			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {	
					$create .= "
					
			<!-- " . ucfirst($foreignKey) . " -->
			
			<div class=\"gz-block dv-f-l\">
		
				<div class=\"gz-label-mdpi dv-f-l dv-pt-mdpi dv-pb-mdpi\">" . ucfirst($foreignKey) . "</div> 
			
			</div>
			
			<div class=\"gz-block dv-f-l\">

				<select id=\"" . $table . "." . $foreignTable . "\" class=\"gz-select-ldpi dv-f-l dv-mt-ldpi gz-required\"
					onclick=\"showScreen(this.id, '');\" 
					onkeydown=\"showScreenEvent(this.id, '', event);\"></select>
					
				<div id=\"" . $table . "." . $foreignTable . ".option\" class=\"gz-option-ldpi dv-f-l\"></div>
					
			</div>";
			
					$print .= "
					
			<!-- " . ucfirst($foreignKey) . " -->
			
			<div class=\"gz-block dv-f-l\">
		
				<div class=\"gz-label-mdpi dv-f-l dv-pt-mdpi dv-pb-mdpi\">" . ucfirst($foreignKey) . "</div> 
			
			</div>
			
			<div class=\"gz-block dv-f-l\">

				<select id=\"" . $table . "." . $foreignTable . "\" class=\"gz-select-ldpi dv-f-l dv-mt-ldpi gz-required\"
					onclick=\"showScreen(this.id, '');\" 
					onkeydown=\"showScreenEvent(this.id, '', event);\"></select>
					
				<div id=\"" . $table . "." . $foreignTable . ".option\" class=\"gz-option-ldpi dv-f-l\"></div>
					
			</div>";
				
					$update .= "
					
				<!-- " . ucfirst($foreignKey) . " -->
		
				<div class=\"gz-block dv-f-l\">
		
					<div class=\"gz-label-mdpi dv-f-l dv-pt-mdpi dv-pb-mdpi\">" . ucfirst($foreignKey) . "</div> 
					
				</div>
				
				<div class=\"gz-block dv-f-l\">

					<select id=\"" . $table . "." . $foreignTable . "\" class=\"gz-select-ldpi dv-f-l dv-mt-ldpi gz-required\"
							onclick=\"showScreen(this.id, '');\" 
							onkeydown=\"showScreenEvent(this.id, '', event);\">
					
						<option value=\"<gz>" . $table . "." . $foreignKey . "</gz>\" selected>
			
							<gz>" . $foreignTable . "." . $foreignKey . "</gz>
		
						</option>	
					
					</select>
				
				</div>";
				}
			}

			if (!file_exists("../mod/cms/html/" . $table))
				mkdir("../mod/cms/html/" . $table, 0777, true);

			$ret = "<!-- Called View -->
	
	<!-- Content -->
	
	<div id=\"gz-content\" class=\"dv-f-r dv-mt-xdpi dv-pt-xdpi\">

		<!-- Header -->

		<div id=\"gz-header\" class=\"dv-f-l dv-pt-mdpi dv-pb-mdpi\" onclick=\"clearSelection();\">
			
			<!-- History back -->

			<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-mdpi dv-ml-xdpi\" 
					 onclick=\"window.history.go(gz_historyBack); return false;\">
		
				<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

					<img src=\"@_ROOT/res/img/ldpi/back.png\">

					<span class=\"gz-span-bottom-right @_THEME\">

						@_LAN_GO_BACK

					</span>

				</a>

			</div>		
		
			<!-- Create -->

			<div id=\"gz-button-create\" class=\"gz-button dv-f-l dv-mt-mdpi dv-mr-mdpi dv-mb-mdpi dv-ml-hdpi\" 
					onclick=\"showCreate();\">
				
				<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

					<img src=\"@_ROOT/res/img/ldpi/create.png\" />

					<span class=\"gz-span-bottom-right @_THEME\">

						@_LAN_ADD

					</span>

				</a>

			</div>
			
			<!-- Search -->

			<input id=\"gz-search\" class=\"gz-textbox-mdpi dv-f-l dv-mt-mdpi dv-mr-hdpi dv-mb-mdpi dv-ml-hdpi gz-gray\" 
					type=\"text\" value=\"@_LAN_SEARCH_FOR\"
					onfocus=\"emptySearch(this.id);\" onblur=\"showSearch(this.id);\">

			<div id=\"gz-button-search\" class=\"gz-button dv-f-l dv-mt-mdpi\" 
					onclick=\"goSearch();\">

				<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

					<img src=\"@_ROOT/res/img/ldpi/search.png\" />

					<span class=\"gz-span-bottom-right @_THEME\">

						@_LAN_SEARCH

					</span>

				</a>

			</div>

			<!-- Delete -->

			<div class=\"gz-button dv-f-r dv-mt-mdpi dv-mr-xdpi\" onclick=\"showDelete();\">

				<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

					<img src=\"@_ROOT/res/img/ldpi/delete.png\" />
					
					<span class=\"gz-span-bottom-left @_THEME\">

						@_LAN_DELETE

					</span>
					
				</a>

			</div>

		</div>

		<!-- Table -->
		
		<div class=\"dv-pl-xdpi dv-pr-xdpi\">
			
			<p class=\"dv-mb-hdpi gz-gray\">
			
				<one(titles)>
				
					<gz>menus.menu</gz> /
					
					<span class=\"gz-black gz-bold\">
					
						<gz>telas.tela</gz>
						
					</span>
					
				</one>	
					
			</p>
		
			<table>
				
				<tr>

					<th id=\"" . $table . ".id\" style=\"display:none;\"
							onclick=\"orderBy(this.id);\">

						Id

					</th>";
					
				if ($call != "")
					$ret .= "
					
					<th id=\"" . $table . "." . $like . "\" style=\"width:80%;\" 
							onclick=\"orderBy(this.id);\">
							
						" . ucfirst($like) . "
						
					</th>
					
					<th id=\"" . $table . "." . $like . "\" style=\"width:20%;\" 
							onclick=\"orderBy(this.id);\">
							
						" . ucfirst($call) . "
						
					</th>";
					
				else 
					$ret .= "
					
					<th id=\"" . $table . "." . $like . "\" style=\"width:100%;\" 
							onclick=\"orderBy(this.id);\">
							
						" . ucfirst($like) . "
						
					</th>";
					
				$onClickTr = "";	
				$onClickTd = "";
				
				if ($call == "") {
					$onClickTr = "onclick=\"selected(<gz>" . $table . ".line</gz>);\"";
					$onClickTd = "";
				} else {
					$onClickTr = "";
					$onClickTd = " onclick=\"selected(<gz>" . $table . ".line</gz>);\"";
				}
				
				$ret .= "		

				</tr>

				<for(" . $table . ")>

					<tr id=\"<gz>" . $table . ".line</gz>\" 
							onMouseOver=\"onFocus(<gz>" . $table . ".line</gz>);\" 
							onMouseOut=\"outFocus(<gz>" . $table . ".line</gz>);\" 
							" . $onClickTr . ">

						<td style=\"display:none;\"><gz>" . $table . ".id</gz></td>

						<td" . $onClickTd . "><gz>" . $table . "." . $like . "</gz></td>";
						
				if ($call != "")
					$ret .= "
				
						<td class=\"gz-link\" onclick=\"goTo('/" . $call . "/called/<gz>" . $table . ".id</gz>/1/historyBack/' + gz_historyBack);\">
									
							<img class=\"dv-mr-ldpi\" src=\"@_ROOT/res/img/ldpi/grid-next.png\" />
									
							" . ucfirst($call) . "<span class=\"gz-gray dv-ml-ldpi\"></span>

						</td>";
						
				$ret .= "
						
					</tr>

				</for>

			</table>
		
		</div>
		
		<!-- Footer -->

		<div id=\"gz-footer\" class=\"dv-f-l dv-pt-mdpi dv-pb-mdpi\">
		
			<one(" . $table . ")>
			
				<div class=\"dv-f-l dv-mt-mdpi dv-mr-mdpi dv-mb-mdpi dv-ml-xdpi dv-pt-mdpi\">
				
					<p><gz>" . $table . ".size</gz> @_LAN_ITEMS_PAGE</p>
						
				</div>
				
				<gz>" . $table . ".pagination</gz>
					
				<div class=\"dv-f-l dv-mt-mdpi dv-mr-mdpi dv-mb-mdpi dv-ml-mdpi dv-pt-mdpi\">
			
					<p>@_LAN_OF <gz>" . $table . ".pages</gz></p>

				</div>

				<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-mdpi dv-ml-hdpi\" 
						onclick=\"goFirst();\">
						
					<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

						<img src=\"@_ROOT/res/img/ldpi/first.png\" />

						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_FIRST

						</span>

					</a>		
						
				</div>
				
				<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-mdpi dv-ml-hdpi\" onclick=\"goBack();\">

					<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

						<img src=\"@_ROOT/res/img/ldpi/back.png\" />

						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_PREVIOUS

						</span>

					</a>	
			
				</div>
				
				<div id=\"gz-button-next\" class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-mdpi dv-ml-hdpi\" 
						onclick=\"goNext(<gz>" . $table . ".size</gz>);\">
			
					<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

						<img src=\"@_ROOT/res/img/ldpi/next.png\" />

						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_NEXT

						</span>

					</a>	
					
				</div>
				
				<div id=\"gz-button-last\" class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-mdpi dv-ml-hdpi\" 
						onclick=\"goLast(<gz>" . $table . ".size</gz>);\">

					<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

						<img src=\"@_ROOT/res/img/ldpi/last.png\" />

						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_LAST

						</span>

					</a>	
						
				</div>
			
			</one>
			
		</div>

	</div>";

			if (!file_exists("../mod/cms/html/" . $table . "/" . $table . "CLL.htm")) {
				$fo = fopen("../mod/cms/html/" . $table . "/" . $table . "CLL.htm", "w");
				$fw = fwrite($fo, $ret);
				
				fclose($fo);
			}
			
			$ret = "<!-- Combo View -->

	<for(" . $table . ")>

		<option id=\"op_" . $table . "_<gz>" . $table . ".id</gz>\" value=\"<gz>" . $table . ".id</gz>\" <gz>" . $table . ".selected</gz>>
		
			<gz>" . $table . "." . $like . "</gz>
		
		</option>

	</for>";
			
			if (!file_exists("../mod/cms/html/" . $table . "/" . $table . "CMB.htm")) {
				$fo = fopen("../mod/cms/html/" . $table . "/" . $table . "CMB.htm", "w");
				$fw = fwrite($fo, $ret);
				
				fclose($fo);
			}
			
			$ret = "<!-- Create View -->
	
	<!-- Content -->

	<div id=\"gz-content\" class=\"dv-f-r\">
	
		<p class=\"dv-mt-mdpi dv-mr-xdpi dv-mb-mdpi dv-ml-xdpi gz-gray\">
		
			<one(titles)>
			
				<gz>menus.menu</gz> /

				<gz>telas.tela</gz> / 
				
				<span class=\"gz-black gz-bold\">
				
					Create
					
				</span>
				
			</one>	
				
		</p>
	
		<!-- Form -->

		<form id=\"gz-form\" class=\"dv-f-l dv-ml-xdpi dv-pt-ldpi\">" . $create . "

			<!-- Ok -->

			<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mr-hdpi dv-mb-xdpi\">

				<a href=\"#\" onclick=\"request('" . $table . "', 'create'); return false;\" class=\"gz-tooltip\">

					<img src=\"@_ROOT/res/img/ldpi/ok.png\" />

					<span class=\"gz-span-top-right @_THEME\">

						@_LAN_CONFIRM

					</span>

				</a>

			</div>
			
			<!-- Cancel -->
			
			<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-xdpi\">

				<a href=\"#\" onclick=\"cancel(); return false;\" class=\"gz-tooltip\">

					<img src=\"@_ROOT/res/img/ldpi/cancel.png\" />

					<span class=\"gz-span-top-right @_THEME\">

						@_LAN_CANCEL

					</span>

				</a>

			</div>
				
		</form>
	
	</div>";
			
			if (!file_exists("../mod/cms/html/" . $table . "/" . $table . "CRT.htm")) {
				$fo = fopen("../mod/cms/html/" . $table . "/" . $table . "CRT.htm", "w");
				$fw = fwrite($fo, $ret);
				
				fclose($fo);
			}
			
			$ret = "<!-- Read View -->
	
	<!-- Content -->
	
	<div id=\"gz-content\" class=\"dv-f-r dv-mt-xdpi dv-pt-xdpi\">

		<!-- Header -->

		<div id=\"gz-header\" class=\"dv-f-l dv-pt-mdpi dv-pb-mdpi\" onclick=\"clearSelection();\">
		
			<!-- Create -->

			<div id=\"gz-button-create\" class=\"gz-button dv-f-l dv-mt-mdpi dv-mr-mdpi dv-mb-mdpi dv-ml-xdpi\" 
					onclick=\"showCreate();\">
		
				<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

					<img src=\"@_ROOT/res/img/ldpi/create.png\" />

					<span class=\"gz-span-bottom-right @_THEME\">

						@_LAN_ADD

					</span>

				</a>

			</div>
			
			<!-- Search -->

			<input id=\"gz-search\" class=\"gz-textbox-mdpi dv-f-l dv-mt-mdpi dv-mr-hdpi dv-mb-mdpi dv-ml-hdpi gz-gray\" 
					type=\"text\" value=\"@_LAN_SEARCH_FOR\"
					onfocus=\"emptySearch(this.id);\" onblur=\"showSearch(this.id);\">

			<div id=\"gz-button-search\" class=\"gz-button dv-f-l dv-mt-mdpi\" 
					onclick=\"goSearch();\">

				<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

					<img src=\"@_ROOT/res/img/ldpi/search.png\" />

					<span class=\"gz-span-bottom-right @_THEME\">

						@_LAN_SEARCH

					</span>

				</a>

			</div>

			<!-- Delete -->

			<div class=\"gz-button dv-f-r dv-mt-mdpi dv-mr-xdpi\" onclick=\"showDelete();\">

				<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

					<img src=\"@_ROOT/res/img/ldpi/delete.png\" />
					
					<span class=\"gz-span-bottom-left @_THEME\">

						@_LAN_DELETE

					</span>
					
				</a>

			</div>

		</div>

		<!-- Table -->
		
		<div class=\"dv-pl-xdpi dv-pr-xdpi\">
		
			<p class=\"dv-mb-hdpi gz-gray\">
			
				<one(titles)>
				
					<gz>menus.menu</gz> /
					
					<span class=\"gz-black gz-bold\">
					
						<gz>telas.tela</gz>
						
					</span>
					
				</one>	
					
			</p>
		
			<table>
				
				<tr>

					<th id=\"" . $table . ".id\" style=\"display:none;\"
							onclick=\"orderBy(this.id);\">

						Id

					</th>";
					
				if ($call != "")
					$ret .= "
					
					<th id=\"" . $table . "." . $like . "\" style=\"width:80%;\" 
							onclick=\"orderBy(this.id);\">
							
						" . ucfirst($like) . "
						
					</th>
					
					<th id=\"" . $table . "." . $like . "\" style=\"width:20%;\" 
							onclick=\"orderBy(this.id);\">
							
						" . ucfirst($call) . "
						
					</th>";
					
				else 
					$ret .= "
					
					<th id=\"" . $table . "." . $like . "\" style=\"width:100%;\" 
							onclick=\"orderBy(this.id);\">
							
						" . ucfirst($like) . "
						
					</th>";
					
				$onClickTr = "";	
				$onClickTd = "";
				
				if ($call == "") {
					$onClickTr = "onclick=\"selected(<gz>" . $table . ".line</gz>);\"";
					$onClickTd = "";
				} else {
					$onClickTr = "";
					$onClickTd = " onclick=\"selected(<gz>" . $table . ".line</gz>);\"";
				}
				
				$ret .= "		

				</tr>

				<for(" . $table . ")>

					<tr id=\"<gz>" . $table . ".line</gz>\" 
							onMouseOver=\"onFocus(<gz>" . $table . ".line</gz>);\" 
							onMouseOut=\"outFocus(<gz>" . $table . ".line</gz>);\" 
							" . $onClickTr . ">

						<td style=\"display:none;\"><gz>" . $table . ".id</gz></td>

						<td" . $onClickTd . "><gz>" . $table . "." . $like . "</gz></td>";
						
				if ($call != "")
					$ret .= "
				
						<td class=\"gz-link\" onclick=\"goTo('/" . $call . "/called/<gz>" . $table . ".id</gz>/1/historyBack/' + gz_historyBack);\">
									
							<img class=\"dv-mr-ldpi\" src=\"@_ROOT/res/img/ldpi/grid-next.png\" />
									
							" . ucfirst($call) . " <span class=\"gz-gray dv-ml-ldpi\"></span>
								
						</td>";
						
				$ret .= "
						
					</tr>

				</for>

			</table>
		
		</div>
		
		<!-- Footer -->

		<div id=\"gz-footer\" class=\"dv-f-l dv-pt-mdpi dv-pb-mdpi\">
		
			<one(" . $table . ")>
		
				<div class=\"dv-f-l dv-mt-mdpi dv-mr-mdpi dv-mb-mdpi dv-ml-xdpi dv-pt-mdpi\">
				
					<p><gz>" . $table . ".size</gz> @_LAN_ITEMS_PAGE</p>
						
				</div>
				
				<gz>" . $table . ".pagination</gz>
					
				<div class=\"dv-f-l dv-mt-mdpi dv-mr-mdpi dv-mb-mdpi dv-ml-mdpi dv-pt-mdpi\">
			
					<p>@_LAN_OF <gz>" . $table . ".pages</gz></p>

				</div>

				<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-mdpi dv-ml-hdpi\" 
						onclick=\"goFirst();\">
						
					<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

						<img src=\"@_ROOT/res/img/ldpi/first.png\" />

						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_FIRST

						</span>

					</a>	
			
				</div>
				
				<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-mdpi dv-ml-hdpi\" onclick=\"goBack();\">

					<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

						<img src=\"@_ROOT/res/img/ldpi/back.png\" />

						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_PREVIOUS

						</span>

					</a>	
			
				</div>
				
				<div id=\"gz-button-next\" class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-mdpi dv-ml-hdpi\" 
						onclick=\"goNext(<gz>" . $table . ".size</gz>);\">
			
					<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

						<img src=\"@_ROOT/res/img/ldpi/next.png\" />

						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_NEXT
							
						</span>

					</a>	
					
				</div>
				
				<div id=\"gz-button-last\" class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-mdpi dv-ml-hdpi\" 
						onclick=\"goLast(<gz>" . $table . ".size</gz>);\">

					<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

						<img src=\"@_ROOT/res/img/ldpi/last.png\" />

						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_LAST

						</span>

					</a>	
						
				</div>
				
			</one>";
			
			$ret .= "
			
		</div>

	</div>";
	
			if (!file_exists("../mod/cms/html/" . $table . "/" . $table . "RD.htm")) {
				$fo = fopen("../mod/cms/html/" . $table . "/" . $table . "RD.htm", "w");
				$fw = fwrite($fo, $ret);
				
				fclose($fo);
			}	
			
			$ret = "<!-- Screen View -->

	<!-- Header -->

	<div id=\"gz-header-screen\" class=\"dv-f-l dv-mt-mdpi dv-pb-mdpi\">

		<!-- Create -->

		<div id=\"gz-button-create\" class=\"gz-button dv-f-l dv-mt-mdpi dv-mr-mdpi dv-mb-mdpi dv-ml-xdpi\" 
				onclick=\"target_blank('" . $table . "');\">
	
			<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

				<img src=\"@_ROOT/res/img/ldpi/create.png\" />

				<span class=\"gz-span-bottom-right @_THEME\">

					@_LAN_ADD

				</span>

			</a>

		</div>	

		<!-- Search -->

		<input id=\"gz-search\" class=\"gz-textbox-mdpi dv-f-l dv-mt-mdpi dv-mr-hdpi dv-mb-mdpi dv-ml-hdpi gz-gray\" 
				type=\"text\" value=\"@_LAN_SEARCH_FOR\"
				onfocus=\"emptySearch(this.id);\" onblur=\"showSearch(this.id);\">

		<div id=\"gz-button-search\" class=\"gz-button dv-f-l dv-mt-mdpi\" 
				onclick=\"screenSearch();\">

			<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

				<img src=\"@_ROOT/res/img/ldpi/search.png\" />

				<span class=\"gz-span-bottom-right @_THEME\">

					@_LAN_SEARCH

				</span>

			</a>

		</div>

		<!-- Close -->

		<div class=\"gz-button dv-f-r dv-mt-mdpi dv-mr-xdpi\" onclick=\"closeScreen();\">

			<a href=\"#\" class=\"gz-tooltip\" onclick=\"return false;\">

				<img src=\"@_ROOT/res/img/ldpi/cancel.png\" />

				<span class=\"gz-span-bottom-left @_THEME\">

					@_LAN_CLOSE

				</span>

			</a>

		</div>

	</div>
	
	<!-- Table -->
	
	<div class=\"dv-pl-xdpi dv-pr-xdpi\">
	
		<p id=\"gz-title-screen\" class=\"gz-gray dv-f-l\">
			
			<one(titles)>
			
				<gz>menus.menu</gz> /
				
				<span class=\"gz-black gz-bold\">
				
					<gz>telas.tela</gz>
					
				</span>
				
			</one>	
				
		</p>

		<table id=\"gz-table-screen\" class=\"dv-f-l\">

			<tr>

				<th style=\"display:none;\">Id</th>

				<th style=\"width:100%;\">" . ucfirst($like) . "</th>

			</tr>

			<for(" . $table . ")>

				<tr id=\"<gz>" . $table . ".line</gz>\" 
						onMouseOver=\"onFocus(<gz>" . $table . ".line</gz>);\" 
						onMouseOut=\"outFocus(<gz>" . $table . ".line</gz>);\" 
						onClick=\"selected(<gz>" . $table . ".line</gz>);\">

					<td style=\"display:none;\"><gz>" . $table . ".id</gz></td>

					<td><gz>" . $table . "." . $like . "</gz></td>			
					
				</tr>

			</for>

		</table>
	
	</div>";

			if (!file_exists("../mod/cms/html/" . $table . "/" . $table . "SCR.htm")) {
				$fo = fopen("../mod/cms/html/" . $table . "/" . $table . "SCR.htm", "w");
				$fw = fwrite($fo, $ret);
				
				fclose($fo);
			}
			
			$ret = "<!-- Update View -->
	
	<!-- Content -->

	<div id=\"gz-content\" class=\"dv-f-r\">
	
		<p class=\"dv-mt-mdpi dv-mr-xdpi dv-mb-mdpi dv-ml-xdpi gz-gray\">
		
			<one(titles)>
			
				<gz>menus.menu</gz> /

				<gz>telas.tela</gz> / 
				
				<span class=\"gz-black gz-bold\">
				
					Update
					
				</span>
				
			</one>	
				
		</p>
	
		<one(" . $table . ")>
	
			<!-- Form -->
				
			<form id=\"gz-form\" class=\"dv-f-l dv-ml-xdpi dv-pt-ldpi\">" . $update . "

				<!-- Ok -->

				<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mr-hdpi dv-mb-xdpi\">

					<a href=\"#\" onclick=\"request('" . $table . "', 'update'); return false;\" class=\"gz-tooltip\">

						<img src=\"@_ROOT/res/img/ldpi/ok.png\" />

						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_CONFIRM

						</span>

					</a>

				</div>
				
				<!-- Cancel -->
				
				<div class=\"gz-button dv-f-l dv-mt-mdpi dv-mb-xdpi\">

					<a href=\"#\" onclick=\"cancel(); return false;\" class=\"gz-tooltip\">

						<img src=\"@_ROOT/res/img/ldpi/cancel.png\"/>
						
						<span class=\"gz-span-top-right @_THEME\">

							@_LAN_CANCEL

						</span>

					</a>

				</div>
					
			</form>
			
		</one>
		
	</div>";

			if (!file_exists("../mod/cms/html/" . $table . "/" . $table . "UPD.htm")) {
				$fo = fopen("../mod/cms/html/" . $table . "/" . $table . "UPD.htm", "w");
				$fw = fwrite($fo, $ret);
				
				fclose($fo);
			}	

		}  

		public function model($table, $fields, $fk) {
			$ret = "<?php 
			
	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 */
	 
	namespace src\\model; 

	class " . ucfirst($table) . " {
			";
			
			if (count($fields) > 0) {
				foreach ($fields as $field => $type) {		
					$ret .= "
		private $" . $field . ";";
				}
			}
			
			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {		
					$ret .= "
		private $" . $foreignKey . ";";
				}
			}
			
			$ret .= "
			
		public function __construct() { }
			";
			
			if (count($fields) > 0) {
				foreach ($fields as $field => $tyle) {		
					$ret .= "
		public function set" . ucfirst($field) . "(\$" . $field . ") {
			\$this->" . $field . " = \$" . $field . ";
		}
		
		public function get" . ucfirst($field) . "() {
			return \$this->" . $field . ";
		}
					";
				}
			}
			
			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {		
					$ret .= "
		public function set" . ucfirst($foreignKey) . "(\$" . $foreignKey . ") {
			\$this->" . $foreignKey . " = \$" . $foreignKey . ";
		}
		
		public function get" . ucfirst($foreignKey) . "() {
			return \$this->" . $foreignKey . ";
		}
					";
				}
			}
			
			$ret .= "
	}
	
?>";
		
			if (!file_exists("../src/model/" . ucfirst($table) . ".php")) {
				$fo = fopen("../src/model/" . ucfirst($table) . ".php", "w");
				$fw = fwrite($fo, $ret);
				
				fclose($fo);
			}
		}

		/**
		 * @param {String} table
		 * @param {Array} fields
		 * @param {Array} fk
		 */
		public function dao($table, $fields, $fk) {
			$object = "";
			$like = "";
			$include = "";
			
			$count = 0;
			
			foreach ($fields as $field => $tyle) {	
				$count++;
				
				if ($count == 2)
					$like = $field;

				if ($count > 1)
					$object .= "\$" . $table . "->set" . ucfirst($field) . "(\$form[" . ($count - 2) . "]);";
			}	
			
			if (count($fk) > 0) {
				$include .= "
	
	use src\\model;";
				
				/*
				foreach ($fk as $foreignTable => $foreignKey) {	
						$include .= "
	
	require_once(\"" . $foreignTable . "Dao.php\");";
				}
				*/
			}

			$ret = "<?php
			
	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz 
	 */
	 
	namespace src\\model; " . $include . "
	
	class " . ucfirst($table) . "Dao {
	
		private \$connection;
		
		/*
		 * Constant variables
		 */
		private \$create = \"INSERT INTO " . $table . " (";
		
			$count = 0;
		
			if (count($fields) > 0) {
				foreach ($fields as $field => $type) {	
					$count++; 
					
					if ($count == 2)
						$ret .= "
				" . $field . "";
					else if ($count > 2)
						$ret .= "
				, " . $field . "";
				}
			}
			
			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {	
						$ret .= "
				, " . $foreignKey . "";
				}
			}
			
			$ret .= "
				) VALUES\";
				
		public \$read = ";
		
			$count = 0;
		
			if (count($fields) > 0) {
				foreach ($fields as $field => $type) {	
					$count++; 
					
					if ($count == 1)
						$ret .= "
				\"" . $table . "." . $field . " AS '" . $table . "." . $field . "'";
					else 
						$ret .= "
				, " . $table . "." . $field . " AS '" . $table . "." . $field . "'";
				}
			}
			
			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {	
						$ret .= "
				, " . $table . "." . $foreignKey . " AS '" . $table . "." . $foreignKey . "'";
				}
			}	

			$ret .= "
				\";
				
		private \$update = \"UPDATE " . $table . " SET\";
		private \$delete = \"DELETE FROM " . $table . "\";
		
		public \$from = \"" . $table . " " . $table . "\";
		
		/*
		 * Parameters
		 */
		private \$where;
		private \$order;
		
		// Dynamic query
		private \$sql;
		
		// Controller response
		private \$response;	
		
		/**
		 * @param {Object} connection
		 */
		public function __construct(\$connection) {
			\$this->connection = \$connection;
		}

		/**
		 * @param {" . ucfirst($table) . "}" . $table . "
		 */
		public function setCreate(\$" . $table . ") {		
			\$this->sql = \$this->create . \" (\\\"\" . ";
			
			$count = 0;
			
			if (count($fields) > 0) {
				foreach ($fields as $field => $type) {	
					$count++; 
					
					if ($count == 2)
						$ret .= "
					\$" . $table . "->get" . ucfirst($field) . "() .";
					else if ($count > 2)
						$ret .= "
					\"\\\", \\\"\" . \$" . $table . "->get" . ucfirst($field) . "() .";
				}
			}
			
			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {	
						$ret .= "
					\"\\\", \\\"\" . \$" . $table . "->get" . ucfirst($foreignKey) . "() .";
				}
			}
			
			$ret .= "
					\"\\\")\";
		}
		
		/**
		 * @return {String}
		 */
		public function getCreate() {
			return \$this->sql;
		}	
		
		/**
		 * @param {String} where
		 * @param {String} order
		 */
		public function setRead(\$where, \$order) {";

			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {	
						$ret .= "
			\$" . $foreignTable . "Dao = new model\\" . ucfirst($foreignTable) . "Dao(\$this->connection);";
				}
			}
		
			if (count($fk) == 0) {
				$ret .= "
			
			\$this->setWhere(\$where);
			\$this->setOrder(\$order);
			
			\$this->sql = \"SELECT \" . \$this->read . \" FROM \" . \$this->getFrom() . 
					\$this->getWhere() . \"
				";
			} else {
				$ret .= "
			
			\$this->setWhere(\$where);
			\$this->setOrder(\$order);
			
			\$this->sql = \"SELECT \" . \$this->read . ";
			
				foreach ($fk as $foreignTable => $foreignKey) {	
					$ret .= "\", \" . \$" . $foreignTable . "Dao->read . ";
				}
				
				$ret .= "
					\" FROM \" . \$this->getFrom() .";
				
				foreach ($fk as $foreignTable => $foreignKey) {	
					$ret .= "\", \" . \$" . $foreignTable . "Dao->from . ";
				}
				
				$ret .= "
					(\$this->getWhere() == \"\" ? \" WHERE ";

				$count = 0;
				
				foreach ($fk as $foreignTable => $foreignKey) {	
					$count++;
					
					if ($count == 1) 
						$ret .= "" . $table . "." . $foreignKey . " = " . $foreignTable . ".id";
					else 
						$ret .= " AND " . $table . "." . $foreignKey . " = " . $foreignTable . ".id";
				}	
					
				$ret .= "\" : \$this->getWhere()) . 
					\"";
				
				foreach ($fk as $foreignTable => $foreignKey) {	
					$ret .= " AND " . $table . "." . $foreignKey . " = " . $foreignTable . ".id";
				}	
			}
			
			$ret .= "\" . \$this->getOrder();
		}
		
		/**
		 * @return {String}
		 */
		public function getRead() {
			return \$this->sql;
		}
		
		/**
		 * @param {" . ucfirst($table) . "}" . $table . "  
		 * @param {String} where
		 */
		public function setUpdate(\$" . $table . ", \$where) {
			\$this->setWhere(\$where);
			
			\$this->sql = \$this->update . ";
			
			$count = 0;
			
			if (count($fields) > 0) {
				foreach ($fields as $field => $type) {	
					$count++; 
					
					if ($type != "new") {
						if ($count == 1)
							$ret .= "
					\" " . $field . " = \\\"\" . \$" . $table . "->get" . ucfirst($field) . "() . ";
						else
							$ret .= "
					\"\\\", " . $field . " = \\\"\" . \$" . $table . "->get" . ucfirst($field) . "() . ";
					}
				}
			}
			
			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {	
					$ret .= "
					\"\\\", " . $foreignKey . " = \\\"\" . \$" . $table . "->get" . ucfirst($foreignKey) . "() . ";
				}
			}
	
			$ret .= "
					\"\\\"\" . \$this->getWhere();
		}
		
		/**
		 * @return {String}
		 */
		public function getUpdate() {
			return \$this->sql;
		}
		
		/**
		 * @param {String} where
		 */
		public function setDelete(\$where) {	
			\$this->setWhere(\$where);
			
			\$this->sql = \$this->delete . \$this->getWhere();
		}
		
		/**
		 * @return {String}
		 */
		public function getDelete() {
			return \$this->sql;
		}
		
		/**
		 * @return {String}
		 */
		public function getFrom() {
			return \$this->from;
		}
		
		/**
		 * @param {String} where
		 */
		public function setWhere(\$where) {
			if (\$where != \"\")
				\$this->where = \" WHERE \" . \$where;
			else
				\$this->where = \"\";
		}
		
		/**
		 * @return {String}
		 */
		public function getWhere() {
			return \$this->where;
		}
		
		/**
		 * @param {String} order
		 */
		public function setOrder(\$order) {
			if (\$order != \"\")
				\$this->order = \" ORDER BY \" . \$order;
			else
				\$this->order = \"\";
		}
		
		/**
		 * @return {String}
		 */
		public function getOrder() {
			return \$this->order;
		}
		
		/**
		 * @param {Integer} line
		 * @param column String
		 * @param value String
		 */
		private function setResponse(\$line, \$column, \$value) {
			\$this->response[\$line][\$column] = \$value;
		}

		/**
		 * @return {Array}
		 */
		private function getResponse() {
			return \$this->response;
		}

		/**
		 * @param {String} where
		 */
		private function setSize(\$where) {
			\$this->setWhere(\$where);
			
			\$result = \$this->connection->execute(
					\"SELECT count(1) AS '" . $table . ".size' from " . $table . "\" . \$this->getWhere());

			while (\$row = \$result->fetch_assoc()) {		
				\$this->setResponse(0, \"" . $table . ".size\", \$row[\"" . $table . ".size\"]);
				
				\$pages = ceil(\$row[\"" . $table . ".size\"] / \$this->connection->getItensPerPage());
				
				\$this->setResponse(0, \"" . $table . ".pages\", \$pages);
				
				\$pagination = \"<select id=\\\"gz-select-pagination\\\" onchange=\\\"goPage();\\\">\";
				
				for (\$i = 1; \$i <= \$pages; \$i++) {
					if (\$i == \$this->connection->getPosition())
						\$pagination .= \"<option value=\\\"\" . \$i . \"\\\" selected>\" . \$i . \"</option>\";
					else
						\$pagination .= \"<option value=\\\"\" . \$i . \"\\\">\" . \$i . \"</option>\";
				}	

				\$pagination .= \"</select>\";
						
				\$this->setResponse(0, \"" . $table . ".pagination\", \$pagination);
			}

			\$this->connection->free(\$result);
		}
		
		/**
		 * @param {Integer} line
		 */
		public function setDivLine(\$line) {
			\$this->setResponse(\$line - 1, \"@_START_LINE_TWO\", modelStartLine(\$line, 2));
			\$this->setResponse(\$line - 1, \"@_END_LINE_TWO\", modelEndLine(\$line, 2));

			\$this->setResponse(\$line - 1, \"@_START_LINE_THREE\", modelStartLine(\$line, 3));
			\$this->setResponse(\$line - 1, \"@_END_LINE_THREE\", modelEndLine(\$line, 3));
			
			\$this->setResponse(\$line - 1, \"@_START_LINE_FOUR\", modelStartLine(\$line, 4));
			\$this->setResponse(\$line - 1, \"@_END_LINE_FOUR\", modelEndLine(\$line, 4));
		}
		
		/**
		 * @param {Integer} line
		 */
		public function checkDivLine(\$line) {
			if (modelCheckEndLine(\$line, 2) != \"\")
				\$this->setResponse(\$line - 1, \"@_END_LINE_TWO\", modelCheckEndLine(\$line, 2));
			
			if (modelCheckEndLine(\$line, 3) != \"\")
				\$this->setResponse(\$line - 1, \"@_END_LINE_THREE\", modelCheckEndLine(\$line, 3));		

			if (modelCheckEndLine(\$line, 4) != \"\")
				\$this->setResponse(\$line - 1, \"@_END_LINE_FOUR\", modelCheckEndLine(\$line, 4));			
		}	

		/**
		 * @param {String} log
		 */
		private function setLog(\$log) {
			\$this->setResponse(0, \"log\", \$log);
		}
		
		/**
		 * @param {" . ucfirst($table) . "} " . $table . " 
		 * @return {Boolean}
		 */
		public function create(\$" . $table . ") {
			\$result = \"\";

			\$this->setCreate(\$" . $table . ");
			\$result = \$this->connection->execute(\$this->getCreate());
			
			return \$result;
		}

		/**
		 * @param {String} where
		 * @param {String} order
		 * @param {Boolean} wp
		 * @param {Array}
		 */
		public function read(\$where, \$order, \$wp) {
			\$line = 0;

			\$this->setRead(\$where, \$order);
			\$result = \$this->connection->execute(\$this->getRead());

			while (\$row = \$result->fetch_assoc()) {";
			
			if (count($fields) > 0) {
				foreach ($fields as $field => $type) {
					$function = ($type == "string64" ? "" :  
						($type == "double" ? "modelDouble(" : 
						($type == "date" ? "modelDate(" : 
						($type == "datetime" ? "modelDateTime(" : 
						($type == "new" ? "modelDateTime(" : 
						($type == "now" ? "modelDateTime(" : ""))))));
					
					$close = ($type == "string64" ? "" :  
						($type == "double" ? ")" : 
						($type == "date" ? ")" : 
						($type == "datetime" ? ")" : 
						($type == "new" ? ")" : 
						($type == "now" ? ")" : ""))))));
						
					$ret .= "
				\$this->setResponse(\$line, \"" . $table . "." . $field . "\", " . $function . "\$row[\"" . $table . "." . $field . "\"])" . $close . ";";
				
					if ($type == "string64")
						$ret .= "
				\$this->setResponse(\$line, \"" . $table . "." . $field . ".format\", modelTextArea(\$row[\"" . $table . "." . $field . "\"]));";
				}
			}
			
			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {	
					$ret .= "
				\$this->setResponse(\$line, \"" . $table . "." . $foreignKey . "\", \$row[\"" . $table . "." . $foreignKey . "\"]);
				\$this->setResponse(\$line, \"" . $foreignTable . "." . $foreignKey . "\", \$row[\"" . $foreignTable . "." . $foreignKey . "\"]);";
				}
			}
			
			if ($table == "usuarios")
				$ret .= "
				\$this->setResponse(\$line, \"temas.identificador\", \$row[\"temas.identificador\"]);";

			$ret .= "
			
				\$this->setResponse(\$line, \"" . $table . ".line\", \$line);
			
				\$line++;
				
				if (\$wp)
					\$this->setDivLine(\$line);
			}

			\$this->connection->free(\$result);
			
			if (\$wp && \$line > 0) {
				\$this->checkDivLine(\$line);
				
				\$this->setSize(\$where);
			}

			return \$this->getResponse();
		}

		/**
		 * @param {" . ucfirst($table) . "} " . $table . " 
		 * @return {Boolean}
		 */
		public function update(\$" . $table . ") {
			\$result = \"\";
			
			\$this->setUpdate(\$" . $table . ", \"" . $table . ".id = \" . \$" . $table . "->getId());
			\$result = \$this->connection->execute(\$this->getUpdate());

			return \$result;
		}

		/**
		 * @param {String} where
		 * @return {Boolean}
		 */
		public function delete(\$where) {
			\$result = \"\";
			
			\$this->setDelete(\$where);
			\$result = \$this->connection->execute(\$this->getDelete());

			return \$result;
		}
		
		/**
		 * @param {Integer} selected
		 * @param {String} order
		 * @return {Array}
		 */
		public function combo(\$selected, \$order) {
			\$size = 0;

			\$this->setRead(\"\", \$order);
			\$result = \$this->connection->execute(\$this->getRead());

			while (\$row = \$result->fetch_assoc()) {
				\$this->setResponse(\$size, \"" . $table . ".id\", \$row[\"" . $table . ".id\"]);
				\$this->setResponse(\$size, \"" . $table . "." . $like . "\", \$row[\"" . $table . "." . $like . "\"]);
			
				if (\$row[\"" . $table . ".id\"] == \$selected)
					\$this->setResponse(\$size, \"" . $table . ".selected\", \"selected\");
				else
					\$this->setResponse(\$size, \"" . $table . ".selected\", \"\");
					
				\$size++;
			}
			
			\$this->connection->free(\$result);
			
			\$this->setResponse(0, \"size\", \$size);

			return \$this->getResponse();
		}
		
		/**
		 * @param {String} where
		 * @return {Array}
		 */
		public function comboScr(\$where) {
			\$size = 0;

			\$this->setRead(\$where, \"\");
			\$result = \$this->connection->execute(\$this->getRead());

			while (\$row = \$result->fetch_assoc()) {
				\$this->setResponse(\$size, \"" . $table . ".id\", \$row[\"" . $table . ".id\"]);
				\$this->setResponse(\$size, \"" . $table . "." . $like . "\", \$row[\"" . $table . "." . $like . "\"]);
				\$this->setResponse(\$size, \"" . $table . ".selected\", \"selected\");
					
				\$size++;
			}
			
			\$this->connection->free(\$result);
			
			\$this->setResponse(0, \"size\", \$size);

			return \$this->getResponse();
		}

	}

?>";
		
			if (!file_exists("../src/model/" . ucfirst($table) . "Dao.php")) {
				$fo = fopen("../src/model/" . ucfirst($table) . "Dao.php", "w");
				$fw = fwrite($fo, $ret);
				
				fclose($fo);
			}
		} 	
	
	    /*
		 * @param {String} table
		 * @param {Array} fields
		 * @param {Array} fk
		 * @param {String} answer
		 */
		public function controller($table, $fields, $fk, $answer) {
			$object = "";
			$objectWS = "";
			$delete = "";
			$deleteWS = "";
			$update = "";
			$updateWS = "";
			$like = "";
			
			$count = 0;
			
			foreach ($fields as $field => $type) {	
				$count++;
				
				if ($count == 2)
					$like = $field;

				if ($count > 1) {
					$function = ($type == "double" ? "controllerDouble(" : 
						($type == "date" ? "controllerDate(" : ($type == "datetime" ? "controllerDateTime(" : "")));
					
					$close = ($type == "double" ? ")" : 
						($type == "date" ? ")" : ($type == "datetime" ? ")" : "")));

					if ($type == "new" || $type == "now") {
						$object .= "\$" . $table . "->set" . ucfirst($field) . "(date(\"Y-m-d H:i:s\", (time() - 3600 * 3)));
					";	
					
						$objectWS .= "\$" . $table . "->set" . ucfirst($field) . "(date(\"Y-m-d H:i:s\", (time() - 3600 * 3)));
		";		
					
						$update .= "\$" . $table . "->set" . ucfirst($field) . "(date(\"Y-m-d H:i:s\", (time() - 3600 * 3)));
					";	
					
						$updateWS .= "\$" . $table . "->set" . ucfirst($field) . "(date(\"Y-m-d H:i:s\", (time() - 3600 * 3)));
		";			
						
						$count--;
					} else if ($type == "photo") {
						$delete = "
						/*
						 * Unlink
						 */
						\$" . $table . "Dao = \$daoFactory->get" . ucfirst($table) . "Dao()->read(\$where, \"\", false);
						
						if (\$" . $table . "Dao[0][\"" . $table . ".foto\"] != \"\") {	
							unlink(\$_DOCUMENT_ROOT . \"/res/img/mdpi/\" . \$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
							unlink(\$_DOCUMENT_ROOT . \"/res/img/hdpi/\" . \$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
						}
						";
						
						$deleteWS = "
			\$" . $table . "Dao = \$daoFactory->get" . ucfirst($table) . "Dao()->read(\$where, \"\", false);
			
			if (\$" . $table . "Dao[0][\"" . $table . ".foto\"] != \"\") {	
				unlink(\$_DOCUMENT_ROOT . \"/res/img/mdpi/\" . \$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
				unlink(\$_DOCUMENT_ROOT . \"/res/img/hdpi/\" . \$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
			}
			";				
						
						$update .= "
					/*
					 * Get object
					 */
					\$where = \"" . $table . ".id = \" . \$code;
					
					\$daoFactory->beginTransaction();
					\$" . $table . "Dao = \$daoFactory->get" . ucfirst($table) . "Dao()->read(\$where, \"\", false);
					\$daoFactory->close();
						
					/*
					 * Upload File
					 */
					if (isset(\$_FILES[\"upload\"])) {
						if (\$" . $table . "Dao[0][\"" . $table . ".foto\"] != \"\") {	
							/*
							 * Unlink
							 */
							unlink(\$_DOCUMENT_ROOT . \"/res/img/mdpi/\" . \$" . $table . "Dao[0][\"" . $table . ".foto\"]);
							unlink(\$_DOCUMENT_ROOT . \"/res/img/hdpi/\" . \$" . $table . "Dao[0][\"" . $table . ".foto\"]);
						}
						
						\$upload = new getz\Upload(\$_FILES[\"upload\"], " . ($table == "temas" ? "1800" : "680")  . ");
						\$" . $table . "->set" . ucfirst($field) . "(\$upload->getName());
					} else 
						\$" . $table . "->set" . ucfirst($field) . "(\$" . $table . "Dao[0][\"" . $table . ".foto\"]);
						
					";
					
						$updateWS .= "
		\$where = \"" . $table . ".id = \" . \$code;
		
		\$daoFactory->beginTransaction();
		\$" . $table . "Dao = \$daoFactory->get" . ucfirst($table) . "Dao()->read(\$where, \"\", false);
		\$daoFactory->close();
			
		if (isset(\$_FILES[\"upload\"])) {
			if (\$" . $table . "Dao[0][\"" . $table . ".foto\"] != \"\") {	
				unlink(\$_DOCUMENT_ROOT . \"/res/img/mdpi/\" . \$" . $table . "Dao[0][\"" . $table . ".foto\"]);
				unlink(\$_DOCUMENT_ROOT . \"/res/img/hdpi/\" . \$" . $table . "Dao[0][\"" . $table . ".foto\"]);
			}
			
			\$upload = new getz\Upload(\$_FILES[\"upload\"], " . ($table == "temas" ? "1800" : "680")  . ");
			\$" . $table . "->set" . ucfirst($field) . "(\$upload->getName());
		} else 
			\$" . $table . "->set" . ucfirst($field) . "(\$" . $table . "Dao[0][\"" . $table . ".foto\"]);
			
		";
					
						$object .= "
					/*
					 * Upload File
					 */
					if (isset(\$_FILES[\"upload\"])) {
						\$upload = new getz\Upload(\$_FILES[\"upload\"], " . ($table == "temas" ? "1800" : "680")  . ");
						\$" . $table . "->set" . ucfirst($field) . "(\$upload->getName());
					} else 
						\$" . $table . "->set" . ucfirst($field) . "(\"\");
						
					";
					
			$objectWS .= "
		if (isset(\$_FILES[\"upload\"])) {
			\$upload = new getz\Upload(\$_FILES[\"upload\"], " . ($table == "temas" ? "1800" : "680")  . ");
			\$" . $table . "->set" . ucfirst($field) . "(\$upload->getName());
		} else 
			\$" . $table . "->set" . ucfirst($field) . "(\"\");
			
		";	
					
						$count--;
					} else if ($type == "upload") {
						$delete = "
						/*
						 * Unlink
						 */
						\$" . $table . "Dao = \$daoFactory->get" . ucfirst($table) . "Dao()->read(\$where, \"\", false);
						
						if (\$" . $table . "Dao[0][\"" . $table . ".upload\"] != \"\")
							unlink(\$_DOCUMENT_ROOT . \"/res/doc/\" . \$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
						";
						
						$deleteWS = "
			\$" . $table . "Dao = \$daoFactory->get" . ucfirst($table) . "Dao()->read(\$where, \"\", false);
			
			if (\$" . $table . "Dao[0][\"" . $table . ".upload\"] != \"\")
				unlink(\$_DOCUMENT_ROOT . \"/res/doc/\" . \$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
			";	
						
						$update .= "
					/*
					 * Get object
					 */
					\$where = \"" . $table . ".id = \" . \$code;
					
					\$daoFactory->beginTransaction();
					\$" . $table . "Dao = \$daoFactory->get" . ucfirst($table) . "Dao()->read(\$where, \"\", false);
					\$daoFactory->close();
						
					/*
					 * Upload File
					 */
					if (isset(\$_FILES[\"upload\"])) {
						/*
						 * Unlink
						 */
						if (\$" . $table . "Dao[0][\"" . $table . "." . $field . "\"] != \"\")
							unlink(\$_DOCUMENT_ROOT . \"/res/doc/\" . \$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
						
						\$upload = new getz\Upload(\$_FILES[\"upload\"], 0);
						\$" . $table . "->set" . ucfirst($field) . "(\$upload->getName());
					} else 
						\$" . $table . "->set" . ucfirst($field) . "(\$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
						
					";
					
						$updateWS .= "
		\$where = \"" . $table . ".id = \" . \$code;
		
		\$daoFactory->beginTransaction();
		\$" . $table . "Dao = \$daoFactory->get" . ucfirst($table) . "Dao()->read(\$where, \"\", false);
		\$daoFactory->close();
			
		if (isset(\$_FILES[\"upload\"])) {
			if (\$" . $table . "Dao[0][\"" . $table . "." . $field . "\"] != \"\")
				unlink(\$_DOCUMENT_ROOT . \"/res/doc/\" . \$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
		
			\$upload = new getz\Upload(\$_FILES[\"upload\"], 0);
			\$" . $table . "->set" . ucfirst($field) . "(\$upload->getName());
		} else 
			\$" . $table . "->set" . ucfirst($field) . "(\$" . $table . "Dao[0][\"" . $table . "." . $field . "\"]);
			
		";	
		
						$object .= "
					/*
					 * Upload File
					 */
					if (isset(\$_FILES[\"upload\"])) {
						\$upload = new getz\Upload(\$_FILES[\"upload\"], 0);
						\$" . $table . "->set" . ucfirst($field) . "(\$upload->getName());
					} else 
						\$" . $table . "->set" . ucfirst($field) . "(\"\");
						
					";
					
						$objectWS .= "
		if (isset(\$_FILES[\"upload\"])) {
			\$upload = new getz\Upload(\$_FILES[\"upload\"], 0);
			\$" . $table . "->set" . ucfirst($field) . "(\$upload->getName());
		} else 
			\$" . $table . "->set" . ucfirst($field) . "(\"\");
			
		";			
					
						$count--;	
					} else {
						$object .= "\$" . $table . "->set" . ucfirst($field) . "(logicNull(" . $function . "\$form[" . ($count - 2) . "]))" . $close . ";
					";
					
						$objectWS .= "\$" . $table . "->set" . ucfirst($field) . "(logicNull(" . $function . "\$form[" . ($count - 2) . "]))" . $close . ";
		";	
					
						$update .= "\$" . $table . "->set" . ucfirst($field) . "(logicNull(" . $function . "\$form[" . ($count - 2) . "]))" . $close . ";
					";
					
						$updateWS .= "\$" . $table . "->set" . ucfirst($field) . "(logicNull(" . $function . "\$form[" . ($count - 2) . "]))" . $close . ";
		";	
					}
				}
			}
			
			if (count($fk) > 0) {
				foreach ($fk as $foreignTable => $foreignKey) {
					$count++;

					$object .= "\$" . $table . "->set" . ucfirst($foreignKey) . "(\$form[" . ($count - 2) . "]);
					";
					
					$objectWS .= "\$" . $table . "->set" . ucfirst($foreignKey) . "(\$form[" . ($count - 2) . "]);
		";		
					
					$update .= "\$" . $table . "->set" . ucfirst($foreignKey) . "(\$form[" . ($count - 2) . "]);
					";
					
					$updateWS .= "\$" . $table . "->set" . ucfirst($foreignKey) . "(\$form[" . ($count - 2) . "]);
		";
				}
			}

			$ret = '<?php

	/**
	 * Generated by Getz Framework
	 *
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 */
	 
	use lib\\getz;
	use src\\model;	 

	require_once($_DOCUMENT_ROOT . "/lib/getz/Activator.php");
	
	/*
	 * Filters
	 */
	$where = "";
	
	if ($search != "")
		$where = "' . $table . '.' . $like . ' LIKE \"%" . $search . "%\"";	
		
	if ($code != "")
		$where = "' . $table . '.id = " . $code;
		
	if ($order != "") {
		$o = explode("<gz>", $order);

		$limit = $o[0] . " " . $o[1] . " LIMIT " . 
				(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;
				
	} else
		$limit = "' . $table . '.id DESC LIMIT " . 
				(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;	
	
	/**************************************************
	 * Webpage
	 **************************************************/		
	
	/*
	 * Page
	 */
	if ($method == "page") {
		/*
		 * SEO
		 */
		$darth->setTitle($screen);
		$darth->setDescription("");
		$darth->setKeywords("");
		
		$daoFactory->beginTransaction();
		$response[0]["' . $table . '"] = $daoFactory->get' . ucfirst($table) . 'Dao()->read($where, $limit, true);
		$daoFactory->close();

		echo $darth->view("", $_DOCUMENT_ROOT . $_PACKAGE . "/html/header.htm");
		echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/' . $table . '.htm");
		echo $darth->view("", $_DOCUMENT_ROOT . $_PACKAGE . "/html/footer.htm");
	}
	
	/**************************************************
	 * Webservice
	 **************************************************/	

	/*
	 * Method
	 */
	else if ($method == "method")
		echo "Parameters: " . (isset($_GET["parameters"]) ? $_GET["parameters"] : "");	 
	
	/*
	 * Create
	 *
	else if ($method == "ws-create") {
		$' . $table . ' = new model\\' . ucfirst($table) . '();
		' . $objectWS . '
		$daoFactory->beginTransaction();
		$resultDao = $daoFactory->get' . ucfirst($table) . 'Dao()->create($' . $table . ');

		if ($resultDao) {
			$daoFactory->commit();
			$response[0]["message"] = "success";
		} else {							
			$daoFactory->rollback();
			$response[0]["message"] = "error";
		}

		$daoFactory->close();

		echo $darth->json($response);
	}
	*/
	
	/*
	 * Read
	 *
	else if ($method == "ws-read") {
		$daoFactory->beginTransaction();
		$response[0]["' . $table . '"] = $daoFactory->get' . ucfirst($table) . 'Dao()->read($where, $limit, false);
		$daoFactory->close();

		echo $darth->json($response[0]["' . $table . '"]);
	}
	*/
	
	/*
	 * Update
	 *
	else if ($method == "ws-update") {	
		$' . $table . ' = new model\\' . ucfirst($table) . '();
		$' . $table . '->setId($code);
		' . $updateWS . '
		$daoFactory->beginTransaction();
		$resultDao = $daoFactory->get' . ucfirst($table) . 'Dao()->update($' . $table . ');

		if ($resultDao) {
			$daoFactory->commit();
			$response[0]["message"] = "success";
		} else {							
			$daoFactory->rollback();
			$response[0]["message"] = "error";
		}

		$daoFactory->close();

		echo $darth->json($response);
	}
	*/
	
	/* 
	 * Delete
	 *
	else if ($method == "ws-delete") {
		$result = true;
		$lines = explode("<gz>", $code);

		$daoFactory->beginTransaction();

		for ($i = 0; $i < sizeof($lines); $i++) {
			$where = "' . $table . '.id = " . $lines[$i];
			' . $deleteWS . '
			$resultDao = $daoFactory->get' . ucfirst($table) . 'Dao()->delete($where);
			$result = !$result ? false : (!$resultDao ? false : true);
		}

		if ($result) {
			$daoFactory->commit();
			$response[0]["message"] = "success";
		} else {							
			$daoFactory->rollback();
			$response[0]["message"] = "error";
		}

		$daoFactory->close();

		echo $darth->json($response);
	} 	
	*/
	
	/**************************************************
	 * System
	 **************************************************/	
	
	else {
		if (!getActiveSession($_ROOT . $_MODULE)) 
			echo "<script>goTo(\"/login/1\");</script>";
		else {
			/*
			 * Create
			 */
			if ($method == "stateCreate") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					$daoFactory->beginTransaction();
					$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \'" . $screen . "\'", "", true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/' . $table . '/' . $table . 'CRT.htm");
				}
			}

			/*
			 * Read
			 */
			else if ($method == "stateRead") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					$daoFactory->beginTransaction();
					$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \'" . $screen . "\'", "", true);
					$response[0]["' . $table . '"] = $daoFactory->get' . ucfirst($table) . 'Dao()->read($where, $limit, true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/' . $table . '/' . $table . 'RD.htm");
				}
			}

			/*
			 * Update
			 */
			else if ($method == "stateUpdate") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					$daoFactory->beginTransaction();
					$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \'" . $screen . "\'", "", true);
					$response[0]["' . $table . '"] = $daoFactory->get' . ucfirst($table) . 'Dao()->read($where, "", true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/' . $table . '/' . $table . 'UPD.htm");
				}
			}

			/*
			 * Called
			 */
			else if ($method == "stateCalled") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					/*
					 * Insert your foreign key here
					 */
					if ($where != "")
						$where .= " AND ' . $table . '.' . ($answer == "" ? "@_FOREIGN_KEY" : $answer) . ' = " . $base;
					else 
						$where = "' . $table . '.' . ($answer == "" ? "@_FOREIGN_KEY" : $answer) . ' = " . $base;
						
					$daoFactory->beginTransaction();
					$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \'" . $screen . "\'", "", true);
					$response[0]["' . $table . '"] = $daoFactory->get' . ucfirst($table) . 'Dao()->read($where, $limit, true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/' . $table . '/' . $table . 'CLL.htm");
				}
			}

			/*
			 * Screen
			 */
			else if ($method == "screen") {';

			if ($table == 'telas') {
				$ret .= '
				$where = "telas.id NOT IN(" . 
						"SELECT " . 
							"perfil_telas.tela AS \'perfil_telas.tela\' " . 
						"FROM " . 
							"perfil_telas perfil_telas " .
						"WHERE " .
							"perfil_telas.perfil = " . $base . 
						")";				
				';
			}
			
			$ret .= '
				if ($base != "") {
					$arrBase = explode("<gz>", $base);
					
					if (sizeof($arrBase) > 1)
						$where = "' . $table . '.@_FOREIGN_KEY = " . $arrBase[1];
				}';
				
			if ($table == 'telas') {
				$ret .= '
				
				if ($search != "")
					if ($where != "")
						$where .= " AND telas.tela LIKE \"%" . $search . "%\"";	
					else
						$where = "telas.tela LIKE \"%" . $search . "%\"";	
				';
			}	
				
			$ret .= '
				
				$limit = "' . $table . '.id DESC LIMIT " . (($position * 5) - 5) . ", 5";

				$daoFactory->beginTransaction();
				$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \'" . $screen . "\'", "", true);
				$response[0]["' . $table . '"] = $daoFactory->get' . ucfirst($table) . 'Dao()->read($where, $limit, true);
				$daoFactory->close();

				echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/' . $table . '/' . $table . 'SCR.htm") . 
						"<size>" . $response[0]["' . $table . '"][0]["' . $table . '.size"] . "<theme>" . 
						$_USER[0]["usuarios"][0]["temas.identificador"];
			}

			/*
			 * Screen handler
			 */
			else if ($method == "screenHandler") {	
				$where = "";

				// Get value from combo
				$cmb = explode("<gz>", $search);

				if ($cmb[1] != "")
					$where = "' . $table . '.id = " . $cmb[1];

				$daoFactory->beginTransaction();
				$response[0]["' . $table . '"] = $daoFactory->get' . ucfirst($table) . 'Dao()->comboScr($where);
				$daoFactory->close();

				echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/' . $table . '/' . $table . 'CMB.htm");
			}

			/*
			 * Create
			 */
			else if ($method == "create") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response[0]["message"] = "permission";
					
					echo $darth->json($response);
				} else {
					$' . $table . ' = new model\\' . ucfirst($table) . '();
					' . $object . '
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->get' . ucfirst($table) . 'Dao()->create($' . $table . ');

					if ($resultDao) {';
					
			if ($table == "temas")
				$ret .= '
						$id = $daoFactory->getConnection()->insertId();
						$temasDao = $daoFactory->getTemasDao()->read("temas.id = " . $id, "", false);
						';
					
			$ret .= '
						$daoFactory->commit();
						$response[0]["message"] = "success";';
				
			if ($table == "temas") {
				$ret .= '
				
						/*
						 * Write
						 */
						$buffer = file_get_contents("../../mod/cms/css/style.css");
						$find = "." . logicNull($form[1]) . "";
						$pos = strpos($buffer, $find);
					
						if ($pos === false) {
							$fo = fopen("../../mod/cms/css/style.css", "a");
							$fw = fwrite($fo, "

/*
 * " . logicNull($form[0]) . "
 *
 * @see http://mariosakamoto.com/getz/themes
 */ 						
." . logicNull($form[1]) . " { 
	background: url(\\"../../../res/img/hdpi/" . $temasDao[0]["temas.foto"] . "\\") no-repeat top center, linear-gradient(#" . 
			logicNull($form[3]) . ", #" . logicNull($form[2]) . "); 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	border: solid 1px #" . logicNull($form[2]) . ";
	color: #" . logicNull($form[4]) . " !important;
}

." . logicNull($form[1]) . ":hover { 
	background: url(\\"../../../res/img/hdpi/" . $temasDao[0]["temas.foto"] . "\\") no-repeat top center, linear-gradient(#" . 
			logicNull($form[3]) . ", #" . logicNull($form[2]) . "); 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	border: solid 1px #" . logicNull($form[2]) . ";
	color: #" . logicNull($form[4]) . " !important;
}");

							fclose($fo);
						}';
			}	
						
			$ret .= '				
					} else {							
						$daoFactory->rollback();
						$response[0]["message"] = "error";
					}

					$daoFactory->close();

					echo $darth->json($response);
				}
			}

			/*
			 * Action update
			 */
			else if ($method == "update") {	
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response[0]["message"] = "permission";
					
					echo $darth->json($response);
				} else {
					$' . $table . ' = new model\\' . ucfirst($table) . '();
					$' . $table . '->setId($code);
					' . $update . '
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->get' . ucfirst($table) . 'Dao()->update($' . $table . ');

					if ($resultDao) {
						$daoFactory->commit();
						$response[0]["message"] = "success";
					} else {							
						$daoFactory->rollback();
						$response[0]["message"] = "error";
					}

					$daoFactory->close();

					echo $darth->json($response);
				}
			}
			
			/* 
			 * Action delete
			 */
			else if ($method == "delete") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response[0]["message"] = "permission";
					
					echo $darth->json($response);
				} else {
					$result = true;
					$lines = explode("<gz>", $code);

					$daoFactory->beginTransaction();

					for ($i = 1; $i < sizeof($lines); $i++) {
						$where = "' . $table . '.id = " . $lines[$i];
						' . $delete . '
						$resultDao = $daoFactory->get' . ucfirst($table) . 'Dao()->delete($where);
						$result = !$result ? false : (!$resultDao ? false : true);
					}

					if ($result) {
						$daoFactory->commit();
						$response[0]["message"] = "success";
					} else {							
						$daoFactory->rollback();
						$response[0]["message"] = "error";
					}

					$daoFactory->close();

					echo $darth->json($response);	
				}
			}';
			
			$ret .= '
		}
	}

?>';
			
			if (!file_exists("../src/controller/" . ucfirst($table) . ".php")) {
				$fo = fopen("../src/controller/" . ucfirst($table) . ".php", "w");
				$fw = fwrite($fo, $ret);

				fclose($fo);
			}
		}

		/**
		 * @param {String} table
		 * @param {Array} fields
		 * @param {Array} fk
		 */
		public function handler($table, $fields, $fk) {
			$buffer = file_get_contents("../mod/cms/js/handler.js");
			$find = " " . $table . "HDL";
			$pos = strpos($buffer, $find);
			
			if ($pos === false) {
				$fo = fopen("../mod/cms/js/handler.js", "a");
				$fw = fwrite($fo, "
			
function " . $table . "HDL() { /* Insert your code here... */ }");

				fclose($fo);
			}
		}
		
		/**
		 * @param {String} table
		 * @param {Array} fields
		 * @param {Array} fk
		 */		
		public function response($table, $fields, $fk) {
			$buffer = file_get_contents("../mod/cms/js/handler.js");
			$find = " " . $table . "RES";
			$pos = strpos($buffer, $find);
			
			if ($pos === false) {
				$fo = fopen("../mod/cms/js/handler.js", "a");
				$fw = fwrite($fo, "
				
function " . $table . "RES(response, method) {
	var res = JSON.parse(response);

	if (res[0][\"message\"] == \"success\")
		requestHandler(method);
	else
		showMessage(gz_titleAttetion, gz_msgErrorServer, \"cancel();\");
}");

				fclose($fo);
			}
		}
		
		/**
		 * @param {String} table
		 * @param {Array} fields
		 * @param {Array} fk
		 */
		public function daoFactory($table, $fields, $fk) {
			$buffer = file_get_contents("../src/logic/DaoFactory.php");
			$find = "get" . ucfirst($table) . "Dao";
			$pos = strpos($buffer, $find);
			
			if ($pos === false) {
				$arr = file("../src/logic/DaoFactory.php");
			
				array_pop($arr);
				array_pop($arr);
				array_pop($arr);
				array_pop($arr);

				file_put_contents('../src/logic/DaoFactory.php', $arr);
	
				$fo = fopen("../src/logic/DaoFactory.php", "a");
				$fw = fwrite($fo, "		
		public function get" . ucfirst($table) . "Dao() {
			return new model\\" . ucfirst($table) . "Dao(\$this->getConnection());
		}
		
	}
	
?>");

				fclose($fo);
			}
		}

	}

?>
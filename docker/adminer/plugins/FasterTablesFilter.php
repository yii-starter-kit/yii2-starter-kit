<?php
/**
 * Faster tables filter plugin
 * ===========================
 * Useful when there's way too many tables than it shoud be and Adminer Tables Filter is slow
 *
 * @author Martin Macko, https://github.com/linkedlist
 * @license http://http://opensource.org/licenses/MIT, The MIT License (MIT)
 *
 * Modified 201802 - updated for Adminer 4.6.0 compatibility
 */
class FasterTablesFilter {
	function tablesPrint($tables) { ?>

  <p class="jsonly"><input id="filter-field">
  <style>
    .select-text {
      margin-right: 5px;
    }
  </style>
  <p id='tables'></p>
  <script<?php echo Adminer\nonce(); ?>>
	function readCookie(name) {
		name = name.replace(/([.*+?^=!:${}()|[\]\/\\])/g, '\\$1');
		var regex = new RegExp('(?:^|;)\\s?' + name + '=(.*?)(?:;|$)','i'),
			match = document.cookie.match(regex);
		return match && unescape(match[1]);
	}
	var filterf = function () {
		var liProto = document.createElement('li');
		var space = document.createTextNode('\u00A0')
		var aProto = document.createElement('a');
		var tableList = document.getElementById("tables");
		function appendTables() {
			var fragment = document.createDocumentFragment();
			var item;
			for (var i = 0, len = tempTables.length; i < len; i++) {
				item = tempTables[i];
				var li = liProto.cloneNode();
				var aSelect = aProto.cloneNode();
				aSelect.href = hMe+"select="+item;
				aSelect.text = langSelect;
				aSelect.className = "select";
				var aName = aProto.cloneNode();
				aName.href = hMe+"table="+item;
				aName.text = item;
				li.appendChild(aSelect);
				li.appendChild(space.cloneNode());
				li.appendChild(aName);
				fragment.appendChild(li);
			}
			tableList.appendChild(fragment);
		}
		var tables = [<?php foreach($tables as $table => $type) { echo "'".urlencode($table) ."'". ",";}?>];
		var tempTables = tables;
		var hMe = "<?php echo Adminer\h(Adminer\ME) ?>";
		hMe = hMe.replace(/&amp;/g, '&');
		var langSelect = "<?php echo Adminer\lang('select');?>";
		var filterCookie = readCookie('tableFilter');
		var filter = document.getElementById("filter-field");
		if(filterCookie!='') {
			filter.value=filterCookie;
		}
		function filterTableList() {
			document.cookie = "tableFilter="+filter.value
			while(tableList.firstChild) {
				tableList.removeChild(tableList.firstChild);
			}
			tempTables = [];
			var value = filter.value.toLowerCase();
			var item;
			for (var i = 0, len = tables.length; i < len; i++) {
				item = tables[i];
				if(item.toLowerCase().indexOf(value) > -1) {
					tempTables.push(item);
				}
			}
			appendTables();
		};
		filter.oninput = function(event) {
			filterTableList();
		}
		filterTableList();
	}
	window.onload=filterf;
</script>
<?php return true;}} ?>

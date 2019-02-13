		<link rel="stylesheet" href="css/stats.css">
		<link rel="stylesheet" href="css/jquery-ui.min.css">
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/stats.js"></script>
		<div id="lable">Статистика</div>
		<div id="content_tabs">
			<div id="tabs">
			  <ul>
			    <li><a href="#tabs-1">Модули</a></li>
			    <li><a href="#tabs-2">ИП адреса</a></li>
			    <li><a href="#tabs-3">Количество кликов в модуле по ИП за минуту</a></li>
			    <li><a href="#tabs-4">Количество кликов по ИП по модулям за минуту</a></li>
			  </ul>
			  <div id="tabs-1">
			  	<table>
			  		<thead>
			  			<tr>
			  				<td>ИД Модуль</td>
			  				<td>Наименование модуля</td>
			  			</tr>
			  		</thead>
			  		<tbody id="data_moduls"></tbody>
			  	</table>
			  </div>
			  <div id="tabs-2">
				<table>
			  		<thead>
			  			<tr>
			  				<td>ИД ИП</td>
			  				<td>ИП</td>
			  			</tr>
			  		</thead>
			  		<tbody id="data_ip"></tbody>
			  	</table>
			  </div>
			  <div id="tabs-3">
			  	<select name="select_page" id="select_page"></select>
			  	<table>
			  		<thead>
			  			<tr>
			  				<td>ИП</td>
			  				<td>Количество кликов в минуту</td>
			  			</tr>
			  		</thead>
			  		<tbody id="data_page_ip"></tbody>
			  	</table>
			  </div>
			  <div id="tabs-4">
			  	<select name="select_ip" id="select_ip"></select>
			  	<table>
			  		<thead>
			  			<tr>
			  				<td>Модуль</td>
			  				<td>Количество кликов в минуту</td>
			  			</tr>
			  		</thead>
			  		<tbody id="data_ip_page"></tbody>
			  	</table>
			  </div>
			</div>
		</div>
		
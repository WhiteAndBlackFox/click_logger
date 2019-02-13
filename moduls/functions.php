<?php
session_start();

switch ($_GET['type']) {
	case 'set_page':
		set_page();
		break;
	case 'add_click':
		add_click();
		break;
	case 'set_click':
		set_click();
		break;
	case 'auth':
		auth();
		break;
	case 'load_data_moduls':
		load_data_moduls();
		break;
	case 'load_data_ip':
		load_data_ip();
		break;
	case 'data_page_ip':
		data_page_ip();
		break;
	case 'data_ip_page':
		data_ip_page();
		break;
	default:
		null();
		break;
}

function data_ip_page(){
	$table_page_ip = "";
	
	$db = new SQLite3('../click_logger.db', SQLITE3_OPEN_READONLY);
	$sql_s_ip_page = $db->prepare("SELECT p.name_page , ip.count_click FROM ips_pages ip LEFT JOIN pages p ON p.idpages = ip. idips_pages WHERE ip.idip = :selectedip");
	$sql_s_ip_page->bindValue(':selectedip', $_GET['selectedip']);
	$res_s_ip_page = $sql_s_ip_page->execute();

	while($s_page_ip = $res_s_ip_page->fetchArray()){
		$click_minute = number_format(floatval($s_page_ip['count_click']) / floatval(60), 2, ',', ' ');
		$table_page_ip .= "<tr><td>{$s_page_ip['name_page']}</td><td>$click_minute</td></tr>";
	}
	$db->close();

	$json = array('table_page_ip' => $table_page_ip);
	echo json_encode($json);
}

function data_page_ip(){
	$table_page_ip = "";
	
	$db = new SQLite3('../click_logger.db', SQLITE3_OPEN_READONLY);
	$sql_s_page_ip = $db->prepare("SELECT i.ip, ip.count_click FROM ips_pages ip LEFT JOIN ips i ON i.idip = ip.idip WHERE ip.idips_pages = :selectedpage");
	$sql_s_page_ip->bindValue(':selectedpage', $_GET['selectedpage']);
	$res_s_page_ip = $sql_s_page_ip->execute();

	while($s_page_ip = $res_s_page_ip->fetchArray()){
		$click_minute = number_format(floatval($s_page_ip['count_click']) / floatval(60), 2, ',', ' ');
		$table_page_ip .= "<tr><td>{$s_page_ip['ip']}</td><td>$click_minute</td></tr>";
	}
	$db->close();

	$json = array('table_page_ip' => $table_page_ip);
	echo json_encode($json);
}

function load_data_ip(){
	$table_ip = "";
	$ip_options= "";

	$db = new SQLite3('../click_logger.db', SQLITE3_OPEN_READONLY);
	$sql_s_ip = $db->prepare("SELECT * FROM ips");
	$res_s_ip = $sql_s_ip->execute();

	while($s_ip = $res_s_ip->fetchArray()){
		$table_ip .= "<tr><td>{$s_ip['idip']}</td><td>{$s_ip['ip']}</td></tr>";
		$ip_options .= "<option value='{$s_ip['idip']}'>{$s_ip['ip']}</option>";
	}
	$db->close();

	$json = array('table_ip' => $table_ip, 'ip_options'=> $ip_options);
	echo json_encode($json);
}

function load_data_moduls(){
	$table_pages = "";
	$page_options = "";
	
	$db = new SQLite3('../click_logger.db', SQLITE3_OPEN_READONLY);
	$sql_s_page = $db->prepare("SELECT * FROM pages WHERE name_page <> 'stats'");
	$res_s_page = $sql_s_page->execute();

	while($s_page = $res_s_page->fetchArray()){
		$table_pages .= "<tr><td>{$s_page['idpages']}</td><td>{$s_page['name_page']}</td></tr>";
		$page_options .= "<option value='{$s_page['idpages']}'>{$s_page['name_page']}</option>";
	}
	$db->close();

	$json = array('table_pages' => $table_pages, 'page_options'=> $page_options);
	echo json_encode($json);
}

function set_click(){
	if (is_array($_SESSION['click']) && count($_SESSION['click']) > 0){
		$db = new SQLite3('../click_logger.db', SQLITE3_OPEN_READWRITE);
		foreach($_SESSION['click'] as $page => $count){
			/*--------------------------------------------------------------------------*/
			/*                             pages                                        */
			/*--------------------------------------------------------------------------*/
			$sql_s_page = $db->prepare('select * FROM pages p WHERE p.name_page = :page');
			$sql_s_page->bindValue(':page', $page, SQLITE3_TEXT);
			$res_s_page = $sql_s_page->execute();

			$s_page = $res_s_page->fetchArray();
			$id_page = $s_page['idpages'];
			if(is_null($id_page)){
				$sql_i_page = $db->prepare("INSERT INTO pages(name_page) VALUES (:page);");
				$sql_i_page->bindValue(':page', $page, SQLITE3_TEXT);
				if ($sql_i_page->execute()) {
					$id_page = $db->lastInsertRowID();
				} else {
					return false;
				}
			}

			/*--------------------------------------------------------------------------*/
			/*                             ip                                           */
			/*--------------------------------------------------------------------------*/

			$sql_s_ips = $db->prepare('select * FROM ips WHERE ip = :ip');
			$sql_s_ips->bindValue(':ip', $_SERVER['REMOTE_ADDR'], SQLITE3_TEXT);
			$res_s_ips = $sql_s_ips->execute();

			$s_ips = $res_s_ips->fetchArray();
			$id_ip = $s_ips['idip'];

			if(is_null($id_ip)){
				$sql_i_ip = $db->prepare("INSERT INTO ips(ip) VALUES (:ip);");
				$sql_i_ip->bindValue(':ip', $_SERVER['REMOTE_ADDR'], SQLITE3_TEXT);
				if ($sql_i_ip->execute()) {
					$id_ip = $db->lastInsertRowID();
				} else {
					return false;
				}
			}

			/*--------------------------------------------------------------------------*/
			/*                             ips_pages                                    */
			/*--------------------------------------------------------------------------*/

			$sql_s_ips_pages = $db->prepare('select * FROM ips_pages WHERE idip = :idip and idpage = :idpage');
			$sql_s_ips_pages->bindValue(':idip', $id_ip, SQLITE3_INTEGER);
			$sql_s_ips_pages->bindValue(':idpage', $id_page, SQLITE3_INTEGER);
			$res_s_ips_pages = $sql_s_ips_pages->execute();
			$s_ips_pages = $res_s_ips_pages->fetchArray();
			$id_ips_pages = $s_ips_pages['idips_pages'];		

			if(is_null($id_ips_pages)){
				$sql_i_ips_pages = $db->prepare("INSERT INTO ips_pages(idip, idpage, count_click) VALUES (:idip, :idpage, :count_click)");
				$sql_i_ips_pages->bindValue(':idip', $id_ip, SQLITE3_INTEGER);
				$sql_i_ips_pages->bindValue(':idpage', $id_page, SQLITE3_INTEGER);
				$sql_i_ips_pages->bindValue(':count_click', $count, SQLITE3_INTEGER);
				$sql_i_ips_pages->execute();
			} else {
				$sql_i_ips_pages = $db->prepare("UPDATE ips_pages SET count_click=count_click+:count_click WHERE idip=:idip AND idpage=:idpage");
				$sql_i_ips_pages->bindValue(':idip', $id_ip, SQLITE3_INTEGER);
				$sql_i_ips_pages->bindValue(':idpage', $id_page, SQLITE3_INTEGER);
				$sql_i_ips_pages->bindValue(':count_click', $count, SQLITE3_INTEGER);
				$sql_i_ips_pages->execute();
			}
		}
		unset($_SESSION['click']);
		$db->close();
	}
}

function add_click(){
	if ($_SESSION['page'] != 'stats'){
		if (is_null($_SESSION['click'][$_SESSION['page']])){
			$_SESSION['click'][$_SESSION['page']] = 0;
		}
		$_SESSION['click'][$_SESSION['page']] += 1;
	}
}

function set_page(){
	$_SESSION['page'] = $_GET['to_page'];

}

function null(){
	$_SESSION['page'] = "null";
}

?>
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
	default:
		null();
		break;
}

function set_click(){
	
}

function add_click(){
	if (is_null($_SESSION['click'][$_SESSION['page']])){
		$_SESSION['click'][$_SESSION['page']] = 0;
	}
	$_SESSION['click'][$_SESSION['page']] += 1;
}

function set_page(){
	$_SESSION['page'] = $_GET['to_page'];

}

function null(){
	$_SESSION['page'] = "null";
}

?>
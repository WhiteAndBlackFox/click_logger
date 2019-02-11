<?php
session_start();

switch ($_GET['type']) {
	case 'set_page':
		set_page();
		break;
	default:
		null();
		break;
}

function set_page(){
	$_SESSION['page'] = $_GET['to_page'];

}

function null(){
	$_SESSION['page'] = "null";
}

?>
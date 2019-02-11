<?php
session_start();

include "moduls/simple_html_dom.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>CLICKER</title>
		<link rel="stylesheet" href="css/index.css">
	    <script type="text/javascript" src="js/jquery.js"></script>
	    <script type="text/javascript" src="js/main.js"></script>
	</head>
	<body id="body">
		<div id="head">
			<div id="text_head">Clicker</div>
			<div id="navs">
				<div class="button" id="auth" name="auth">Sign up</div>
			</div>
		</div>
		<div id="box">
		    <div id="list" class="list">
		    	<ol class="rounded" id="menu">
		    		<?php
		    			$dir = opendir('contents');
		    			$dirFiles = array();
		    			while($file = readdir($dir)) {
		    				if ($file != '.' && $file != '..' && $file != 'null.php') {
		    					$html = file_get_html("contents/$file");
		    					$ret = $html->find('div[id=lable]');
		    					$label = $ret[0]->plaintext;
		    					$file = str_replace('.php', '',$file);
		    					$dirFiles[$file] = $label;
		    				}
		    			}
		    			ksort($dirFiles);
		    			foreach($dirFiles as $key=>$value){
		    				echo "<li><a id='$key'>$value</a></li>";
		    			}

		    		?>
				</ol>
		    </div>
		    <div id="contents">
		    	<?php
		    	$page = 'contents/'.(is_null($_SESSION['page'])?"main":$_SESSION['page']).'.php';
		    	if(file_exists($page)){
		    		include $page;
		    	} else {
		    		$_SESSION['page'] = 'null';
		    		include "contents/null.php";
		    	}
		    	?>
		    </div>
		</div>
	</body>
</html>
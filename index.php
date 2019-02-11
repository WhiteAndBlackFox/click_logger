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
		    	switch ((is_null($_SESSION['page'])?"main":$_SESSION['page'])) {
		    		case 'main':
						include "contents/main.php";
						break;
					case 'test0':
						include "contents/test0.php";
						break;
					case 'test10':
						include "contents/test10.php";
						break;
					case 'test11':
						include "contents/test11.php";
						break;
					case 'test12':
						include "contents/test12.php";
						break;
					case 'test13':
						include "contents/test13.php";
						break;
					case 'test14':
						include "contents/test14.php";
						break;
					case 'test15':
						include "contents/test15.php";
						break;
					case 'test16':
						include "contents/test16.php";
						break;
					case 'test17':
						include "contents/test17.php";
						break;
					case 'test18':
						include "contents/test18.php";
						break;
					case 'test19':
						include "contents/test19.php";
						break;
					case 'test1':
						include "contents/test1.php";
						break;
					case 'test20':
						include "contents/test20.php";
						break;
					case 'test21':
						include "contents/test21.php";
						break;
					case 'test22':
						include "contents/test22.php";
						break;
					case 'test23':
						include "contents/test23.php";
						break;
					case 'test24':
						include "contents/test24.php";
						break;
					case 'test25':
						include "contents/test25.php";
						break;
					case 'test26':
						include "contents/test26.php";
						break;
					case 'test27':
						include "contents/test27.php";
						break;
					case 'test28':
						include "contents/test28.php";
						break;
					case 'test29':
						include "contents/test29.php";
						break;
					case 'test2':
						include "contents/test2.php";
						break;
					case 'test3':
						include "contents/test3.php";
						break;
					case 'test4':
						include "contents/test4.php";
						break;
					case 'test5':
						include "contents/test5.php";
						break;
					case 'test6':
						include "contents/test6.php";
						break;
					case 'test7':
						include "contents/test7.php";
						break;
					case 'test8':
						include "contents/test8.php";
						break;
					case 'test9':
						include "contents/test9.php";
						break;
		    		default:
		    			include "contents/null.php";
		    			break;
		    	}
		    	?>
		    </div>
		</div>
	</body>
</html>
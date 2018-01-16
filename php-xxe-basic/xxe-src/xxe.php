<?php
header("Content-type: text/html; charset=utf-8");
if(isset($_GET['src'])){
	show_source(__FILE__);
}else{
	$input = file_get_contents('php://input');
	$xml = simplexml_load_string($input);
	var_dump($xml);
}
?>

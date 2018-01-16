<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Ambulong">
<meta name="description" content="VSPlate，PHP XXE Online">
<meta name="keywords" content="vsplate,PHP,XXE,vulspy,online,在线">
<title>PHP XXE Online</title>
<script src="./js/jquery-1.11.3.min.js"></script>
<script src="./js/jquery-migrate-1.2.1.min.js"></script>
<style>
body {
	max-width: 66em;
	margin: 0 auto;
}

h1 {
	padding: 15px;
}

.b1, .b2 {
	padding: 15px;
	float: left;
	width: 100%;
}

#xxe-input textarea {
	width: 100%;
	height: 15em;
}

.b1 button {
	font-size: 1.1em;
}

#xxe-resp textarea {
	width: 100%;
	height: 23em;
	background: #FFF;
	border: none;
}
</style>
<script>
$(function () {
	$("button#xxe-submit").live("click", function () {
	var input = $("#xxe-input textarea").val();
	$.ajax({
	    type: 'POST',
	    url: './xxe.php?' + Math.random(),
	    dataType: 'text',
	    data: input,
	    success: function (data) {
		$('#xxe-resp textarea').text(data);
	    },
	    error: function () {
		console.log("错误：网络错误.");
	    }
	});
});
});
</script>
</head>
<body>
	<h1>PHP XXE</h1>
	<div class="b1">
		<a href="./xxe.php?src" target="_blank">view source</a>
		<div style="margin-top: 1em;" class="xxe" id="xxe-input">
			<textarea placeholder="Input Your Payload"><?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE test [ 
    <!ENTITY xxeattack SYSTEM "file:///etc/passwd"> 
]>
<xxx>&xxeattack;</xxx></textarea>
		</div>
		<button id="xxe-submit">Submit</button>
	</div>
	<div class="b2">
		<div class="xxe" id="xxe-resp">
			<textarea readonly="readonly"></textarea>
		</div>
	</div>
</bdoy>
</html>

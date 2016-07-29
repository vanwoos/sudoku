<?php header("content-type:text/html;charset=UTF-8"); ?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<style type="text/css">
.c1{
background-color : #d2ff8d;
padding:5px;
}
.login{
float:right;
}
.hlogin{
text-align:right;
}
.cpy{
background-color:#fcffb3;
color:#aaa;
border:1px solid #ddd;
text-align:center;
}
a:link{
color:#0000ff;
text-decoration:none;
}
a:visited{
color:#e900d4;
text-decoration:none;
}
a:hover{
color:#ff0000;
text-decoration:underline;
}
hr{
height:1px;
border:1px solid #ececec;
}
.list{
text-align:left;
/*background-color:#eee;*/
border:1px solid #ececec;
border-radius:6px;
padding:7px;
margin:1px;
}
body{
max-width:95%;
font-size:15px;
text-align:left;
background-color:#fcfcfc;
color:#000000;
border:2px solid #ececec;
margin:auto;
padding:3px;
}
.c3{
font-size:12px;
color:#bcbcbc;
}
table{
	
}
.nine_box{
	border:1px solid green;
	padding:1em;
}
.nine_box tr td{
	padding:0px;
}
.nine_box td input{
	width:2em;
	height:2em;
	text-align:center;
	border:1px solid gray;
}
.nine_box .rowseparate td{
	padding-bottom:1em;
}
.nine_box tr .colseparate{
	padding-right:1em;
}
.submit_button{
	border:0px solid green;
	background:green;
	color:white;
	padding:0em 1em 0em 1em;
	margin:2px;
}
</style>
<script>
function clearInput()
{
	if(window.confirm('你确定要清空？'))
	{
		var vals=document.getElementsByName("val[]");
		for(var i=0;i<81;++i)
			vals[i].value="";
	}
}

function hideOrShowCV()
{
	var  buttonval=document.getElementById("hideOrShowCV");
	var vals=document.getElementsByName("val[]");
	for(var i=0;i<81;++i)
	{
		if(vals[i].value.length<=1)
			continue;
		if(buttonval.value=="HideCV")
		{
			vals[i].style="color:white;";
		}
		else{
			vals[i].style="color:red;";
		}
	}
	if(buttonval.value=="HideCV")
	{
		buttonval.value="ShowCV"
	}
	else{
		buttonval.value="HideCV"
	}
}

</script>

</head>
<body>

<?php header("content-type:text/html;charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

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
max-width:476px;
width:100%;
font-size:15px;
text-align:left;
background-color:#fcfcfc;
color:#000000;
border:0px solid #ececec;
margin-right:auto;
padding:2px;
}
.c3{
font-size:12px;
color:#bcbcbc;
}
table{
	border-spacing:1px;
}
div{
	
}
.valtable{
	border:0px solid gray;
	margin:1px;
}
.valtable tr td{
	padding:0px;
}
.valtable textarea{
	border:1px solid gray;
	width:358px;
	height:50px;
}
.consume_time{
	font-size:12px;
	color:#555;
}
.nine_box{
	border:1px solid gray;
	padding:15px;
}
.nine_box tr td{
	padding:0px;
	margin:0px;
}
.nine_box tr td input{
	width:44px;
	height:44px;
	margin:0px;
	padding:0px;
	text-align:center;
	border:1px solid gray;
}
.nine_box .rowseparate td{
	padding-bottom:10px;
}
.nine_box tr .colseparate{
	padding-right:10px;
}
.submit_button{
	border:0px solid green;
	background:green;
	color:white;
	padding:2px 5px 2px 5px;
	margin:2px;
}
</style>
<script>
function clearInput()
{
	if(window.confirm('Clear all boxes?'))
	{
		var vals=document.getElementsByName("val[]");
		for(var i=0;i<81;++i)
			vals[i].value="";
	}
}
</script>

<script>
function ValToBox()
{
	var textval=document.getElementsByName("textval");
	var vals=document.getElementsByName("val[]");
	//alert(textval[0].value);
	for(var i=0;i<textval[0].value.length;++i)
	{
		if(i>=81)
		{
			alert("vals[] is out of range");
			break;
		}
		var val=textval[0].value[i];
		if(val!=" " && val!="0")
			vals[i].value=val;
	}
}
function BoxToVal()
{
	var textval=document.getElementsByName("textval");
	var vals=document.getElementsByName("val[]");
	if(!window.confirm('Put the value of boxes to val?'))
		return;
	textval[0].value='';
	
	for(var i=0;i<81;++i)
	{
		var val=vals[i].value;
		if(val.length==1)
		{
			textval[0].value=textval[0].value+val;
		}
		else{
			textval[0].value=textval[0].value+'0';
		}
	}
}

function getCookie(c_name)
{
	if (document.cookie.length>0)
	{
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1)
		{
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
		if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return "";
}

function setCookie(c_name,value,expiredays)
{
	var exdate=new Date()
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+"="+escape(value)+((expiredays==null)?"":";expires="+exdate.toGMTString());
}
</script>

</head>
<body>

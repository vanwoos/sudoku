<?php require './header.php'; ?>
<script>
function checkInput()
{
	var flag=true;
	var vals=document.getElementsByName("val[]");
	for(var i=0;i<81;++i)
	{
		if(vals[i].value.length>1)
		{
			vals[i].style="color:red;";
			flag=false;
		}
	}
	return flag;
}

function ValToBoxs()
{
	var textval=document.getElementsByName("textval");
	var vals=document.getElementsByName("val[]");
	//alert(textval[0].value);
	for(var i=0;i<textval[0].value.length;++i)
	{
		var val=textval[0].value[i];
		if(val!=" " && val!="0")
			vals[i].value=val;
	}
}
</script>
<div style="border:1px solid green;width:33em;margin-bottom:1em;padding:1px;">
<textarea name="textval" style="width:30em;height:5em;"></textarea>
<input class="submit_button" type="button" value="ValToBoxs" onclick="ValToBoxs()" />
</div>
<form action="./result.php" method="post" onsubmit="return checkInput()">
	<table class="nine_box">
	<?php
		$html_con='';
		for($i=0;$i<9;++$i)//九行
		{
			$rowseparate=($i==2 || $i==5)?' class="rowseparate"':'';
			$html_con.='<tr'.$rowseparate.'>';
			for($j=0;$j<9;++$j)//九列
			{
				$colseparate=($j==2 || $j==5)?' class="colseparate"':'';
				$html_con.='<td'.$colseparate.'><input name="val[]" value="" /></td>';
			}
			$html_con.='</tr>';
		}
		echo $html_con;
	?>
	</table>
	<input class="submit_button" type="submit" value="Calculate" />&nbsp;&nbsp;&nbsp;&nbsp;
	<input class="submit_button" type="button" onclick="clearInput()" value="ClearInput" />
</form>


<?php require './footer.php'; ?>

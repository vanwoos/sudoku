<?php require './header.php'; ?>

<?php require './sudoku.php'?>
<script>
function BoxsToVal()
{
	var textval=document.getElementsByName("textval");
	var vals=document.getElementsByName("val[]");
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
</script>
<div style="border:1px solid green;width:33em;margin-bottom:1em;padding:1px;">
<textarea name="textval" style="width:30em;height:5em;"></textarea>
<input class="submit_button" type="button" value="BoxsToVal" onclick="BoxsToVal()" />
</div>
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
			$html_con.='<td'.$colseparate.'><input name="val[]" value="'.$arr[$i*9+$j].'" /></td>';
		}
		$html_con.='</tr>';
	}
	echo $html_con;
?>
</table>
<input class="submit_button" id="hideOrShowCV" type="button" value="HideCV" onclick="hideOrShowCV()" />
<script>
	var vals=document.getElementsByName("val[]");
	for(var i=0;i<81;++i)
	{
		if(vals[i].value.length>1)
		{
			vals[i].style="color:red;";
		}
		vals[i].setAttribute("readonly","readonly");
	}
</script>
<script>
function hideOrShowCV()
{
	var buttonval=document.getElementById("hideOrShowCV");
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
	buttonval.value=(buttonval.value=="HideCV")?"ShowCV":"HideCV";
}
</script>
<?php require './footer.php'; ?>

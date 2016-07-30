<?php require './header.php'; ?>

<?php require './sudoku.php'?>
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
<div>
<table>
	<tr>
		<td rowspan="2">
			<textarea name="textval" style="width:30em;height:5em;"></textarea>
		</td>
		<td>
			&nbsp;
			<!--<input class="submit_button" type="button" value="ValToBoxs" onclick="ValToBoxs()" />-->
		</td>
	</tr>
	<tr>
		<td>
			<input class="submit_button" type="button" value="BoxsToVal" onclick="BoxsToVal()" />
		</td>
	</tr>
</table>
</div>
<div>
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
</div>

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

<?php require './footer.php'; ?>

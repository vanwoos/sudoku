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
</script>
<div>
<table>
	<tr>
		<td rowspan="2">
			<textarea name="textval" style="width:30em;height:5em;"></textarea>
		</td>
		<td>
			<input class="submit_button" type="button" value="ValToBox" onclick="ValToBox()" />
		</td>
	</tr>
	<tr>
		<td>
			<input class="submit_button" type="button" value="BoxToVal" onclick="BoxToVal()" />
		</td>
	</tr>
</table>
</div>
<div>
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
</div>


<?php require './footer.php'; ?>

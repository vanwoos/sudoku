<?php require './header.php'; ?>

<?php require './sudoku.php'?>

<?php
echo <<<HTML
	<table class="nine_box">
		<tr>
			<td><input name="val[]" value="$arr[0]" /></td>
			<td><input name="val[]" value="$arr[1]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[2]" /></td>
			<td><input name="val[]" value="$arr[3]" /></td>
			<td><input name="val[]" value="$arr[4]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[5]" /></td>
			<td><input name="val[]" value="$arr[6]" /></td>
			<td><input name="val[]" value="$arr[7]" /></td>
			<td><input name="val[]" value="$arr[8]" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="$arr[9]" /></td>
			<td><input name="val[]" value="$arr[10]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[11]" /></td>
			<td><input name="val[]" value="$arr[12]" /></td>
			<td><input name="val[]" value="$arr[13]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[14]" /></td>
			<td><input name="val[]" value="$arr[15]" /></td>
			<td><input name="val[]" value="$arr[16]" /></td>
			<td><input name="val[]" value="$arr[17]" /></td>
		</tr>
		<tr class="rowseparate">
			<td><input name="val[]" value="$arr[18]" /></td>
			<td><input name="val[]" value="$arr[19]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[20]" /></td>
			<td><input name="val[]" value="$arr[21]" /></td>
			<td><input name="val[]" value="$arr[22]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[23]" /></td>
			<td><input name="val[]" value="$arr[24]" /></td>
			<td><input name="val[]" value="$arr[25]" /></td>
			<td><input name="val[]" value="$arr[26]" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="$arr[27]" /></td>
			<td><input name="val[]" value="$arr[28]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[29]" /></td>
			<td><input name="val[]" value="$arr[30]" /></td>
			<td><input name="val[]" value="$arr[31]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[32]" /></td>
			<td><input name="val[]" value="$arr[33]" /></td>
			<td><input name="val[]" value="$arr[34]" /></td>
			<td><input name="val[]" value="$arr[35]" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="$arr[36]" /></td>
			<td><input name="val[]" value="$arr[37]" /></td>
			<td style="padding-right:1em;"><input name="val[]" value="$arr[38]" /></td>
			<td><input name="val[]" value="$arr[39]" /></td>
			<td><input name="val[]" value="$arr[40]" /></td>
			<td style="padding-right:1em;"><input name="val[]" value="$arr[41]" /></td>
			<td><input name="val[]" value="$arr[42]" /></td>
			<td><input name="val[]" value="$arr[43]" /></td>
			<td><input name="val[]" value="$arr[44]" /></td>
		</tr>
		<tr class="rowseparate">
			<td><input name="val[]" value="$arr[45]" /></td>
			<td><input name="val[]" value="$arr[46]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[47]" /></td>
			<td><input name="val[]" value="$arr[48]" /></td>
			<td><input name="val[]" value="$arr[49]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[50]" /></td>
			<td><input name="val[]" value="$arr[51]" /></td>
			<td><input name="val[]" value="$arr[52]" /></td>
			<td><input name="val[]" value="$arr[53]" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="$arr[54]" /></td>
			<td><input name="val[]" value="$arr[55]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[56]" /></td>
			<td><input name="val[]" value="$arr[57]" /></td>
			<td><input name="val[]" value="$arr[58]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[59]" /></td>
			<td><input name="val[]" value="$arr[60]" /></td>
			<td><input name="val[]" value="$arr[61]" /></td>
			<td><input name="val[]" value="$arr[62]" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="$arr[63]" /></td>
			<td><input name="val[]" value="$arr[64]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[65]" /></td>
			<td><input name="val[]" value="$arr[66]" /></td>
			<td><input name="val[]" value="$arr[67]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[68]" /></td>
			<td><input name="val[]" value="$arr[69]" /></td>
			<td><input name="val[]" value="$arr[70]" /></td>
			<td><input name="val[]" value="$arr[71]" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="$arr[72]" /></td>
			<td><input name="val[]" value="$arr[73]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[74]" /></td>
			<td><input name="val[]" value="$arr[75]" /></td>
			<td><input name="val[]" value="$arr[76]" /></td>
			<td class="colseparate"><input name="val[]" value="$arr[77]" /></td>
			<td><input name="val[]" value="$arr[78]" /></td>
			<td><input name="val[]" value="$arr[79]" /></td>
			<td><input name="val[]" value="$arr[80]" /></td>
		</tr>
	</table>
	<input class="submit_button" id="hideOrShowCV" type="button" value="HideCV" onclick="hideOrShowCV()" />
HTML;
?>
<script>
	var vals=document.getElementsByName("val[]");
	for(var i=0;i<81;++i)
	{
		if(vals[i].value.length>1)
		{
			vals[i].style="color:red;";
		}
	}
</script>
<?php require './footer.php'; ?>

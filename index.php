<?php require './header.php'; ?>

<form action="./result.php" method="post">
	<table class="nine_box">
		<tr>
			<td><input name="val[]" value="4" /></td>
			<td><input name="val[]" value="1" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="8" /></td>
			<td><input name="val[]" value="3" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="7" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="6" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="3" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="4" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="1" /></td>
			<td><input name="val[]" value="8" /></td>
		</tr>
		<tr class="rowseparate">
			<td><input name="val[]" value="8" /></td>
			<td><input name="val[]" value="" /></td>
			<td class="colseparate"><input name="val[]" value="9" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="5" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="4" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="4" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="6" /></td>
			<td><input name="val[]" value="4" /></td>
			<td style="padding-right:1em;"><input name="val[]" value="8" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td style="padding-right:1em;"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="2" /></td>
			<td><input name="val[]" value="9" /></td>
			<td><input name="val[]" value="7" /></td>
		</tr>
		<tr class="rowseparate">
			<td><input name="val[]" value="2" /></td>
			<td><input name="val[]" value="" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td class="colseparate"><input name="val[]" value="5" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="7" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="3" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="2" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="7" /></td>
			<td><input name="val[]" value="2" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="9" /></td>
			<td class="colseparate"><input name="val[]" value="" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="4" /></td>
			<td><input name="val[]" value="" /></td>
		</tr>
		<tr>
			<td><input name="val[]" value="3" /></td>
			<td><input name="val[]" value="" /></td>
			<td class="colseparate"><input name="val[]" value="4" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="8" /></td>
			<td class="colseparate"><input name="val[]" value="2" /></td>
			<td><input name="val[]" value="" /></td>
			<td><input name="val[]" value="7" /></td>
			<td><input name="val[]" value="9" /></td>
		</tr>
	</table>
	<input class="submit_button" type="submit" value="计算" />
</form>
<?php require './footer.php'; ?>

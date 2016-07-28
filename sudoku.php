<?php
require './sudoku.class.php';
$val=isset($_REQUEST['val'])?$_REQUEST['val']:null;
//print_r($val);
$test=new sudoku();
$test->initElementVal($val);
//$arr=$test->getElementVal();
//echo "<br /><br />";
//print_r($arr);
$test->calculate();
$arr=$test->getElementCVal();
//echo "<br /><br />";
print_r($arr);

$arr=$test->getElementVal();
//echo "<br /><br />";
//print_r($arr);
?>

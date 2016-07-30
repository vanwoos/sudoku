<?php
require './sudoku.class.php';
$val=isset($_REQUEST['val'])?$_REQUEST['val']:null;
//print_r($val);

$test=new sudoku();
$test->setElementVals($val);
$arr=$test->getElementVals();
//echo "<br /><br />";
//print_r($arr);
$test->calculate(2);
$arr=$test->getElementVals();
print_r($arr);
$arr=$test->getElementCVals();
echo "<br /><br />";
print_r($arr);

$arr=$test->getElementVals();
//echo "<br /><br />";
//print_r($arr);
?>

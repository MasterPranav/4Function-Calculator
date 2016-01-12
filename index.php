<!DOCTYPE html>

<html>
	<head>
		<title>Four Function Calculator</title>
		<link rel="stylesheet" href="main.css" />

		<script type="text/javascript" src="main.js"></script>

		<?php
		define('CONSTANT', 'error');
		function operate($num1, $num2, $operation){
				if($operation == "+")
					return add($num1, $num2);
				else if($operation == "-")
					return substract($num1, $num2);
				else if($operation == "*")
					return multiply($num1, $num2);
				else if($operation == "/")
					return divide($num1, $num2);
			}
			function add($num1, $num2){
				return ($num1 + $num2);
			}
			function substract($num1, $num2){
				return ($num1-$num2);
			}
			function divide($num1, $num2){
				if($num2 == 0){
					return "error";
				}
				return ($num1 / $num2);
			}
			function multiply($num1, $num2){
				return ($num1 * $num2);
			}

		if(isset($_POST['expression'])) {
			$expr = $_POST['expression']; //the expression being passed in
			$index = array("-1"); //the indices of the operations
			$operations = array("+", "-", "/", "*"); //to check where the operations are
			$numbers = array(); //an array of the numbers this expression consists of
			$oper = array(); //an array of the operations in order of how they show up in the expression
			for($i = 0; $i < strlen($expr); $i++) { //going through the string to find where the operations are
				if(in_array($expr[$i], $operations)){
					array_push($index, $i); //storing the index of the operation
					array_push($oper, $expr[$i]);//storing the operation at this index
				}
			}
			array_push($index, strlen($expr)); //store the index of the end of the expression
			for($i = 0; $i < count($index)-1; $i++){
				array_push($numbers, substr($expr, $index[$i]+1, $index[$i+1]-($index[$i]+1)));//push the numbers into the number array which is found by substringing between operations
			}
			for($i = 0; $i < count($numbers)-1; $i++){ //going through all the numbers
				$temp = operate($numbers[$i], $numbers[$i+1], $oper[$i]); //storing the result of evaluating the first two numbers and operation between them
				if($temp === CONSTANT){
					$numbers[count($numbers)-1] = "ERROR: DIVIDE BY 0";
					break;
				}
				$numbers[$i+1] = $temp; //store this evaluation in the next element in the array so it can be evaluated in the next call
			}
			//echo $numbers[count($numbers)-1]; //print the last number in the array because that should be the accumulation

			
		}
		?>
	</head>

	<body>
		<div class="calculator">
			<div id="append" class="append">&nbsp;<?php echo isset($numbers) ? $numbers[count($numbers)-1] : ''; ?></div>

			<form method="POST" id="calculator-form">
				<input type="hidden" id="expression" name="expression">
				<div class="table">
					<div class="table-row">
						<input type="button" id="clear" value="Clear">
						<input type="button" id="backspace" value="Backspace">
					</div>
					<div class="table-row">
						<input type="button" id="1" value="1">
						<input type="button" id="2" value="2">
						<input type="button" id="3" value="3">
						<input type="button" id="divide" value="/">
					</div>
					<div class="table-row">
						<input type="button" id="4" value="4">
						<input type="button" id="5" value="5">
						<input type="button" id="6" value="6">
						<input type="button" id="multiply" value="*">
					</div>
					<div class="table-row">
						<input type="button" id="7" value="7">
						<input type="button" id="8" value="8">
						<input type="button" id="9" value="9">
						<input type="button" id="subtract" value="-">
					</div>
					<div class="table-row">
						<input type="button" id="decimal" value=".">
						<input type="button" id="0" value="0">
						<input type="button" id="equals" value="=">
						<input type="button" id="add" value="+">
					</div>
				</div>
			</form>
		</div>
	</body>
</html>

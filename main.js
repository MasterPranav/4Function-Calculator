document.addEventListener("DOMContentLoaded", function() {

	//instead of document.getElementById which gets the ONLY element which has the specified
	//id, document.getElementsByTagName returns an array of elements which can be used in the
	//same way as the getting elements by Id (DOM object)
	var elements = document.getElementsByTagName("input");
	var append_element = document.getElementById("append");

	for(var i = 0; i < elements.length; i++) {
		var element = elements[i];
		
		//adds a "click" event to the current input element
		element.addEventListener("click", function() {
			var operations = ['+', '-', '*', '/'];
			if(append_element.innerHTML === "&nbsp;ERROR: DIVIDE BY 0"){
				append_element.innerHTML = '&nbsp;';
			}
			//checks if the element's value is_numeric
			if(/[0-9]+/g.test(this.value)) {

				append_element.innerHTML += this.value;
			} else if(this.value === ".") {
				var str = append_element.innerHTML;
				var last_operation_index = 0;
				for(var i = 0; i < operations.length; i++) {
					last_operation_index = Math.max(str.lastIndexOf(operations[i]), last_operation_index);
				}
				
				var last_decimal_index = str.lastIndexOf('.');
				if(!(last_decimal_index > last_operation_index)){
					append_element.innerHTML += '.';
				}
				
				console.log("last operation " + last_operation_index + " last decimal " + last_decimal_index);
				
			} else if(this.value === "Clear") {
				append_element.innerHTML = '&nbsp;';
			} else if(this.value === "Backspace") {
				var length = append_element.innerHTML.length;
				append_element.innerHTML = append_element.innerHTML.substring(0, length - 1);
			} else if(operations.indexOf(this.value) !== -1
					&& operations.concat('.').indexOf(append_element.innerHTML.slice(-1)) === -1) {
					append_element.innerHTML += this.value;
			} else if(this.value === "=") {
				document.getElementById("calculator-form").submit();
			}

			//set the value of the hidden element to the value of the displayed element
			document.getElementById("expression").value = append_element.innerHTML.replace('&nbsp;', '');
		});
	}
});

<html>
<head>
	<link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert.css">
<script src="sweetalert2-master/dist/sweetalert.min.js"></script> 

<script type="text/javascript">
function runfunc(){
swal({   
	title: "An input!",   
	text: "Write something interesting:",   
	type: "input",   
	showCancelButton: true,   
	closeOnConfirm: false,   
	animation: "slide-from-top",   
	inputPlaceholder: "Write something" }, 

	function(inputValue){   
		if (inputValue === false) return false;      
		if (inputValue === "") {     
			swal.showInputError("You need to write something!");     
			return false   }      
			swal("Nice!", "You wrote: " + inputValue, "success"); 
		});
}//end function

</script>

</head>

<body>
<button class="btn btn-info" onclick='runfunc();'>Export</button>
</body>
</html>
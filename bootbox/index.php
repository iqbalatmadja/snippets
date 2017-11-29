<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bootbox.min.js"></script>
<link href="../bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">


<div><a href="#" id="samplealert">ALERT</a></div>
<div><a href="#" id="sampleconfirm">CONFIRM</a></div>
<div><a href="#" id="sampleprompt">PROMPT</a></div>
<div><a href="#" id="samplepromptdate">PROMPT DATE</a></div>
<div><a href="#" id="samplepromptemail">PROMPT EMAIL</a></div>
<div><a href="#" id="samplepromptnumber">PROMPT NUMBER</a></div>
<div><a href="#" id="samplepromptpassword">PROMPT PASSWORD</a></div>
<div><a href="#" id="samplepromptselect">PROMPT SELECT</a></div>
<div><a href="#" id="sampleprompttextarea">PROMPT TEXTAREA</a></div>
<div><a href="#" id="sampleprompttime">PROMPT TIME</a></div>
<div><a href="#" id="sampledialog1">DIALOG 1</a></div>



<script type="text/javascript">
	$("#samplealert").click(function(){
		bootbox.alert({
			size: "medium", //small,medium,large
			message: "the message",
			className: "ownclassname",
			backdrop: true, // clicking on background will close modal if true
			callback: function(){
				console.log("the callback");
			}
		});

	})

	$("#sampleconfirm").click(function(){
		bootbox.confirm({
			title: "titling",
			message: "this is confirm!",
			buttons: {
				confirm: {
					label: "<i class='fa fa-check'></i>Confirm",
					className: ""
				},
				cancel: {
					label: "<i class='fa fa-times'></i>Cancel",
					className: ""

				}
			},
			callback: function(result){
				alert("the result : "+result);
			}
		});

	})

	$("#sampleprompt").click(function(){
		bootbox.prompt({
			title: "title modal",
			inputType: "checkbox",
			inputOptions:[
				{
					text: "choice One",
					value: '1'
				},
				{
					text: "choice two",
					value: '2'
				},
				{
					text: "choice three",
					value: '3'
				},
				{
					text: "choice Four",
					value: '4'
				},

			],
			callback: function(result){
				alert("result: "+result);
			}
		})
	})

	$("#samplepromptdate").click(function(){
		bootbox.prompt({
			title: "title modal",
			inputType: "date",
			callback: function(result){
				alert("result: "+result);
			}
		})
	})

	$("#samplepromptemail").click(function(){
		bootbox.prompt({
			title: "title modal",
			inputType: "email",
			callback: function(result){
				alert("result: "+result);
			}
		})
	})

	$("#samplepromptnumber").click(function(){
		bootbox.prompt({
			title: "title modal",
			inputType: "number",
			callback: function(result){
				alert("result: "+result);
			}
		})
	})

	$("#samplepromptpassword").click(function(){
		bootbox.prompt({
			title: "title modal",
			inputType: "password",
			callback: function(result){
				alert("result: "+result);
			}
		})
	})

	$("#samplepromptselect").click(function(){
		bootbox.prompt({
			title: "title modal",
			inputType: "select",
			inputOptions:[
				{
					text: "choice One",
					value: '1'
				},
				{
					text: "choice two",
					value: '2'
				},
				{
					text: "choice three",
					value: '3'
				},
				{
					text: "choice Four",
					value: '4'
				},

			],
			callback: function(result){
				alert("result: "+result);
			}
		})
	})

	$("#sampleprompttextarea").click(function(){
		bootbox.prompt({
			title: "title modal",
			inputType: "textarea",
			callback: function(result){
				alert("result: "+result);
			}
		})
	})

	$("#sampleprompttime").click(function(){
		bootbox.prompt({
			title: "title modal",
			inputType: "time",
			callback: function(result){
				alert("result: "+result);
			}
		})
	})

	$("#sampledialog1").click(function(){
		var dialog = bootbox.dialog({
			title: "TITLE",
			message: "this dialog has buttons with own callback",
			closeButton: true,
			onEscape: true,
			backdrop: true,
			className: "",
			animate: true,
			size: 'medium',
			buttons:{
				cancel: {
					label: "Cancel button",
					className: "btn-danger",
					callback: function(){
						alert("cancel clicked");
					}
				},
				noclose: {
					label: "custom buttom but not closing the dialog",
					className: "btn-danger",
					callback: function(){
						alert("noclose clicked");
						return false;
					}
				}

			}
		});

		dialog.init(function(){
			setTimeout(function(){
				dialog.find(".bootbox-body").html("I WAS LOADED ON INIT<br><br><br><br>gergr3g3r4gf34");
			},1000)

			
		})
	})	



</script>

<?php

function getPost($idx){
	return isset($_REQUEST[$idx]) ? $_REQUEST[$idx] : false;
}

$nama = getPost('nama');
$email = getPost('email');
$komentar = getPost('komentar');
$get = getPost('getComments');

if ($get == 1){
	$comments = array(
		array(
			"name" => "Inganta",
			"email" => "inganta@gmail.com",
			"comment" => "Nice"
		)
	);
	echo json_encode($comments);
	return;
} else if ($nama && $email && $komentar){
	echo "lampet";
} else {
$proto = $_SERVER['SERVER_PORT'] == 80 ? 'http' : 'https';
$server = $proto . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
?>
<!DOCTYPE>
<html lang="en">
<head>
	<title>Guess Book</title>
	<script src="jquery-1.8.3.js"></script>
	<script src="jquery-ui.custom.min.js"></script>
	<link rel="stylesheet" href="base/jquery-ui.css">
	<link rel="stylesheet" href="demos.css">
	<style>
		body { font-size: 62.5%; }
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; }
		fieldset { padding:0; border:0; margin-top:25px; }
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain { width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
	</style>
	<script>
		$(function(){
			function addComment(name, email, comment){
				$( "#comments tbody" ).append( "<tr>" +
							"<td>" + name + "</td>" + 
							"<td>" + email + "</td>" + 
							"<td>" + comment + "</td>" +
						"</tr>" );
			}
			var name = $("#name")
				, email = $("#email")
				, comment = $("#comment");
			
			$( "#dialog-form" ).dialog({
				autoOpen: false,
				height: 300,
				width: 350,
				modal: true,
				buttons: {
					"Create a comment" : function(){
						addComment(name.val(), email.val(), comment.val());
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				},
				close: function() {
					
				}
			});
			$("#create-comment")
				.button()
				.click(function() {
					$( "#dialog-form" ).dialog( "open" );
				});
			
			/*setInterval(function(){
				$.post("<?php echo $server; ?>?getComments=1", function(data){
					var comments = JSON.parse(data)
						, i = 0
						, limit = comments.length;
					$( "#tbl-body" ).empty();
					for (;i<limit; i++){
						addComment(comments[i].name, comments[i].email, comments[i].comment);
					}
				});
			}, 2000);*/
		});
	</script>
</head>
<body>
	<div id="dialog-form" title="Create new comment">
		<p class="validateTips">All form fields are required.</p>

		<form>
		<fieldset>
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
			<label for="email">Email</label>
			<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
			<label for="comment">Comment</label>
			<textarea name="comment" id="comment" size="250" class="text ui-widget-content ui-corner-all"></textarea>
		</fieldset>
		</form>
	</div>
	
	<div id="users-contain" class="ui-widget">
		<h1>Existing Comments:</h1>
		<table id="comments" class="ui-widget ui-widget-content">
			<thead>
				<tr class="ui-widget-header">
					<th>Name</th>
					<th>Email</th>
					<th>Comment</th>
				</tr>
			</thead>
			<tbody id="tbl-body">
				
			</tbody>
		</table>
	</div>
	<button id="create-comment">Add Comment</button>
</body>
</html>
<?php
}
?>
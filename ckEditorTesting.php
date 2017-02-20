<?php include "settingPHP/header.php" ?>
	<div style="margin-left:5em">
		<div id="replace">Hello</div>
		<form style="width: 1000px">
			<div id="toggleSlide" style="display:none"><div id="editorHere"></div></div>
		</form>
		
		<a class="btn btn-default" id="edit">Edit</a>
		<a class="btn btn-default" id="save" style="display:none">Save</a>
		
		<script>
			$(document).ready(function(){
				$("#editorHere").replaceWith("<textarea id='editor'>"+$("#replace").html()+"</textarea>");
				CKEDITOR.replace('editor');
				$("#edit").click(function(){
					$("#toggleSlide").slideDown(500);
					$(this).hide();
					$("#save").show();
				});
				
				$("#save").click(function(){
					$(this).hide();
					$("#edit").show();
					$("#toggleSlide").slideUp(500);
					
					$.ajax({
						url:"ckSendInfo.php",
						method:"POST",
						data:{ckVal:CKEDITOR.instances.editor.getData()},
						success:function(data){
						
						},
					});
				});
				
				timer = setInterval(updateDiv,100);
				function updateDiv(){
					var editorText = CKEDITOR.instances.editor.getData();
					$('#replace').html(editorText);
				}
			});
		</script>
	</div>
<?php include "settingPHP/footer.php" ?>
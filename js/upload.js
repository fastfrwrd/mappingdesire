$(document).ready(function(){
	new AjaxUpload('#interview', {
		action: 'audio-upload.php',
		name: 'interview',
		data: {
		  type : 'interview'
		},
		onComplete : function(file){
			$('#interview_file').text(file);
		}	
	});
});
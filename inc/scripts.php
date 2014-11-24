<script src="/quiz/assets/js/jquery-1.9.1.min.js"></script>
    <script src="/quiz/assets/js/bootstrap.min.js"></script>
    <script>
 $(function() {
//twitter bootstrap script
	$("button#submitFeedback").click(function(){
		   	$.ajax({
    		   	type: "POST",
				url: "/quiz/process.php",
				data: $('form#feedbackForm').serialize(),
        		success: function(msg){
 	          		  	$("#thanks").html(msg)
 		        		$("#feedback").modal('hide');	
 		        },
				error: function(){
					alert("failure");
				}
      		});
	});
});
</script>


<script>
jQuery(function($) {
			$('form[data-async]').live('submit', function(event) {
				var $form = $(this);
				var $target = $($form.attr('data-target'));
				 
				$.ajax({
					type: $form.attr('method'),
					url: $form.attr('action'),
					data: $form.serialize(),
					 
					success: function(data, status) {
						$target.html(data);
					}
				});
				 
				event.preventDefault();
			});
		});
                  
</script>

<script>
jQuery(function($) {
	$("a#view-ans").click(function(){
		   	$('.answer-box').css('display','inline-block');
	});	
			
});
</script>
<script>
	$('.pagination .disabled a, .pagination .active a').on('click', function(e){
			e.preventDefault();
		});
</script>
<script src="/quiz/assets/lib/ckeditor/ckeditor.js"></script>
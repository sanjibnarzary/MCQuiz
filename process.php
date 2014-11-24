<?php
if (isset($_POST['fromName'])) {
$name = strip_tags($_POST['fromName']);
$subject = strip_tags($_POST['subjectLine']);
$body = strip_tags($_POST['feedbackBody']);
	
echo "<span class=\"alert-info\">your message has been submitted .. Thanks you</span>";
}?>
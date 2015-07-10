<?php
include 'header.php';
if (!isset($_SESSION)) { 
	
	if (!isset($_SESSION['username'])) {
		header('Location: login.php');
	}
}

?>


<div class="container">
	<div class="link-blocks">
		<a href="controller.php?Setting=User">
			<b class="fa fa-user fa-2x"></b>
			<span>User settings</span>
		</a>

		<a href="controller.php?Setting=Films">
			<b  class="fa fa-caret-square-o-right fa-2x"></b>
			<span>Film settings</span>
		</a>
		<a href="controller.php?Setting=Stoelen">
			<b  class="fa fa-gear fa-2x"></b>
			<span>Stoelprijs settings</span>
		</a>

	</div>	
</div>




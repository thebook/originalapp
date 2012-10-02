<?php 

function scripter($script) {

	echo "<script>$script</script>";

}


function lf_head_hook() {

	do_action( 'lf_head_hook' );

}

?>
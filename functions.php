<?php

function includeTemplate ($template, $dataArray) {
	extract($dataArray);
	ob_start();
	require_once($template);
	return ob_get_clean();
}

?>
<?php

function includeTemplate ($template, $dataArray) {
	extract($dataArray);

	if (file_exists($template)) {
		ob_start();
		require_once($template);
		return ob_get_clean();
	} else {
		return '';
	}

}

function numOfTasks ($taskList, $nameProject) {
    if ($nameProject == 'Все') {
        return count($taskList);
    };
    
    $count = 0;
    foreach ($taskList as $value) {
        if ($value['category'] == $nameProject) {
            $count++;
        } 
    };
    return $count;
};

?>
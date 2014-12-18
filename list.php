<?php
$path = __DIR__ . '/scripts/';

if ($handle = opendir($path)) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
    	if ($entry!='.' && $entry!='..') {
    	    $content = file_get_contents($path . $entry);
    		?><a href="<?php echo $entry ?>"><?php echo json_decode($content)->title . " - comedia/" . $entry ?></a><br /><?php
    	}
    }

    closedir($handle);
}

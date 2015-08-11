<?php
$files = glob('images/*png');
foreach($files as $file) {
	echo "[+] $file\n";
	
	$clean = substr(basename($file), 0, -4);
	$segments = preg_split('/(?=[A-Z])/', $clean);
	
	system('convert -crop 240x290+0+0 '.$file.' cropped/'.$segments[1].'.png');
	system('convert -crop 240x290+245+0 '.$file.' cropped/'.$segments[2].'.png');
	system('convert -crop 240x290+490+0 '.$file.' cropped/'.$segments[3].'.png');
}
?>

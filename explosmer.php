<?php
$download = true;

//
// Stage 1: checking file list, extracting differents names
//
echo "[+] loading files list...\n";

$files = file('filelist');
$segments = array();

foreach($files as $file) {
	$item = substr(basename(trim($file)), 0, -4);
	$cut  = preg_split('/(?=[A-Z])/', $item);
	
	for($i = 1; $i < 4; $i++)
		$segments[$cut[$i]] = $cut[$i];
}

$total = count($segments);

echo "[+] $total comics found\n";

//
// Stage 2: requesting random comic with the same picture each time
//          to be able to rebuild image without watermark after
//
$current = 1;

foreach($segments as $name) {
	printf("\r[+] downloading: %.2f%%", ($current++ / $total) * 100);
	
	if(!$download)
		continue;
	
	$url = "http://files.explosm.net/rcg/$name$name$name.png";
	system("curl -s $url > large/$name.png");
}

echo "\n[+] $total files downloaded\n";

//
// Stage 3: cropping image to have left and right side of each images
//          then merging left and right sides
//          after all, we put the copyright on the image
//
$current = 1;

foreach($segments as $name) {
	printf("\r[+] cropping and merging: %.2f%%", ($current++ / $total) * 100);
	
	system('convert -crop 120x280+0+0   large/'.$name.'.png cropped/'.$name.'-left.png');
	system('convert -crop 120x280+610+0 large/'.$name.'.png cropped/'.$name.'-right.png');
	system('convert +append cropped/'.$name.'-left.png cropped/'.$name.'-right.png final/'.$name.'.png');
	system('convert -composite -geometry +155+265 final/'.$name.'.png resources/explosm-copy.png final/'.$name.'.png');
}

echo "\n[+] $total files parsed\n";
?>

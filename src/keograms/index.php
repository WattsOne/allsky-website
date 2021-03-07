<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="../analyticstracking.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link href="../allsky.css" rel="stylesheet">
	</head>
	<body>
		<?php

        include '../functions.php';
		$dir = '/media/keograms';
		$files = array();
		if ($handle = opendir($dir)) {

			while (false !== ($entry = readdir($handle))) {

				if (strpos($entry, 'jpg') !== false) {

					$files[] = $entry;
				}
			}

			closedir($handle);
		}

		asort($files);
		
		if (!is_dir($dir.'/thumbnails')) {
			mkdir($dir.'/thumbnails', 0755);
		}		

		echo "<a class='back-button' href='..'><i class='fa fa-chevron-left'></i>Back to Live View</a>";
		echo "<div class=archived-videos>";

		foreach ($files as $file) {
            if (!file_exists($dir.'/thumbnails/'.$file)) {
                make_thumb($dir.'/'.$file, $dir.'/thumbnails/'.$file, 100);
            }
			$year = substr($file, 8, 4);
			$month = substr($file, 12, 2);
			$day = substr($file, 14, 2);
			$date = $year.$month.$day;
			echo "<a href='$dir/$file'><div class='day-container'><div class='image-container keogram'><img id=".$date." src='$dir/thumbnails/$file' title='Keogram-$year-$month-$day'/></div><div>$year-$month-$day</div></div></a>";
		}
		echo "</div>";

		?>
	</body>
</html>

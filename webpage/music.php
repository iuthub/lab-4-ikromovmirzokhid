<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
			
			<?php  

				if(isset($_REQUEST["playlist"])){
					$playlist = $_REQUEST["playlist"];
					$handle = fopen("songs/".$playlist, 'r');
				}
			?>

		</div>

		<div id="listarea">
			<ul id="musiclist">
				
			<?php 

				if(isset($handle)){
					while(($line = fgets($handle))!==false){

						$filename = trim("songs/".$line);

						$size = filesize($filename);
						if($size>1023 && $size<1048575)
							$size = round(($size/1024),2)." kb";
						elseif($size>1048575)
							$size = round(($size/1024/1024), 2)." mb";
						else 
							$size = $size." b";

						?>
						<li class='mp3item'><a href='<?= $filename ?>'><?= basename($filename)?></a><?=" (".$size.")"?></li>
				<?php
				
					}

						fclose($handle);
					?>
						<BUTTON><a href="music.php">Back</BUTTON>
				<?php
				
					}

				else{	
					foreach(glob("songs/*.mp3") as $musicfile) 
					{	
						$size = filesize($musicfile);
						if($size>1023 && $size<1048575)
							$size = round(($size/1024),2)." kb";
						elseif($size>1048575)
							$size = round(($size/1024/1024), 2)." mb";
						else 
							$size = $size." b";
				?>
			
					<li class="mp3item">
						
						<a href="<?=$musicfile?>"><?= basename($musicfile) ?></a><?=" (".$size.")"?>
						
					</li>
				
				<?php
					}
				?>

				<?php foreach(glob("songs/*.txt") as $filename) 
					{
				?>
			
					<li class="playlistitem">
						
						<a href="<?= "music.php?playlist=".basename($filename)?>"><?= basename($filename) ?></a>
						
					</li>
				
				<?php
					}
				}
			?>
			</ul>
		</div>
	</body>
</html>

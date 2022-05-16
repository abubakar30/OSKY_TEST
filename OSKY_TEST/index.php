<?php
// Read the JSON file
$json = file_get_contents('data.json');

// Decode the JSON file
$json_data = json_decode($json,true);
?>

<!DOCTYPE html>
<html>
<head>
	<title>NEWS</title>
	<style>
		.center 
		{
			margin: auto;
			width: 60%;
			padding: 10px;
		}
	</style>
</head>
<body>

	<div class="center">
		<?php
		sort($json_data);
		foreach($json_data as $json)
		{ 
		?>
		<div class="news">
		<h2><?php echo $json['title'] . "</br>"; ?></h2>
		<?php
			$link_type = gettype($json['link']);
			
			if ($link_type == "string")
			{
				$string1 = "urn";
				$string2 = "urc";

				if (str_contains($json['link'], $string1) || str_contains($json['link'], $string2))
				{
					echo $json['link'] . "</br>";
				}
				else
				{
		?>
					<a href="<?php echo $json['link'] ?>" target="_blank" >Read More</a>
		<?php
				}
			}
			else
			{
				foreach($json['link'] as $json_link)
				{
					$string1 = "urn";
					$string2 = "urc";

					if (str_contains($json_link, $string1) || str_contains($json_link, $string2))
					{
						echo $json_link . "</br>";
					}
					else
					{
		?>
						<a href="<?php echo $json_link; ?>" target="_blank" >Read More</a><br>
		<?php
					}
				}
			}
		?>
		<p><?php echo $json['description'] . "</br>"; ?></p>
		<p><em>
		<?php 
			$date = substr($json['pubDate'], 5, 11);
			$date_proper = date('l \, jS \of F Y', strtotime($date));
			
			$time = substr($json['pubDate'], 17, 17);
			$time_proper = date('g:i A', strtotime($time));
			
			echo $date_proper." ".$time_proper."</br>" . "</br>";
		?>
		</em></p>
		</div>
		<?php
		}
		?>
	</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script>
$('.news').each(function(i) {
    // 'i' stands for index of each element
    $(this).hide().delay(i * 500).fadeIn(1000);
});
</script>
</body>
</html>
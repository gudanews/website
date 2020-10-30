<?php
$category = "CATEGORY";
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$parsed_url = parse_url($current_url);
$query = $parsed_url['query'];
parse_str($query, $params);

if (isset($params['c'])) {
    unset($params['c']);
}
$query = http_build_query($params);
$link = "$parsed_url[scheme]://$parsed_url[host]$parsed_url[path]?$query";

echo <<<EOL
<div class='footer' layout horizontal>
	<div class="wrapper">
		<div class="toggle_button">
        <nav>
            <ul>
				<li>
                    <a class="share_btn">
						<span class="text">$category</span>
						<span class="icon"><i class="fas fa-plus"></i></span>
					</a>
				</li>
				<li>
					<a href="$link&c=11">
						<p class="text">SPORTS</p>
					</a>
				</li>
                <li>
					<a href="$link&c=6">
						<p class="text">POLITICS</p>
					</a>
				</li>
                <li>
					<a href="$link&c=9">
						<p class="text">ENTERTAINMENT</p>
					</a>
				</li>
                <li>
					<a href="$link&c=4">
						<p class="text">WORLD</p>
					</a>
				</li>
                <li>
					<a href="$link&c=1">
						<p class="text">TOP</p>
					</a>
				</li>
                <li>
					<a href="$link&c=5">
						<p class="text">OPINION</p>
					</a>
				</li>
                <li>
					<a href="$link&c=7">
						<p class="text">BUSINESS</p>
					</a>
				</li>
                <li>
					<a href="$link&c=8">
						<p class="text">TECHNOLOGY & SCIENCE</p>
					</a>
				</li>
                <li>
					<a href="$link&c=10">
						<p class="text">HEALTH</p>
					</a>
				</li>
                <li>
					<a href="$link&c=12">
						<p class="text">WEATHER</p>
					</a>
				</li>
                <li>
					<a href="$link&c=13">
						<p class="text">LIFESTYLE & CULTURE</p>
					</a>
				</li>
                <li>
					<a href="$link&c=14">
						<p class="text">MULTIMEDIA</p>
					</a>
				</li>
			</ul>
        </nav>
		</div>
	</div>
    <div class="bottom-home">
        <a href="index.php" class="fas fa-home fa-3x"></a>
    </div>
</div>

<script>
	var share_btn = document.querySelector(".share_btn");
	var toggle_button = document.querySelector(".toggle_button");

	share_btn.addEventListener("click", function(){
		toggle_button.classList.toggle("active");
	})
</script>

</body>
</html>
EOL;
?>

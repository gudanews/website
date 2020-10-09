<?php

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$parsed_url = parse_url($current_url);
$query = $parsed_url['query'];
parse_str($query, $params);

if (isset($params['lang'])) {
    unset($params['lang']);
}
$params['lang'] = $lang? 0: 1;
$query = http_build_query($params);
$link = "$parsed_url[scheme]://$parsed_url[host]$parsed_url[path]?$query";

echo <<<EOL
<div class='footer'>
 <div class='top-button'>
     <button onclick='topFunction()' id='topBtn' title='Go to top'><i class='fas fa-arrow-circle-up fa-3x'></i></button>
 </div>
</div>
EOL;
?>
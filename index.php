<?php
function print_post($file, $title, $content) {
	echo "<h3><a href=\"" . $file . "\">$title</a></h3>";
	echo "<p class=\"date\">" . date('Y-m-d', filectime($file)) . "</p>";
	echo "<div id=\"post_wrapper\">" . $content . "<p class=\"gradient_overlay\"><a href=\"" . $file . "\">Read full post &#8594;</a></p></div>";
}
function get_latest_post() {
	$files = glob("blog/*/*/*.html");
	array_multisort(array_map('filectime', $files), SORT_NUMERIC, SORT_DESC, $files);
	for($i=0;$i<count($files);$i++) {
		$f = file_get_contents($files[$i]);
		if(!$f) continue;
		if(!preg_match("/<h1 class=\"post_title\">(.*)<\/h1>/siU", $f, $match)) continue;
		preg_match("/<div id=\"post_body\">(.*)<\/div><!--post_body-->/siU", $f, $content);
		print_post($files[$i], trim($match[1]), $content[1]);
		break;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>printf(&quot;Thoughts&quot;);</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Share Tech Mono"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT Sans"/>
	<link rel="stylesheet" href="/css/main.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<div id="all_wrapper">
	<!--HEADER-->
	<div id="header_wrapper">
		<h1><a href="https://www.printf.ca/">printf(&quot;Thoughts&quot;);</a></h1>
		<p>Adventures in C, Linux, and open source</p>
		<div id="nav_bar">
			<ul>
				<a href="/"><li>Home</li></a>
				<a href="/projects/"><li>Projects</li></a>
				<a href="/blog/"><li>Blog</li></a>
				<a href="/about.html"><li>About</li></a>
			</ul>
		</div><!--nav_bar-->
	</div><!--header_wrapper-->
	<hr/>
	<!--CONTENT-->
	<div id="content_wrapper">
		<div id="left_wrapper">
			<?php get_latest_post()?>
			<h4><a href="/blog/">More ramblings in my blog &#8594;</a></h4>
		</div>
		<div id="right_wrapper">
			<h3>David Seguin</h3>
			<hr>
			<p>Explorer of cool technologies, amateur programmer and linux admin, and generally curious about anything related to computers and open source software.<br><a href="/about.html">More about me &#8594;</a></p>
		</div>
	</div><!--content_wrapper-->
</div><!--all_wrapper-->
<div id="footer_wrapper">
	<p>David Seguin on <a href="https://github.com/dseguin">Github</a></p>
</div><!--footer_wrapper-->
</body>
</html>

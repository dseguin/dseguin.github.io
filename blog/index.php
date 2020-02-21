<?php
function dump_posts() {
	$files = glob("*/*/*.html");
	array_multisort(array_map('filectime', $files), SORT_NUMERIC, SORT_DESC, $files);
	for($i=0;$i<count($files);$i++) {
		$f = file_get_contents($files[$i]);
		if(!$f) continue;
		if(!preg_match("/<h1 class=\"post_title\">(.*)<\/h1>/siU", $f, $match)) continue;
		echo "<tr><td>" . date('Y-m-d', filectime($files[$i])) . "</td><td><a href=\"" . $files[$i] . "\">" . trim($match[1]) . "</a></td></tr>";
	}
}
?>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>printf(&quot;Thoughts&quot;);</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Share Tech Mono"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT Sans"/>
	<link rel="stylesheet" href="/css/main.css"/>
	<link rel="stylesheet" href="/css/blog_index.css"/>
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
		<h1>Thoughts</h1>
		<table>
		<tr><th>Date</th><th>Title</th></tr>
		<?php
			dump_posts();
		?>
		</table>
	</div><!--content_wrapper-->
</div><!--all_wrapper-->
<div id="footer_wrapper">
	<p>David Seguin on <a href="https://github.com/dseguin">Github</a></p>
</div><!--footer_wrapper-->
</body>
</html>

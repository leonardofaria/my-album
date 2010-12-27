<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Meu album</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<!--<script type="text/javascript" src="/lib/jquery.min.js"></script>-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<script type="text/javascript">
		$(document).ready(function() { 
			$(".gallery_img").click(function(){
				$("#result").html("<center><img src=\'" + this.href + "'></center>");
				return false;
			});
		});
	</script>
</head>
<body>
<header>
	<h1>Meu album</h1>

	<?php
	// list directories
	// echo "<nav>";
	// $photos_directory = @opendir("photos");
    // 
	// while (false !== ($dir = readdir($photos_directory))) {
	//     if ($dir != "." && $dir != ".." && $dir != ".DS_Store") { 
	//         echo "<a href=\"?gallery=photos/$dir/full\">$dir</a>";
	//     }
	// }
	// echo "</nav>";
	?>
</header>

<section id="content">
	<?php
	
	$per_page = 9;
	
	if (isset($_GET['page'])){
	    $page = $_GET['page'];
	} else {
	    $page = 1;
	}
		
	if (isset($_GET['gallery'])) {
		$dir = $_GET['gallery'];
	} else {
		$dir = "photos/pep/full";
	}

	$$dir = @opendir($dir);

	while (false !== ($file = readdir($$dir))) {
	    if ($file != "." && $file != ".." && $file != ".DS_Store") { 
	        $i++;
	        $index[$i] = "$dir/$full/$file";
	    }
	}

	$index = array_chunk($index,$per_page); 
	$n_page = count($index);

	for($i = $n_page; $i >= 0; $i--) { $index[$i+1] = $index[$i]; }

	if ($page > $n_page || $page == 0) {
	    die("<center>Erro: Página solicitada inexistente! <br/>Por favor volte e escolha outro link.</center>");
	}

	for ($i = 0; $i < $per_page; $i++) {
	    if ($index[$page][$i] != "") {
			$full_path = $index[$page][$i];
	        $thumb_path = preg_replace("/full/", "thumbs", $index[$page][$i]);
			echo "<a href=\"$full_path\" class=\"gallery_img\"><img src=\"$thumb_path\" class='img'/></a>\n";
	    } 
	} 

	// show pagination where number of pages > 1
	if ($n_page > 1) {
		echo "<nav>";
		for ($i = 1; $i <= $n_page; $i++) {
		    if ($i != $page) {
		        echo "<a href=\"?page=$i&gallery=$dir\">$i</a> "; 
		    } else {
		        echo "<strong>$i</strong> ";
		    }
		}
		echo "</nav>";
	}
	?>

	<div id="result"></div>
</section>

<footer>
	Criado por <a href="mailto:leonardo.coelho@previdencia.gov.br">Leonardo Faria</a> na <a href="http://www-gexdiv">Gerência Executiva de Divinópolis</a>
</footer>
</body>
</html>
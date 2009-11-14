<?php
	# Pega onde está a imagem
		$pimage = $_GET["src"];
		define('PATH_IMG',$pimage);
		$image_path = PATH_IMG;
		$div = $_GET["num"];
		
		# Carrega a imagem
		$img = imagecreatefromjpeg($image_path);
		
		//pega o tamanho atual da imagem
		$width_original = imagesx($img);
		$height_original = imagesy($img);
		   
		#define o valor para a divisao do tamanho da img
		$divisor = $width_original / $div;
		   
   		//define o tamanho que a imagem deverá ser exibida
        $width_novo = $width_original / $divisor;
        $height_novo = $height_original / $divisor;
           
		$largura = round($width_novo);
		$altura  = round($height_novo);
		
		//cria a imgem indefinida ainda
		$imagem = imagecreatetruecolor($largura,$altura);
		
		//recebe a imagem original
        $source = $img;
		//cria a copia da imagem
        imagecopyresampled($imagem,$source,0,0,0,0,$largura,$altura,$width_original,$height_original);
		
        //carrega a imagem
        header('Content-type: image/jpeg');
		imagejpeg($imagem);
		
		//destroi a imagem temporária
        imagedestroy($imagem);
?>
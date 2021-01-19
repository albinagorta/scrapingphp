<?php 
require_once("web.php");
require_once("vendor/autoload.php");
require_once("vendor/fabpot/Goutte/Goutte/Client.php");

use Goutte\Client;

$client = new Client();

/*dbscrapingphp*/


$crawler = $client->request('GET', 'https://itoo.dev/courses');

$crawler->filter('.course-list > div')->each(function ($curso) {

	$precio=$curso->filter('div.small.course-price')->first()->text();

	$img=$curso->filter('img.course-box-image')->first()->attr('src');
	$ruta='https://itoo.dev/'.$curso->filter('a')->first()->attr('href');
	$titulo=$curso->filter('div.course-listing-title')->first()->text();
	$titular=$curso->filter('div.course-listing-subtitle')->first()->text();

	$instructor='';	
	if ($curso->filter('span.small.course-author-name')->count()) {
		$instructor='Instructor: '.$curso->filter('span.small.course-author-name')->first()->text();
	}else{
		$instructor='promocion: '.$curso->filter('div.small.course-bundle')->first()->text();
	}
	

	$data = array();
	$data['titulo']=$titulo;
	$data['titular']=$titular;
	$data['precio']=$precio;
	$data['img']=$img;
	$data['ruta']=$ruta;
	$data['instructor']=$instructor;
	$iretorno= Web::guardar('cursos',$data);

	echo $iretorno;

});

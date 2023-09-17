<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Search extends Controller
{
    function GetGSearch (Request $req){
        
        ini_set( 'default_charset', 'utf-8');
        header('Content-Type: text/html; charset=utf-8');

        // converte texto recebido no formato para URL
        $q=urlencode($req->q);

        // cria URL
        $url = 'https://google.com/search?q='.$q;

        // recebe conteudo da página
        $content = file_get_contents($url);

        $contentenc = mb_convert_encoding($content, 'UTF-8',
            mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));

        // busca conteudo dentro da div com o título
        //preg_match_all('/<div class="BNeawe vvjwJb AP7Wnd">([^<]*)<\/div>/s', $contentenc, $titles);
        preg_match_all('/<h3 class="zBAuLc l97dzf"><div class="BNeawe vvjwJb AP7Wnd">([^<]*)<\/div>/', $contentenc, $titles);

        // busca conteudo do link de cada resultado
        preg_match_all('/<div class="egMi0 kCrYT"><a\s+href="\/url\?q=([^"]+)"/', $content, $links);

        // array para receber a relação de titulos e links
        $tuple=[];

        // loop que povoa array tupla
        for($i=0; $i < sizeof($links[1]); $i++){
            $tuple[html_entity_decode($titles[1][$i])] = urldecode((explode("&", $links[1][$i]))[0]);
        }

        return json_encode($tuple, JSON_FORCE_OBJECT);
    }
}

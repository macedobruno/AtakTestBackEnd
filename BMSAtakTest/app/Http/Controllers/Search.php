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
        $url = 'https://google.com/search?ie=UTF-8&q='.$q;

        // recebe conteudo da página
        $content = file_get_contents($url);

        $content = mb_convert_encoding($content, 'UTF-8',
            mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));

        // busca conteudo dentro da div com o título
        preg_match_all('/<div class="BNeawe vvjwJb AP7Wnd">([^<]*)<\/div>/s', $content, $titles);

        // busca conteudo do link de cada resultado
        preg_match_all('/<div class="egMi0 kCrYT"><a\s+href="\/url\?q=([^"]+)"/', $content, $linksbruto);

        //cria array para receber os links tratados
        $links=[];

        //explode cada item do array linksbruto para remover espaço e conteudo extra
        foreach($linksbruto[1] as $mt){
            array_push($links, (explode("&", $mt))[0]);
        }
        // array para receber a relação de titulos e links
        $tupla=[];

        // loop que povoa array tupla
        for($i=0; $i < sizeof($titles[1]); $i++){
            $tupla[$titles[1][$i]] = $links[$i];
        }

        return json_encode($tupla, JSON_FORCE_OBJECT);
    }
}

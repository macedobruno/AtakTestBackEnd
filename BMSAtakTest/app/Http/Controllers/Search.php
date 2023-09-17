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

        //$content = mb_convert_encoding($content, "UTF-8", "HTML-ENTITIES", true);

        $content = mb_convert_encoding($content, 'UTF-8',
            mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));

        // busca conteudo dentro da div com o título
        preg_match_all('/<div class="BNeawe vvjwJb AP7Wnd">([^<]*)<\/div>/s', $content, $titles);

        // busca conteudo do link de cada resultado
        preg_match_all('/<div class="BNeawe UPmit AP7Wnd lRVwie">([^<]*)<\/div>/s', $content, $linksbruto);
        //preg_match_all('/<a*\s+jsname="UWckNb"*\s+href="([^"]+)"/', $content, $linksbruto);

        //cria array para receber os links tratados
        $links=[];

        //explode cada item do array linksbruto para remover espaço e conteudo extra
        foreach($linksbruto[1] as $mt){
            array_push($links, (explode(" ", $mt))[0]);
        }

        // array para receber a relação de titulos e links
        $tupla=[];

        // loop que povoa array tupla
        //for($i=0; $i < sizeof($titles[1]); $i++){
        for($i=0; $i < sizeof($links); $i++){
            //$tupla[mb_convert_encoding($titles[1][$i], 'UTF-8')] = $links[$i];
            $tupla[$titles[1][$i]] = $links[$i];

            //echo ("<a href='http://".$links[$i]."/'>".$links[$i]."</a>\n");
        }

        //
        //var_dump($titles[1]);
        //var_dump($tit);
        //var_dump($links);
        //var_dump($tupla);

        return json_encode($tupla, JSON_FORCE_OBJECT);
    }
}

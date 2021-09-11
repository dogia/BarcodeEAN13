<?php
/*
   Autores: Daniel Osorio Orozco - Juan Sebastián Bermudez Zuluaga
   Código de Identificación: 1093228211 (Daniel) - 1087486371 (Juan Sebastián)
   Fecha: 11 de Septiembre de 2021
   Universidad Tecnológica de Pereira
   Facultad de Ingeniería
   Ingeniería de Sistemas y Computación
 
   PHP 7.4.23 (cli) (built: Aug 26 2021 15:51:55) ( NTS )
   Copyright (c) The PHP Group
   Zend Engine v3.4.0, Copyright (c) Zend Technologies
   with Zend OPcache v7.4.23, Copyright (c), by Zend Technologies
 
   OS: Ubuntu 21.04 x86_64
   Host: Inspiron 3493
   Kernel: 5.11.0-34-generic
*/
/******************************************************************
* Función: producto_lenguaje
* Objetivo: Devolver el resultado de multiplicar un lenguaje ($primer_lenguaje) por otro ($segundo_lenguaje)
* @params $primer_lenguaje -> Arreglo de palabras (lenguaje)
* @params $segundo_lenguaje -> Arreglo de palabras (lenguaje)
******************************************************************
*/
function producto_lenguaje($primer_lenguaje, $segundo_lenguaje){
   $lenguaje_resultante = array();
 
   foreach($primer_lenguaje as $palabra_primer_lenguaje){
       foreach($segundo_lenguaje as $palabra_segundo_lenguaje){
           $nueva_palabra = $palabra_primer_lenguaje.$palabra_segundo_lenguaje;
           $lenguaje_resultante[] = $nueva_palabra;
       }
   }
   return $lenguaje_resultante;
}
 
/****************************************************************
* Función: potencia_lenguaje
* Objetivo: Devolver un lenguaje resultante de elevar un lenguaje ($lenguaje) a una potencia ($potencia)
* @params: $lenguaje -> Lenguaje que sirve como base de la potencia
* @params: $potencia -> Potencia a la que se eleva el lenguaje
****************************************************************
*/
function potencia_lenguaje($lenguaje, $potencia){
   $lenguaje_resultante = $lenguaje;
   if($potencia == 0){
       return ["λ"];
   }
 
   for($i=1; $i < $potencia; $i++){
       $lenguaje_resultante = producto_lenguaje($lenguaje_resultante, $lenguaje);
   }
 
   if($potencia > 0){
       return $lenguaje_resultante;   
   }else{
       return array_reverse($lenguaje_resultante);
   }
}
 
function formatear_lambda(&$L){
   foreach($L as &$lenguaje){
       foreach($lenguaje as &$palabra){
           if(strlen($palabra) > 1){
               $palabra = str_replace('λ', '', $palabra);
           }
       }
   }
}
 
/**
* Lenguajes formales para la etiqueta
*/
$L['digitos'] = ['0','1','2','3','4','5','6','7','8','9'];
$L['prefijo'] = ['770'];
$L['empresa'] = potencia_lenguaje($L['digitos'], 4);
$L['separador'] = ['||'];
$L['productos'] = potencia_lenguaje($L['digitos'], 5);
$L['digito_control'] = $L['digitos'];
/*
* En teoría pero la complejidad computacional "O" es exponencial y demasiado grande O(1, 10000, 1,100000, 10) = 10.000.000.000 Combinaciones posibles
* $L['etiqueta'] = producto_lenguaje(producto_lenguaje(producto_lenguaje((producto_lenguaje($L['prefijo'], $L['empresa'])), $L['separador']), $L['productos']), $L['digito_control']);
*/
 
$L['ejemplo_etiqueta'][] =
   $L['prefijo'][rand(0, count($L['prefijo'])-1)].
   $L['empresa'][rand(0, count($L['empresa'])-1)].
   $L['separador'][rand(0, count($L['separador'])-1)].
   $L['productos'][rand(0, count($L['productos'])-1)].
   $L['digito_control'][rand(0, count($L['digito_control'])-1)];
 
echo "\n";
print_r($L['ejemplo_etiqueta']);
echo "\n\n";

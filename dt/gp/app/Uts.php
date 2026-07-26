<?php

namespace App;
use \Spreadsheet_Excel_Writer;
class Uts
{
    public static function nbf($n)
    {
        return number_format($n, 0, ',', ' ');
    }
   
   public static function diff($a,$b){
    return round((strtotime($b) - strtotime($a))/(60*60*24)+1);
   }
 public static function ds($ps){
    $d=[];
foreach($ps as $p=>$v)
    $d[]=[$p=>$v];
 }
        public static function label($v){
            $v=str_replace('_id','',$v);
            $v=str_replace('l_','',$v);
            return ucfirst($v);
        }

        public static function camel($v){
            $ps = explode('_',str_replace('_id','',$v));
            $st='';
            foreach($ps as $p)
              $st .= ucfirst($p);
            return $st;
        }

        public static function nom($s){
            $m=['Ali','Hassan','Ahmed','Mohamed','Osman','Aden','Omar','Elmi','Abdillahi','Houssein','Aden'];
            $f=['Aicha','Fatouma','Kadra','Adna','Hibo','Asli','Saida','Fathia','Zahra','Samia','Soureya'];
            if($s=='F')
               return $f[rand(1,9)];
             else return $m[rand(1,9)];
        }
        public static function gennom($s){
            if($s=='F')
            return \App\Uts::nom($s).' '.\App\Uts::nom('M').' '.\App\Uts::nom('M');
        else
            return \App\Uts::nom($s).' '.\App\Uts::nom('M').' '.\App\Uts::nom('M');
        }
 public static function stp($s){
    if(\Str::startsWith($s,'int')) return 'int';
    if(\Str::startsWith($s,'var')) return 'String';
 if(\Str::startsWith($s,'date')) return 'DateTime';
  if(\Str::startsWith($s,'tiny')) return 'int';
     if(\Str::startsWith($s,'big')) return 'int';
 }
public static function std($s){
    if(\Str::startsWith($s,'int')) return 'INTEGER';
    if(\Str::startsWith($s,'var')) return 'TEXT';
 if(\Str::startsWith($s,'date')) return 'TEXT';
  if(\Str::startsWith($s,'tiny')) return 'INTEGER';
     if(\Str::startsWith($s,'big')) return 'INTEGER';
 }
public static function rplb($d,$nc,$f){

    $c=file_get_contents($f);
    $p1=strpos($c, $d);
    $l=substr($c,0, $p1+5);
    $p2=strpos($c, "{$d}/");

    $r=substr($c, $p2,strlen($l));
    echo $l.$nc.$r;
    file_put_contents($f,$l.$nc.$r);
}
public static function rpl($a,$b,$f){
    $c=file_get_contents($f);
    $st=str_replace($a,$b,$c);
    file_put_contents($f,$st);
}
}

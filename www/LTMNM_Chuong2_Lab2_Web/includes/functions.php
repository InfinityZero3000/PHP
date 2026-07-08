<?php
declare(strict_types=1);
function e(string $v): string{return htmlspecialchars($v,ENT_QUOTES,'UTF-8');}
function old(string $k,string $d=''): string{return e((string)($_POST[$k]??$d));}
function money(float $v): string{return number_format($v,0,',','.').' VND';}

<?php

$url = "http://localhost:8080/api/notes";
$retorno = file_get_contents($url);

$dados = json_decode($retorno, 1);

foreach ($dados as $d) {
  echo $d['titulo'] . "<br>";
  echo $d['texto'] . "<br>";
  echo $d['imagem'] . "<br>";
  echo "<hr>";
}

<?php

namespace App;

class Pagination extends Core\App
{
  public $dados;
  public $atual;
  public $quantidade;
  public $registrosPagina;
  public $contar;
  public $resultado;

  public function __construct($dados, $atual, $quantidade)
  {
    $this->dados = $dados;
    $this->atual = $atual;
    $this->quantidade = $quantidade;
  }
  // resultados
  public function resultado()
  {
    $this->registrosPagina = array_chunk($this->dados, $this->quantidade);  //dividir o array em quantidade especifica
    $this->contar = count($this->registrosPagina);  //total de registros
    if ($this->contar > 0) {  //condição para registro vazio
      $this->resultado = $this->registrosPagina[$this->atual - 1];
      return $this->resultado;
    } else {
      return [];  //array vazio
    }
  }

  public function navigator()
  {
    echo "<ul class='pagination'>";
    for ($i = 1; $i <= $this->contar; $i++) {
      if ($i == $this->atual) {
        echo "<li class = 'active'><a href='#'>" . $i . "</a></li>";
      } else {
        echo "<li><a href='" . $this->currentURL() . "?page=" . $i . "'>" . $i . "</a></li>";
      }
    }
    echo "</ul>";
  }
}

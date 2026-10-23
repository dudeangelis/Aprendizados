<?php

include __DIR__ ."/../views/template_tarefa.php";

if(tratar_anexo($dados_anexo)){
  $anexo = new Tarefas\Models\Anexo();
}
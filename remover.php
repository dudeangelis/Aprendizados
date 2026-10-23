<?php

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = [];

$tarefa = new Tarefa();
$tarefa->setPrioridade(1);

$repositorio_tarefas = new RepositorioTarefas($mysqli);
$repositorio_tarefas->remover($_GET['id']);
$repositorio_tarefas = new RepositorioTarefas($pdo);

header('Location: index.php?rota=tarefas');
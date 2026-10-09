<?php

session_start(); 
include "template.php";
require "banco.php";
require 'ajudantes.php'
require "template.php"

$exibir_tabela = true;

    $lista_tarefas = buscar_tarefas($conexao);

    
        $tarefa = [
        'id' => 0,
        'nome' => '',
        'descricao' => '',
        'prazo' => '',
        'prioridade' => 1,
        'concluida' => ''
        ]


    if(array_key_exists('nome', $_POST) && $_POST['nome'] != ''){
        $tarefa = [
            'nome' => $_POST['nome'],
            'descricao' => '',
            'prazo' => '',
            'prioridade' => $_POST['prioridade'],
            'concluida' => '0',
        ];

        $tarefa['nome'] = $_POST['nome'];

    if (array_key_exists ('descricao', $_POST)) {
     $tarefa['descricao'] = $_POST['descricao'];
    } else{
    $tarefa['descricao'] = '';
    }
    if (array_key_exists('prazo', $_POST)){
        $tarefa['prazo'] = $_POST['prazo'];
    } else{
        $tarefa['prazo'] = '';
    }

    $tarefa['prioridade'] = $_POST['prioridade'];

    if(array_key_exists('concluida', $_POST)){
        $tarefa['concluida'] = 1;
    } 

    $_SESSION['lista_tarefas'][] = $tarefa;

}

editar_tarefa($conexao, $tarefa);
header ('Location: tarefas.php');
die();

gravar_tarefa($conexao, $tarefa);
header('Location: tarefas.php');
die();

function buscar_tarefas($conexao)
{
    $sqlBusca = 'SELECT * FROM tarefas';
    $resultado = mysli_query($conexao, $sqlBusca);

    $tarefas = [];

    while ($tarefa = mysqli_fetc_assoc($resultado)){
        $tarefas[] = $tarefa;
    }
    return $tarefas;
} 



    $lista_tarefas = [];

    /*if (array_key_exists('lista_tarefas', $_SESSION)){
        $lista_tarefas = $_SESSION['lista_tarefas'];
    }*/
    /*if (array_key_exists('nome', $_POST)){
        echo "Nome informado: " . $_POST['nome'];
    }*/
?>
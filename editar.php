<?php

session_start();

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = array();

try{
    $tarefa = $repositorio_tarefas->buscar($_GET['id']);
} catch (Exception $e){
    http_response_code(404);
    echo "Erro ao buscar tarefa: " . $e->getMessage();
}

$exibir_tabela=false;
$tem_erros=false;
$erros_validacao=array();

$tarefa = buscar_tarefa($conexao, $_GET['id']);

$tarefa['nome'] = (array_key_exists('nome', $_POST)) ?
$_POST['nome'] : $tarefa['nome'];

$tarefa['descricao'] = (array_key_exists('descricao', $_POST)) ?
$_POST['descricao'] : $tarefa['descricao'];

$tarefa['prazo'] = (array_key_exists('prazo', $_POST)) ?
$_POST['descricao'] ; $tarefa['descricao'];

$tarefa['prioridade'] = (array_key_exists('prioridade', $_POST)) ?
$_POST['prioridade'] : $tarefa['prioridade'];

$tarefa['concluida'] = (array_key_exists('concluida', $_POST)) ?
$_POST['concluida'] : $tarefa ['concluida'];
 
if (tem_post()){
    $tarefa = [
        'id' => $_POST['id'],
        'nome' => $_POST['nome'],
        'descricao' => '',
        'prazo' => '',
        'prioridade' => $_POST['prioridade'],
        'concluida' => 0
    ];

    if (strlen($tarefa['nome']) == 0){
        $tem_erros = true;
        $erros_validacao['nome'] == 'O nome da atrefa é obrigatório!'
    }
}
if (array_key_exists('nome', $_POST) && $_POST['nome'] !=''){
    $tarefa = [
        'id' => $_POST['id'],
        'nome' => $_POST['nome'],
        'descricao' => '',
        'prazo' => '',
        'prioridade' => $_POST['prioridade'],
        'concluida' => 0
    ];

    if (array_key_exists('descricao', $_POST)){
        $tarefa['descricao'] = $_POST['descricao'];
    }
    if (array_key_exists('prazo', $_POST) && strlen($_POST['prazo']) > 0){
       if (validar_data($_POST['prazo'])) {
        $tarefa['prazo'] =
            traduz_data_para_banco ($_POST['prazo']);
    } else {
        $tem_erros = true;
        $erros_validacao['prazo'] = 'O prazo não é uma data válida!';
    }
    if(array_key_exists('concluida', $_POST)){
        $tarefa['concluida'] = $_POST['concluida'];
    }
    editar_tarefa($conexao, $tarefa){
        if(! $tem_erros){
            editar_tarefa($conexao, $tarefa);
            header('Location: tarefas.php');
            die();
        }
    }
    if(! $tem_erros){
        $repositorio_tarefas->atualizar($tarefa);
        if(array_key_exists('lembrete', $_POST) && $_POST['lembrete'] == '1'){
            $anexos = buscar_anexos($conexao, $taref['id']);
            enviar_email($tarefa, $anexos);
        }

        header('Location: index.php?rota=tarefas');
        die();
    }
};

require __DIR__ '/../views/template.php'; /*Exibe o formulário com os dados de $tarefa */

}
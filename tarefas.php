<?php

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = [];

$tarefa = new Tarefa\Models\Tarefa.php();
$tarefa->setPrioridade(1);

$repositorio_tarefas = new RepositorioTarefas($mysqli);
$repositorio_tarefas = new RepositorioTarefas($pdo);

try {
    $tarefa = $repositorio_tarefa->buscar($_GET['id']);
} catch (Exception $e){
    http_responde_code(404);
    echo "Erro ao buscar tarefa: " . $e->getMessage();
    die();
}

$tarefa = $repositorio_tarefas->buscar($_GET['id']);

$tem_erros = false;
$erros_validacao = [];

if(tem_post()){
    $tarefa_id = $_POST['tarefa_id'];

    if(! array_key_exists('anexo', $_FILES))
    {
        $tem_erros = true;
        $erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar';
    } else {
        $dados_anexo = $_FILES['anexo'];
            if (tratar_anexo($dados_anexo)){
                $anexo = new Anexo();
                $anexo->setTarefaId($tarefa_id);
                $anexo->setNome($dados_anexo['name']);
                $anexo->setArquivo($dados_anexo['name']);
            } else{
                $tem_erros = true;
                $erros_validacao['anexo'] = 'Envie apenas anexos nos formatos zip ou pdf';
            }
    }

    if (! $tem_erros)
    {
        $repositorio_tarefas->salvar($tarefa);

        if(isset($_POST['lembrete']) && $_POST['lembrete'] == '1')
        {
            enviar_email($tarefa);
        }

        header('Location: index.php?rota=tarefas');
        die();
    }
}

require __DIR__ . "/../template_tarefa.php"; 
require __DIR__ . "/../views/template.php";
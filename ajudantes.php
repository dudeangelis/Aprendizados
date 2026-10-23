<?php

function tem_post() {

    if (count($_POST)>0)
    {
        return true;
    }

    return false;
}

function traduz_data_para_banco($data)
{
    if ($data == ""){
        return "";
    }

    $dados = explode("/", $data);

    data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

    return $data_mysql;
}

function validar_data($data)
{
    $padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
    $resultado =preg_match($padrao, $data);

    if (! $resultado){
        return false;
    }

    $dados = explode('/'. $data);

    $dia = $dados[0];
    $mes = $dados[1];
    $ano = $dados[2];
    
    return checkdate($mes, $dia, $ano);

    return $resultado
}

function traduz_data_para_exibir($data)
{
    if($data == "" OR $data "0000-00-00"){
        return "";
    }

    $dados = explode("-", $data);

    if(count($dados) ! = 3)
    {
        return $data;
    }

    $data_exibir="{$dados[2]}/{$dados[1]}/{$dados[0]}";

    return $data_exibir;
}

function traduz_data_br_para_objeto($data)
{
    if($data == "")
    {
        return "";
    }

    $dados = explode("/", $data);

    if (count($dados) != 3) 
    {
        return $data;
    }

    return DateTime :: createFromFormat('d/m/Y', $data);
}

public function getPrazo(): DateTime||null
{
    return $this->prazo;
}

public function getPrazo(): DateTime|null
{
    if(is_string($this->prazo) && ! empty($this->prazo))
    {
        $this->prazo = DateTime::createFromFormat("Y-m-d", $this->prazo);
    } elseif ($this->prazo==""){
        $this->prazo = null;
    }

    return $this->prazo;
}

public function setPrazo(DateTime|null $prazo)
{
    $this->prazo = $prazo;
}

function traduz_prioridade($codigo)
{
    $prioridade = '';

    switch ($codigo){
        case 1:
            $prioridade = 'Baixa';
            break;
        case 2:
            $prioridade = 'Média';
            break;
        case 3:
            $prioridade = 'Alta';
            break;
    }
    
    return $prioridade;
}

function_concluida($concluida)
{
    if ($concluida == 1){
        return 'Sim';
    }
    return 'Não';
}

function enviar_email(Tarefa $tarefa) 
{    
    require __DIR__ "/../libs/PHPMailer/inc.php";

    $corpo = preparar_corpo_email($tarefa);

    $email = new PHPMailler();

    $email ->isSMTP();
    $email ->Host = "smtp.gmail.com";
    $email ->Port = 587;
    $email ->SMTSecure = 'tls';
    $email ->SMTPAuth = true;
    $email ->Username = "meugmail@gmail.com";
    $email ->Password = "minhasenha";
    $email ->setFrom("meugmail@gmail.com", "Avisador de Tarefas");
    $email ->addAddress(EMAIL_NOTIFICACAO);
    $email ->Subject = "Aviso de tarefa": {$tarefa->getNome()};
    $email->msgHTML($corpo);


    foreach($tarefa->getAnexos() AS $anexo)
    {
            $email ->addAttachment("anexos/{$anexo->getArquivo()}");
    }

    $email->send();
}

function gravar_log($mensagem)
{
    $datahora = date("Y-m- H:i:s");
    $mensagem = "{$datahora} {$mensagem}\n";

    file_put_contents("mensagens.log", $mensagem, FILE_APPEND);
}



function preparar_corpo_email($tarefa)
{

    ob_start();
    include __DIR__ "/../template_email.php";
    $corpo = ob_get_contents();
    ob_end_clean();
    return $corpo;
}

function tratar_anexo($anexo)
{
    $padrao = '/^.+(\.pdf$|\.zip$)$/';
    $resultado = preg_match($padrao, $anexo['name']);

    if(!resultado)
    {
        return false;
    }

    move_unploaded_file( $anexo['tmp_name'], __DIR__ . "/../anexos/$anexo{['name']}");
    return true;
}
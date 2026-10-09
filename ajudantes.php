<?php
function traduz_data_para_banco($data)
{
    if ($data == ""){
        return "";
    }

    $dados = explode("/", $data);

    data_branco = "{$dados[2]}-{$dados[1]}-{$dados[0]}" /*dia-2, mês-1 e ano-0 */

    return $data_banco;
}

function traduz_data_para_exibir($data)
{
    if($data == "" OR $data "0000-00-00"){
        return "";
    }

    $objeto_data = DateTime: :creatorFromFormat ('Y-m-d', $data);

    $resultado = '';
    
    if($regiao == 'EUA'){
        $resultado = $objeto_data->format('m/d/Y');
    } else {
        $resultado = $objeto_data->format('d/m/Y');
    }

    return $resultado;
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

<!--Usando os mesmos conceitos que vimos até agora, monte
uma	lista de contatos na qual devem ser cadastrados o nome,
o telefone e o e-mail de cada contato. Continue usando as
sessões	para manter	os	dados. Uma	forma simples	de
resolver este desafio é copiando o arquivo tarefas.php	
para contatos.php, mudar alguns	nomes e	adicionar os
campos necessários-->

<html>
<?php session_start(); ?>

    <head>
        <title> Gerenciador de contatos </title>
    </head>
    <body>
        <h1> Gerenciador de contatos </h1>
    
<form>
    <fieldset>
        <legend> Novo contato </legend>
        <label>
            Nome do contato:
            <input type="text" name="nome"/>
            Número:
            <input type "number" id="numero" name="quantity" min='8' max ='12'>
            E-mail:
            <input id="textInput" class="custom" >
        </label>
        <input type="submit" value="Cadastrar"/>
    </fieldset>
</form>
<?php
    $lista_contatos = [];

    if (array_key_exists('nome', $_GET)){
        $_SESSION['lista_contatos'][] = $_GET['nome'];
        $novo_contato=>
            'nome'=> $_GET['nome']
            'telefone'=> $GET['telefone']
            'email' => $GET['email']
    }
    $lista_contatos = [];

    if (array_key_exists('lista_contatos', $_SESSION)){
        $lista_contatos = $_SESSION['lista_contatos'];
    }
?>
    <table> 
        <tr> 
            <th>Contatos</th>
        </tr>

        <?php foreach ($lista_contatos as $contatos) : ?>
            <tr>
                <td><?php echo $contatos['nome']; ?></td>
                <td><?php echo $contatos['telefone']; ?></td>
                <td><?php echo $contatos['email']; ?></td>
            </tr>
        <?php endforeach; ?>
         </table>
    </body>
</html>
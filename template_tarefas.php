<h1>Tarefa: <?php echo htmlentities($tarefa->getNome()); ?></h1>
  <p><a href="index.php?rota=tarefas"> Voltar para a lista de tarefas</a>.</p>
  <p>
    <strong>Concluída: </strong>
      <?php echo traduz_concluida($tarefa->getConcluida()); ?>
  </p>
  <p>
    <strong>Descrição: </strong>
    <?php echo nl2br(htmlentities($tarefa->getDescricao())); ?>
  <p>
    <strong>Prazo: </strong>
    <?php echo traduz_data_par_exibir($tarefa->getPrazo()); ?>
  </p>
  <p>
    <strong>Prioridade: </strong>
    <?php echo traduz_prioridade($tarefa->getPrioridade()); ?>
  </p>
<h2>Anexos</h2>
<!-- Lista de anexos-->
 <?php if (count($tarefa->getAnexos()) > 0) : ?>
  <table>
    <tr>
      <th>Arquivo</th>
      <th>Opções</th>
    <tr>
    <?php foreach ($tarefa->getAnexos() as $anexo) : ?>
      <tr>
        <td><?php echo htmlentities($anexo->getNome()); ?></td>
        <td>
          <a href="anexos/<?php echo $anexo->getArquivo(); ?>">Download</a>
          <a href = "index.php?rota=remover_anexo&id=<?php echo $anexo->getId(); ?>">Remover</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <?php else : ?>
    <p> Não há anexos para esta tarefa.</p>
  <?php endif; ?>
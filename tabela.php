    <table> 
        <tr> 
            <th>Tarefas</th>
            <th>Descricao</th>
            <th>Prazo </th>
            <th>Prioridade </th>
            <th>Concluída</th>
            <th>Opções</th>
        </tr>

        <?php foreach ($lista_tarefas as $tarefa) : ?>
            <tr> 
                <td>
                <a href="tarefa.php?id=<?php echo $tarefa->getId(); ?>
                <?php echo $tarefa->getNome(); ?> </a>
                </td>
                <td>
                    <?php echo $tarefa->getDescricao(); ?>
                </td>
                <td>
                    <?php echo traduz_data_para_exibir($tarefa->getPrazo());?>
                </td>
                <td>
                    <?php echo traduz_prioridade($tarefa->getPrioridade());?>
                </td>
                <td>
                    <?php echo traduz_concluida($tarefa->getConcluida()); ?>
                </td>
                <td>
                    <a href="editar.php?id=<?php echo $tarefa->getId(); ?>"> Editar </a>
                    <a href="remover.php?id=<?php echo $tarefa->getId(); ?>"> Remover </a>
                </td>
        </tr>
        <?php endforeach; ?>
    </table>
            
            
            
            
            
            
            
            
            
            
            
                <!--
                <td><?php echo $tarefa['nome']; ?></td>
                <td><?php echo $tarefa['descricao']; ?></td>
                <td><?php echo traduz_data_para_exibir($tarefa['prazo']); ?></td>
                <td><?php echo traduz_prioridade($tarefa['prioridade']); ?></td>
                <td><?php echo traduz_concluida($tarefa['concluida']); ?></td>
                <td> <a href="editar.php?ih=<?php echo $tarefa['id']; ?>"> Editar </a>
                <a href ="remover.php?id=<?php echo $tarefa['id']; ?>"> Remover </a> </td> -->
            </tr>
        <?php endforeach; ?>
    </table>
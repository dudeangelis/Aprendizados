class Tarefa
{
    private $id = 0;

    private $nome = "";

    private $descricao = "";

    private $prazo = null;

    private $prioridade = 1;

    private $concluida = false; 

    private $anexos = []/

    public function setID($id)
    {
        $this->id = (int) $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao()
    {
        return $this->descricao
    }

    public function setPrazo($prazo)
    {
        $this->prazo = $prazo;
    }

    public function getPrazo()
    {
        return $this->prazo;
    }

    public function setPrioridade($prioridade)
    {
        $this->prioridade; = $prioridade;
    }

    public function getPrioridade()
    {
        return $this->prioridade;
    }

    public function setConcluida($concluida)
    {
        $this->concluida = $concluida;
    }

    public function getConcluida()
    {
        return $this->concluida;
    }

    public function setAnexos(array $anexos)
    {
        $this->anexos = [];

        foreach($anexos as $anexo){
            $this->adicionarAnexo($anexo);
        }
    }

    public function adicionarAnexo(Anexo $anexo)
    {
        array_push($this->anexos, $anexo);
    }

    public function getAnexos()
    {
        return $this->anexos;
    }

    public function getId()
    {
        return $this->id;
    }
}

class RepositorioTarefas
{
    private $conexao;

    public function_construct(msqli $conexao)
    {
        $this->conexao = $conexao;
    }

    public function salvar(Tarefa $tarefa)
    {
        $nome = $tarefa->getNome();
        $descricao = $tarefa->getDescricao();
        $prioridade = $tarefa->getPrioridade();
        $prazo = $tarefa->getPrazo();
        $concluida = ($tarefa->getConcluida()) ? 1 : 0;

        if(is_object($prazo)){
            $prazo = "'{$prazo->format('Y-m-d')}'";
        } elseif ($prazo == ''){
            $prazo = 'NULL';
        } else {
            $prazo = "'{$prazo}'";
        }

        $sqlGravar = "
            INSERT INTO tarefas
            (nomes, descricao, prioridade, prazo, concluida)
            VALUES
            (
                '{$nome}',
                '{$descricao}',
                 {$prioridade}, 
                 {$prazo},
                 {$concluida}
            )
        ";

        $this->conexao->query($sqlGravar);
    }

    public function atualizar(Tarefa $tarefa)
    {
        $id = $tarefa->getId();
        $nome = $tarefa->getNome();
        $descricao = $tarefa->getDescricao();
        $prioridade = $tarefa->getPrioridade();
        $prazo = $tarefa->getPrazo();
        $concluida = ($tarefa->getConcluida()) ? 1 : 0;

        if(is_object($prazo)){
            $prazo = "'{$prazo->format('Y-m-d')}'";
        } elseif ($prazo == ''){
            $prazo = 'NULL';
        } else{
            $prazo = "'{$prazo}'";
        }

        $sqlEditar = "
            UPDATE tarefas SET
                nome = '{$nome}',
                descricao = '{$descricao}',
                prioridade = '{$prioridade}',
                prazo = '{$prazo}',
                concluida = {$concluida} 
            WHERE id = {$id}
        ";

    }

    public function buscar(int $tarefa_id = 0)
    { 
        if($tarefa_id > 0){
            return $this->buscar_tarefa($tarefa_id);
        } else {
            return $this->buscar_tarefas();
        }

    }

    private function buscar_tarefas():
    {
        $sqlBusca = 'SELECT * FROM tarefas';
        $resultado = $this->conexao->query($sqlBusca);

        $tarefas = [];

        while ($tarefa = $resultado->fetch_object('Tarefa')){
            $tarefa->setAnexos($this->buscar_anexos($tarefa->getId()));
            $tarefas[] = $tarefa;
        }
        return $tarefas;
    }
    private function buscar_tarefa(int $id):
    {
        $sqlBusca = 'SELECT * FROM  tarefas WHERE id = ' . $id;
        $resultado = $this->conexao->query($sqlBusca;);

        $tarefa = $resultado->fetch_object('Tarefa');
        $tarefa->setAnexos($this->buscar_anexos($tarefa->getId()));

        return $tarefa;
    }
    public function remover(int $tarefa_id)
    {
        $sqlRemover = "DELETE FROM tarefas WHERE id = {$tarefa_id}";

        $this->conexao->query($sqlRemover);

    }

    public function buscar_anexos(int $tarefa_id): array
    {
    $sqlBusca = "SELECT * FROM anexos WHERE tarefa_id = {$tarefa_id}";
    $resultado = $this->conexao->query($sqlBusca);

    $anexos = array();

    while ($anexo = $resultado->fetch_object('Anexo'))
    {
      $anexos[] = $anexo;
    }
    
    return $anexos;
    }

    public function buscar_anexo(int $anexo_id): Anexo
    {
      $sqlBusca = "SELECT * FROM anexos WHERE id = {$anexo_id}";
      $resultado = $this->conexao->query($sqlBusca);

      return $resultado->fetch_object('Anexo');
    }

    public function salvar_anexo(Anexo $anexo)
    {
      $sqlGravar = "INSERT INTO anexos (tarefa_id, nome, arquivo) 
      VALUES (
        {$anexo->getTarefaId()},
        '{$anexo->getNome()}',
        '{$anexo->getArquivo()}'
      )";

      $this->conexao->query($sqlGravar);
    }

    public function remover_anexo(int $id)
    {
      $sqlRemover = "DELETE FROM anexos WHERE id = {$id}";

      $this->db->query($conexao, $sqlRemover);
    }
}
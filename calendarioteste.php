<table border="1">
    <tr>
        <th>Dom</th>
        <th>Seg</th>
        <th>Ter</th>
        <th>Qua</th>
        <th>Qui</th>
        <th>Sex</th>
        <th>Sáb</th>
    </tr> 

    <?php echo calendario(); ?>

</table>

<?php 
    function linha($semana) /*Implementa a tabela */
    {
        $linha ='<tr>';

            for ($i = 0; $i <= 6; $i++){
                if (array_key_exists($i, $semana)) {
                    $linha .= "<td> {$semana[$i]} </td>";
                } else {
                    $linha .= "<td></td>";
                }
            }
            
            $linha .= '</tr>';

            return $linha;
        }

    function calendario()
    {   
        $calendario = '';
        $dia = 1;
        $semana = [];

        while ($dia <= 31){
            array_push ($semana, $dia);

            if (count($semana) == 7){
                $calendario .= linha($semana);
                $semana = [];
            }
            
            $dia++;
        } /*Enquanto o dia for menor ou igual a 31, o array push
        vai adicionar um ou mais elementos no final do array existente.
        Se a semana for igual a 7, o calendário recebe uma linha referente à
        semana. Ao final, ainda no while, adiciona um dia com $dia++ */
        $calendario .=linha($semana);
        return $calendario;
    }
?>

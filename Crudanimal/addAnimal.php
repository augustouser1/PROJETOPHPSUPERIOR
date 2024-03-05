<?php
require_once 'init.php';
// pega os dados do formuário
$ID = isset($_POST['selectID']) ? $_POST['selectID'] : null;
$nome = isset($_POST['selectnome']) ? $_POST['selectnome'] : null;
$ID_TIPO = isset($_POST['selectID_TIPO']) ? $_POST['selectID_TIPO'] : null;

// validação (bem simples, só pra evitar dados vazios)
if (empty($ID) || empty($nome) || empty($ID_TIPO))
{
    echo "Volte e preencha todos os campos";
    exit;
}
// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO tarefas(IDVirtualFarm, nome, ID_TIPO) VALUES(:ID, :nome, :ID_TIPO)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':ID', $ID);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':ID_TIPO', $ID_TIPO);

if ($stmt->execute())
{
    header('Location: msgSucesso.html');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
?>
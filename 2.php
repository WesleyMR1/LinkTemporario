<?php

include('Conexao.php');
$pdo = conectar();

date_default_timezone_set("America/Sao_Paulo");

$email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW));

$res = $pdo->prepare("select * from contas where email = :email limit 1");
        $res->bindValue(':email', $email);
        $res->execute();
        $cadastroExistente = $res->fetch(PDO::FETCH_ASSOC);
        //se não existir retornar mensagem
        if (!isset($cadastroExistente['email'])) {
           echo "Não existe";
        }else{

   
    $now = date("d/m/Y H:i:s"); 
    $emailCrip = base64_encode($email);
    $linkCodigo = password_hash(base64_encode($now), PASSWORD_DEFAULT);
    $dataExpirar = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $res = $pdo->query("insert into codigolink values (0,'$linkCodigo','$dataExpirar', '$emailCrip');");
    echo "<a href=\"recuperar.php?linkCodigo=$linkCodigo\">Recuperar Senha</a>";
}
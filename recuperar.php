<?php
    include('Conexao.php');
    $pdo = conectar();

    if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];
        $emailCodigo = base64_decode($codigo);

        $res = $pdo->query("SELECT * from codigolink where codigo = '$codigo' AND data > Now();");
        $resul = $res->fetch(PDO::FETCH_ASSOC);

        if (isset($resul['codigo'])) {
            //
            if (isset($_POST['acao']) && $_POST['acao'] == "mudar") {
                $novaSenha = $_POST['novaSenha'];

                $atualizar = $pdo->query("UPDATE contas set senha = '$novaSenha' where email = '$emailCodigo' ;");
                if ($atualizar) {
                    $pdo->query("DELETE from codigolink where codigo = '$codigo';");
                    echo "Senha modificada!";
                }
            }

?>
    <h1>Digite a senha nova</h1>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="novaSenha">
    
    <input type="hidden" name="acao" value="mudar">

    <input type="submit" name="submit">
</form>


<?PHP
}else {
    echo "<h1>\"Link Expirado\"</h1>";
}
}

?>
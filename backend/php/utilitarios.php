<?php
function limparEntrada($valor)
{
    $valor = trim($valor);

    $valor = htmlspecialchars($valor);

    $valor = stripslashes($valor);

    return $valor;
}

function validarNome($nome)
{
    return !empty($nome) && strlen($nome) <= 30;
}

function redirecionar($url)
{
    header("Location: $url");

    exit();
}

function validarTipo($tipo)
{
    return in_array($tipo, ["1", "2", "3"]);
}

function validarPreco($preco)
{
    return (!empty($preco) && is_numeric($preco) && !strpos($preco, ".") && (float) $preco >= 1 && (float) $preco <= 999.99) || (strpos($preco, ".") && strlen(explode(".", $preco)[1]) <= 2);
}

function efetuarConexaoBanco($servidor, $usuario, $banco, $senha)
{
    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
        error_log("Não foi possível efetuar uma conexão com o banco: " . $e->getMessage(), 0);

        return null;
    }
}

function checarProdutoExiste($pdo, $nome, $tipo)
{
    try {
        $sql = $pdo->prepare("CALL checarProdutoExiste(?, ?)");

        $sql->execute([$nome, $tipo]);

        if ($sql->rowCount() > 0) return true;

        return false;
    } catch (PDOException $e) {
        error_log("Não foi possível checar se o produto existe: " . $e->getMessage(), 0);

        return null;
    }
}

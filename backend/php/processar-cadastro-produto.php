<?php
session_start();

require_once("utilitarios.php");

if (isset($_POST["cadastrar"])) {
    $nome = limparEntrada($_POST["nome"] ?? "");

    $tipo = limparEntrada($_POST["tipo"] ?? "");

    $preco = limparEntrada($_POST["preco"] ?? "");

    $_SESSION["nome"] = $nome;

    $_SESSION["tipo"] = $tipo;

    $_SESSION["preco"] = $preco;

    if (!validarNome($nome)) {
        $_SESSION["mensagem"] = "O nome é obrigatório e deve conter até 30 caracteres.";

        $_SESSION["nome"] = "";

        redirecionar("../index.php");
    }

    if (!validarTipo($tipo)) {
        $_SESSION["mensagem"] = "Selecione uma opção.";

        $_SESSION["tipo"] = "";

        redirecionar("../index.php");
    }

    if (!validarPreco($preco)) {
        $_SESSION["mensagem"] = "O preço é obrigatório e deve ser um número entre 1 e 999,99, com até duas casas decimais.";

        $_SESSION["preco"] = "";

        redirecionar("../index.php");
    }

    unset($_SESSION["nome"]);

    unset($_SESSION["tipo"]);

    unset($_SESSION["preco"]);

    $pdo = efetuarConexaoBanco("localhost", "root", "saborCaseiro", "root1234");

    if ($pdo === null) {
        $_SESSION["mensagem"] = "Não foi possível efetuar uma conexão com o banco.";

        redirecionar("../index.php");
    } else {
        $produtoExiste = checarProdutoExiste($pdo, $nome, $tipo);

        if ($produtoExiste === true) {
            $_SESSION["mensagem"] = "Produto já cadastrado.";

            redirecionar("../index.php");
        } elseif ($produtoExiste === null) {
            $_SESSION["mensagem"] = "Não foi possível checar se o produto existe.";

            redirecionar("../index.php");
        } else {
            try {
                $sql = "CALL cadastrarProduto(?, ?, ?)";

                $sql = $pdo->prepare($sql);

                $sql->execute([$nome, $tipo, $preco]);

                $_SESSION["mensagem"] = "Produto cadastrado com sucesso.";

                redirecionar("../index.php");
            } catch (PDOException $e) {
                error_log("Não foi possível cadastrar o produto: " . $e->getMessage(), 0);

                $_SESSION["mensagem"] = "Não foi possível cadastrar o produto.";

                redirecionar("../index.php");
            }
        }
    }
} else {
    $_SESSION["mensagem"] = "Não foi possível enviar os dados.";

    redirecionar("../index.php");
}

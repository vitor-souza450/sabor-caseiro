<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de cadastro do Sabor Caseiro">
    <meta name="author" content="Vitor Souza">
    <title>Cadastre um Produto - Sabor Caseiro</title>
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="css/principal.css"> -->
    <!-- <link rel="stylesheet" href="css/formularios.css"> -->
    <!-- <link rel="stylesheet" href="css/botoes.css"> -->
    <!-- <link rel="stylesheet" href="css/modais.css"> -->
    <link rel="stylesheet" href="css/principal.min.css">
    <link rel="stylesheet" href="css/formularios.min.css">
    <link rel="stylesheet" href="css/botoes.min.css">
    <link rel="stylesheet" href="css/modais.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- <script type="module" src="javascript/principal.js"></script> -->
    <!-- <script type="module" src="javascript/modais.js"></script> -->
    <!-- <script type="module" src="javascript/index.js"></script> -->
    <script type="module" src="javascript/principal.min.js"></script>
    <script type="module" src="javascript/modais.min.js"></script>
    <script type="module" src="javascript/index.min.js"></script>
    <?php
    if (isset($_SESSION["mensagem"])):
    ?>
        <script type="module">
            import {
                alternarModal
            } from "./javascript/utilitarios.js";

            alternarModal(true, "<?php echo $_SESSION["mensagem"]; ?>");
        </script>
    <?php
        unset($_SESSION["mensagem"]);
    endif;
    ?>
</head>

<body>
    <header>
        <img src="imagens/logotipo.svg" alt="Logotipo do Sabor Caseiro">
        <h1>Sabor Caseiro</h1>
    </header>

    <nav>
        <button type="button" id="botao-menu" class="botao-menu">
            <i class="bi bi-list"></i>
        </button>
        <div id="area-navegacao" class="area-navegacao">
            <ul>
                <li>
                    <a href="editar-produto.html">Editar Produto</a>
                </li>
                <li>
                    <a href="deletar-produto.html">Deletar Produto</a>
                </li>
                <li>
                    <a href="consultar-produtos.html">Consultar Produtos</a>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <h2>Cadastre um Produto</h2>
        <form action="php/processar-cadastro-produto.php" method="POST" id="formulario" novalidate>
            <div class="area-campo">
                <label for="nome">
                    Nome <span class="campo-obrigatorio">*</span>
                </label>
                <input type="text" name="nome" id="nome" class="campo" placeholder="Nome do produto..." value="<?php echo $_SESSION["nome"] ?? ""; ?>"
                    required>
            </div>
            <div class="area-campo">
                <label for="tipo">
                    Tipo <span class="campo-obrigatorio">*</span>
                </label>
                <select name="tipo" id="tipo" class="campo" required>
                    <option value="">Selecione uma opção</option>
                    <option value="1" <?php if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] === "1") echo "selected";?>>Aperitivo</option>
                    <option value="2" <?php if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] === "2") echo "selected";?>>Prato Principal</option>
                    <option value="3" <?php if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] === "3") echo "selected"; ?>>Sobremesa</option>
                </select>
            </div>
            <div class="area-campo">
                <label for="preco">
                    Preço <span class="campo-obrigatorio">*</span>
                </label>
                <input type="number" name="preco" id="preco" class="campo" placeholder="Preço do produto..." value="<?php echo $_SESSION["preco"] ?? ""; ?>" min="1"
                    max="999.99" step=".01" required>
            </div>
            <input type="submit" name="cadastrar" value="Cadastrar" class="botao botao-enviar">
        </form>
    </main>

    <div id="modal" class="modal">
        <section id="conteudo-modal" class="conteudo-modal">
            <h3>Atenção:</h3>
            <p id="mensagem-modal" class="mensagem-modal"></p>
            <button type="button" id="botao-fechar-modal" class="botao botao-fechar-modal">Fechar</button>
        </section>
    </div>

    <footer>
        <p class="copyright">
            &copy; Copyright <span id="copyright">2024</span> by Vitor Souza
        </p>
    </footer>
</body>

</html>
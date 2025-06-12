<?php

session_start();
if (!isset($_SESSION['ID'])) {
    header('Location: ../TelaLogin/Index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Links de Nutrição</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <button class="voltar" onclick="history.back()">↩Voltar</button>
    <div class="container">
        <header>
            <h1>Links Úteis de Nutrição</h1>
        </header>

        <section class="link-section">
            <div class="link-item">
                <h2>Calculadora online - Nutrição</h2>
                <p>Calculadora Tdee para calcular dados corporais.</p>
                <a href="https://calculator-online.net/pt/tdee-calculator/" target="_blank">Visitar site</a>
            </div>

            <div class="link-item">
                <h2>Sociedade Brasileira de Alimentação e Nutrição</h2>
                <p>Artigos e estudos sobre alimentação e nutrição no Brasil.</p>
                <a href="https://www.sban.org.br/" target="_blank">Visitar site</a>
            </div>

            <div class="link-item">
                <h2>Montador de dieta para auxílio</h2>
                <p>Ápos calcular seus dados corporais, monte sua dieta.</p>
                <a href="https://www.eatthismuch.com/" target="_blank">Visitar site</a>
            </div>

            <div class="link-item">
                <h2>Canal sobre musculação e perca de peso</h2>
                <p>Maior canal de dieta e musculação do Brasil e entre uns do mundo, ajudando diáriamente com dicas e conhecimento e humor.</p>
                <a href="https://www.youtube.com/@renatocariani" target="_blank">Visitar site</a>
            </div>
        </section>
    </div>
</body>

</html>
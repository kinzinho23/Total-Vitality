<?php
include ('../TelaLogin/Conexão.php');
session_start();

if (!isset($_SESSION['ID'])) {
    header("Location: ../TelaLogin/login.php");
    exit();
}

$id = $_SESSION['ID']; 

$query = "SELECT nome, idade, peso, altura, genero, urlImage FROM usuarios WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $linha = $result->fetch_assoc();
} else {
    echo "<script>alert('Usuário não encontrado!');</script>";
    header("Location: ../TelaLogin/login.php"); 
    exit();
}

$kilo = (float)$linha['peso'];
$altura = (float)$linha['altura'];
$IMC = $kilo / ($altura * $altura);

$IMCtype = ['Abaixo do peso', 'Normal', 'Sobrepeso', 'Obesidade grau I', 'Obesidade grau II', 'Obesidade grau III'];

if ($IMC <= 18.5) {
    $IMCcategory = $IMCtype[0];
} else if ($IMC <= 24.9) {
    $IMCcategory = $IMCtype[1];
} else if ($IMC <= 29.9) {
    $IMCcategory = $IMCtype[2];
} else if ($IMC <= 34.9) {
    $IMCcategory = $IMCtype[3];
} else if ($IMC <= 39.9) {
    $IMCcategory = $IMCtype[4];
} else if ($IMC > 40.0) {
    $IMCcategory = $IMCtype[5];
} else {
    $IMCcategory = 'Não foi possivel calcular';
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="perfil.css">
    <title>Perfil do Usuário</title>
</head>
<body>
    <div class="profile-container">
      <a href="../TelaDeInicio/Tela.php"><button class="voltar">↩Voltar</button></a>
        <div class="profile-header">
            <figure>
                <img src="<?php echo $linha['urlImage'] ?: '../Imagens/imagemLogo.png'; ?>" alt="Foto do Usuário" class="profile-photo">
            </figure>
            <h1><?php echo htmlspecialchars($linha["nome"]); ?></h1>
            <p>Idade: <?php echo htmlspecialchars($linha["idade"]); ?> anos | Gênero: <?php echo htmlspecialchars($linha["genero"]); ?></p>
        </div>
        <div class="profile-info">
            <h2>Objetivo de Saúde</h2>
            <ul>
                <li>🏋️‍♂️ Perder Peso</li>
                <li>💪 Aumentar Energia</li>
            </ul>
        </div>
        <div class="health-data">
            <h2>Dados de Saúde</h2>
            <p style="font-weight: bold;">Peso:</p><p><?php echo htmlspecialchars($linha["peso"]) . " Kg"; ?></p>
            <p style="font-weight: bold;">Altura:</p><p><?php echo htmlspecialchars($linha["altura"]) . " Metros"; ?></p>
            <p style="font-weight: bold;">IMC:</p><p><?php echo number_format($IMC, 2).' - '. $IMCcategory. '<br>'; ?></p>
        </div>
        <div class="recent-activities">
            <h2>Atividades Recentes</h2>
            <ul>
                <li>Caminhada - 30 min</li>
                <li>Meditação - 15 min</li>
            </ul>
        </div>
        <div class="tips">
            <h2>Dicas Personalizadas</h2>
            <p>- Beba mais água!</p>
            <p>- Faça 30 minutos de exercício diário.</p>
        </div>
        <div class="actions">
            <a href="editPerfil.php" style="
                margin-top: 20px;
                text-align: center;
                background-color: #0041cc;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                margin: 5px;
                cursor: pointer;
                text-decoration: none;">
                Editar Perfil
            </a>
        </div>
    </div>
</body>
</html>

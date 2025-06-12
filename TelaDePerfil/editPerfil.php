<?php
include ('../TelaLogin/Conexão.php');
session_start();

if (isset($_SESSION['ID'])) {
    $id = $_SESSION['ID'];
} else {
    header("Location: ../TelaLogin/index.php");
    exit();
}

if (isset($_POST['submit'])) {
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $nome = $conn->real_escape_string(trim($_POST['name']));
    $idade = (int) $_POST['idade']; 
    $peso = (float) $_POST['peso']; 
    $altura = (float) $_POST['altura'];

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $caminho = null; 
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($extensao, $extensoesPermitidas)) {
            // Gera um nome único para a imagem
            $nomeFoto = uniqid() . '.' . $extensao;
            $caminho = $targetDir . $nomeFoto;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $caminho)) {
                echo "Erro ao mover o arquivo para o diretório de upload.";
                $caminho = null;
            }
        } else {
            echo "Formato de arquivo não suportado. Use: " . implode(', ', $extensoesPermitidas) . ".";
        }
    }

    $query = "UPDATE usuarios SET nome = ?, idade = ?, peso = ?, altura = ?" . ($caminho ? ", urlImage = ?" : "") . " WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        if ($caminho) {
            $stmt->bind_param('siddsi', $nome, $idade, $peso, $altura, $caminho, $id);
        } else {
            $stmt->bind_param('siddi', $nome, $idade, $peso, $altura, $id);
        }
        if ($stmt->execute()) {
            echo "<script>alert('Dados atualizados com sucesso!');</script>";
            header('Location: perfil.php');
            exit();
        } else {
            echo "Erro ao atualizar os dados: " . $stmt->error;
        }
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}

$query = "SELECT nome, idade, peso, altura, urlImage FROM usuarios WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$linha = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Perfil</title>
</head>

<body>
    <div class="container">
        <h1>Editar Perfil</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="profile-pic">
                <img id="profileImage"
                    src="<?php echo htmlspecialchars($linha['urlImage'] ?: 'default-profile.png'); ?>"
                    alt="Foto de Perfil">
                <input type="file" name="image" accept="image/*">
                <label for="fileInput">Alterar Foto</label>
            </div>

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($linha['nome']); ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" value="<?php echo htmlspecialchars($linha['idade']); ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="peso">Peso (kg):</label>
                <input type="number" step="0.01" id="peso" name="peso"
                    value="<?php echo htmlspecialchars($linha['peso']); ?>" required>
            </div>

            <div class="form-group">
                <label for="altura">Altura (cm):</label>
                <input type="number" step="0.01" id="altura" name="altura"
                    value="<?php echo htmlspecialchars($linha['altura']); ?>" required>
            </div>

            <div class="buttons">
                <button type="submit" name="submit">Salvar Alterações</button>
                <button type="button" onclick="window.location.href='perfil.php'">Cancelar</button>
            </div>
        </form>
    </div>
</body>

</html>
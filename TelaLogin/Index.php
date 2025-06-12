<?php
include ('Conexão.php');
session_start(); 

// Inicia o buffer de saída para garantir que o redirecionamento funcione corretamente
ob_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login/Cadastro</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="cadastro">
            <?php
            if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
                $nome = $_POST["nome"];
                $email = $_POST["email"];
                $senha = md5($_POST["senha"]);
            
                $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");

                if ($stmt) {
                    $stmt->bind_param('sss', $nome, $email, $senha);
            
                    if ($stmt->execute()) {
                        $_SESSION['ID'] = $stmt->insert_id;
            
                        header("Location: ../TelaQuestionario/questionario.php");
                        exit();
                    } else {
                        echo "Erro ao inserir o registro: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Erro ao preparar a consulta: " . $conn->error;
                }
            }
            
            ?>
            <form method="POST" name="form1">
                <label for="chk" aria-hidden="true">Cadastro</label>
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit">Cadastrar</button>
            </form>
        </div>

        <div class="login">
            <?php
            if (isset($_POST['loginEmail']) && isset($_POST['loginSenha'])) {
                $email = trim($_POST['loginEmail']);
                $senha = md5(trim($_POST['loginSenha']));

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $stmt = $conn->prepare("SELECT ID FROM usuarios WHERE email = ? AND senha = ?");
                    $stmt->bind_param('ss', $email, $senha);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $user = $result->fetch_assoc();
                        
                        $_SESSION['ID'] = $user['ID'];

                        header("Location: ../TelaDeInicio/Tela.php");
                        exit();
                    } else {
                        echo "<script>alert('E-mail ou senha incorretos!');</script>";
                    }

                    $stmt->close();
                } else {
                    echo "<script>alert('Por favor, insira um e-mail válido.');</script>";
                }
            }
            ?>
            <form method="POST" name="login">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="loginEmail" placeholder="Email" required>
                <input type="password" name="loginSenha" placeholder="Senha" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
ob_end_flush();
?>

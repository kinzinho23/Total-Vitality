<?php
include('../TelaLogin/Conexão.php');
session_start();

if (!isset($_SESSION['ID'])) {
  header('Location: ../TelaLogin/Index.php');
  exit;
} else {

  $id_usuario = $_SESSION['ID'];

  try {
    // Consulta para buscar os dados atuais do usuário
    $query_select = "SELECT kcalTotais, kcalConsumidas, proteina, carboidrato, gordura, kcalRestantes FROM usuarios WHERE ID = ?";
    $stmt_select = $conn->prepare($query_select);
    $stmt_select->bind_param('i', $id_usuario);
    $stmt_select->execute();
    $stmt_select->bind_result($kcalTotais_atual, $nova_kcalConsumidas, $nova_proteina, $novo_carboidrato, $nova_gordura, $caloriasRestantes);

    if ($stmt_select->fetch()) {
      $stmt_select->close();

      $kcalTotais_atual = intval($kcalTotais_atual);
      $nova_kcalConsumidas = intval($nova_kcalConsumidas);
      $nova_proteina = intval($nova_proteina);
      $novo_carboidrato = intval($novo_carboidrato);
      $nova_gordura = intval($nova_gordura);
    } else {
      echo "Erro: Nenhum dado encontrado para o usuário!";
    }
  } catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
  }
}

$kcalTotais = 0;
$kcalConsumidas = 0;
$proteina = 0;
$carboidrato = 0;
$gordura = 0;
$kcalRestantes = 0;

if (isset($_POST['kcalConsumidas'])) {
  $TotalCalorias = intval($_POST['kcalTotal']);
  $CaloriasConsumidas = intval($_POST['kcalConsumidas']);
  $Proteina_form = intval($_POST['Proteina']);
  $Carboidrato_form = intval($_POST['Carboidrato']);
  $Gordura_form = intval($_POST['Gordura']);
  $id_usuario = $_SESSION['ID'];

  try {
    $query_select = "SELECT kcalTotais, kcalConsumidas, proteina, carboidrato, gordura FROM usuarios WHERE ID = ?";
    $stmt_select = $conn->prepare($query_select);
    $stmt_select->bind_param('i', $id_usuario);
    $stmt_select->execute();
    $stmt_select->bind_result($kcalTotais_atual, $nova_kcalConsumidas, $Proteina_atual, $Carboidrato_atual, $Gordura_atual);

    if ($stmt_select->fetch()) {
      $stmt_select->close();

      $kcalTotais_atual = intval($kcalTotais_atual);
      $nova_kcalConsumidas = intval($nova_kcalConsumidas);
      $nova_proteina = intval($nova_proteina);
      $novo_carboidrato = intval($novo_carboidrato);
      $nova_gordura = intval($nova_gordura);

      if ($kcalTotais_atual == 0) {
        $kcalTotais_atual = $TotalCalorias;
      }

      $nova_kcalConsumidas =  $nova_kcalConsumidas + $CaloriasConsumidas;
      $caloriasRestantes = $kcalTotais_atual - $nova_kcalConsumidas;

      if ($caloriasRestantes < 0) {
        echo "Atenção: as calorias restantes ficaram negativas. Verifique a lógica de cálculo.<br>";
      }

      if ($nova_proteina = 0 && $novo_carboidrato = 0 && $nova_gordura = 0) {
        $nova_proteina =  $Proteina_form;
        $novo_carboidrato = $Carboidrato_form;
        $nova_gordura = $Gordura_form;
      } else {
        $nova_proteina = $Proteina_atual + $Proteina_form;
        $novo_carboidrato = $Carboidrato_atual + $Carboidrato_form;
        $nova_gordura = $Gordura_atual + $Gordura_form;
      }

      // Query para atualizar os dados do usuário
      $query_update = "
              UPDATE usuarios 
              SET 
                  kcalTotais = ?, 
                  kcalConsumidas = ?, 
                  proteina = ?, 
                  carboidrato = ?, 
                  gordura = ?, 
                  kcalRestantes = ?
              WHERE ID = ?
          ";

      $stmt_update = $conn->prepare($query_update);
      $stmt_update->bind_param(
        'iiiiiii',
        $kcalTotais_atual,
        $nova_kcalConsumidas,
        $nova_proteina,
        $novo_carboidrato,
        $nova_gordura,
        $caloriasRestantes,
        $id_usuario
      );

      if ($stmt_update->execute()) {
       header("Location: TelaDados.php");
      } else {
        echo "Erro ao atualizar os dados: " . $stmt_update->error;
      }
    } else {
      echo "Erro: Nenhum dado encontrado para o usuário!";
    }
  } catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
  }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="TelaDados.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <style>
    .cups {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .cup {
      width: 25px;
      height: 35px;
      background-color: #e0f7fa;
      border: 2px solid #007BFF;
      border-radius: 10px;
      position: relative;
      transition: background-color 0.3s ease;
    }

    input[type="radio"] {
      display: none;
    }

    input[type="radio"]:checked+.cup {
      background-color: #007BFF;
      border-color: #0056b3;
    }

    .cup::before {
      content: "";
      display: block;
      width: 100%;
      height: 20px;
      background-color: #fff;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      position: absolute;
      top: -10px;
      left: 0;
    }
  </style>

  <title>Total Vitality</title>
</head>

<body>
  <header>
    <div class="container">
      <a href="../TelaDeInicio/Tela.php" style="text-decoration:none;">
        <div class="logo">
          <img src="imagemLogo.png" style="border-radius: 25px" alt="Total Vitality Logo" />
      </a>
      <a href="../TelaDeInicio/Tela.php" style="text-decoration:none;">
        <h1 style="color: white;">Total Vitality</h1>
      </a>
    </div>
    <div class="sidebar">
        <ul class="point-off" style="display: flex; flex-direction: column; margin: 3px;">
          <li>
            <a href="../TelaDeInicio/Tela.php" class="bar-off"><i class="fa fa-home"></i>INICIO</a>
          </li>
          <br>
          <li>
            <a href="../TelaDeNutrição/Nutrição.php" class="bar-off"><i class="fa fa-cutlery"></i>NUTRIÇÃO</a>
          </li>
          <br>
          <li>
          <a href="../TelaFitness/Fitness.php" class="bar-off"><i class="fa fa-heart"></i>FITNESS</a>
          </li>
          <br>
          <li>
            <a href="../TelaDeDados/TelaDados.php" class="bar-off"><i class="fa fa-line-chart"></i>BEM-ESTAR</a>
          </li>
          <br>
          <li>
           <a href="../TelaDePerfil/perfil.php" class="bar-off"><i class="fa fa-user"></i>PERFIL</a>
          </li>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <li>
            <a href="../Logout.php" class="bar-off"><i class="fa fa-sign-out"></i>LOGOUT</a>
          </li>
        </ul>
      </div>
    <button class="menu-button">
      <h2>&#9776;</h2>
    </button>
    </div>
  </header>
  <div id="div1" style="z-index: 1;">
    <div class="w3-light-blue w3-round-xlarge"
      style="position: relative; width:80%; height: 20px; left:90px; top: 40px;">
      <div class="w3-container w3-round-xlarge w3-blue" style="width:50%; height: 20px;"></div>
    </div>
    <h1 style="position: relative; left: 13%; top: 15%; color: white;">Meta do dia</h1>
    <h1 style="position: relative; left: 15%; top: 15%; color: white; font-weight: bold; ">
      <?php echo $kcalTotais_atual ?> kcal</h1>
    <h1 style="position: relative; left: 45%; top: -130px; color: white; font-size: 100px; font-weight: bold;">|
    </h1>
    <h1 style="position: relative; left: 54%; top: -129%; color: white;">Carboidratos restantes</h1>
    <h1 style="position: relative; left: 66%; top: -140%; color: white; font-weight: bold; ">
      <?php echo $caloriasRestantes ?> kcal</h1>
    <h3 style="position: relative; left: 61%; top: -150%; color: white;">(<?php echo $nova_kcalConsumidas ?> kcal
      consumidos)</h3>
  </div>
  <div id="div2" style="z-index: -5; ">
    <h3 style="color: white; position: relative; left: 25%; top: 10%; font-weight: bold;">Gráfico de macronutrientes
    </h3>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      google.charts.load("current", {
        packages: ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ["Element", "Numero", {
            role: "style"
          }],
          ["Gordura", <?php echo $nova_gordura ?>, "#0068D0"],
          ["Carboidrato", <?php echo  $novo_carboidrato ?>, "#0480d4"],
          ["Proteína", <?php echo $nova_proteina ?>, "#0068D0"],
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
          {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
          },
          2
        ]);

        var options = {
          title: "",
          width: 800,
          height: 600,
          backgroundColor: 'transparent',
          bar: {
            groupWidth: "90%"
          },
          legend: {
            position: "none"
          },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
      }
    </script>
    <div id="columnchart_values" style="width: 900px; height: 300px; position:relative; left: -19%;"></div>
  </div>
  <div id="div3" style="z-index: -2;">

    <div class="divExp">
      <h2 style="color: white; position: relative; left: 135px; top: 10px;
             ">DICAS:</h2>
      <ol style="color: white; position: relative; left: 10px; top: -10px;
             font-size: 20px;">
        <li>Lembre-se de se Hidratar;
        <li>
          Evite o consumo excessivo de álcool e pare de fumar
        <li>Mantenha uma alimentação balanceada;</li>
        <li>Pratique atividade física regularmente;</li>
        <li>Tenha uma boa noite de sono.</li>
      </ol>
    </div>
    <h2 style="color: white; position: relative; left: 60px; top: -25px;
            ">Dados Alimentares</h2>
    <form method="POST" style=" 
    position: relative;
    display: flex;
    flex-direction: column;
    width: 320px;
    left: 25px;
    top: -30px;
">
      <label class="labelForm" for="kcalTotal">Calorias Totais:</label>
      <input type="number" class="input" id="kcalTotal" name="kcalTotal" placeholder="Ex: 2000">

      <label class="labelForm" for="kcalConsumidas">Calorias Consumidas:</label>
      <input type="number" class="input" id="kcalConsumidas" name="kcalConsumidas" placeholder="Ex: 1500">

      <label class="labelForm" for="Proteina">Proteína:</label>
      <input type="number" class="input" id="Proteina" name="Proteina" placeholder="Ex: 10">

      <label class="labelForm" for="Carboidrato">Carboidrato:</label>
      <input type="number" class="input" id="Carboidrato" name="Carboidrato" placeholder="Ex: 10">

      <label class="labelForm" for="Gordura">Gordura:</label>
      <input type="number" class="input" id="Gordura" name="Gordura" placeholder="Ex: 10">

      <button type="submit" class="btnForm" name="submit2.0">Enviar</button>
    </form>

  </div>

  <div id="div4" style="z-index: 7;">
    <h2 style="color: white; position: relative; left: 10%; top: 20px; font-weight: bold;">Consumo de Água</h2>

    <form id="water-form" style="position: relative; top: 40px;">
      <div id="quantiaDeAgua">
        <h5 class="contagem">0</h5>
        <h5 class="contagem">/8</h5>
      </div>
      <div class="cups">
        <label>
          <input type="radio" name="water" value="1">
          <div class="cup"></div>
        </label>
        <label>
          <input type="radio" name="water" value="2">
          <div class="cup"></div>
        </label>
        <label>
          <input type="radio" name="water" value="3">
          <div class="cup"></div>
        </label>
        <label>
          <input type="radio" name="water" value="4">
          <div class="cup"></div>
        </label>
        <label>
          <input type="radio" name="water" value="5">
          <div class="cup"></div>
        </label>
        <label>
          <input type="radio" name="water" value="6">
          <div class="cup"></div>
        </label>
        <label>
          <input type="radio" name="water" value="7">
          <div class="cup"></div>
        </label>
        <label>
          <input type="radio" name="water" value="8">
          <div class="cup"></div>
        </label>
        <input type="submit" class="btnWater" value="Enviar">
      </div>
    </form>
  </div>

  <script>
    document.getElementById('water-form').addEventListener('submit', function(event) {
      event.preventDefault();

      const selectedRadio = document.querySelector('input[name="water"]:checked');
      if (selectedRadio) {

        const selectedValue = selectedRadio.value;

        document.querySelector('.contagem').textContent = selectedValue;
      } else {
        document.querySelector('.contagem').textContent = "0";
        alert("Por favor, selecione uma opção!");
      }
    });
  </script>

  </div>
  <div id="div5" style="z-index: -3;">
    <h2 style="color: white; position: relative; left: 16%; top: 20px; font-weight: bold;">Consumo diário<h2>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load('current', {
            'packages': ['corechart']
          });
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Task', 'Hours per Day'],
              ['Proteína', <?php echo $nova_proteina ?>],
              ['Gordura', <?php echo $nova_gordura ?>],
              ['Carboidrato', <?php echo $novo_carboidrato ?>],

            ]);

            var options = {
              title: '',
              width: 400,
              height: 400,
              backgroundColor: 'transparent',
              legend: {
                position: "none"
              },
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
          }
        </script>


        <div id="piechart"
          style="width: 900px; height: 500px; position:relative; left: -14%; top:-50px; z-index: 2;"></div>

  </div>
  <footer style="z-index: -4;">
    <div class="container">
      <p>© 2024 Total Vitality. Todos os direitos reservados.</p>
      <ul>
        <li><a href="#">Facebook</a></li>
        <li><a href="#">Instagram</a></li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">LinkedIn</a></li>
      </ul>
      <ul>
        <li><a href="#">123-456-7890</a></li>
        <li><a href="#">info@TotalVitality.com</a></li>
        <li><a href="#">123 SP, São Paulo BR</a></li>
      </ul>
    </div>
  </footer>

  <script>
    const menuButton = document.querySelector(".menu-button");
    const sidebar = document.querySelector(".sidebar");

    menuButton.addEventListener("click", () => {
      sidebar.classList.toggle("open");
    });
  </script>
  <script src="script.js"></script>
</body>

</html>
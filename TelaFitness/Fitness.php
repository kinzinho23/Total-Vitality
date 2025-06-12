<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fitness.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Fitness</title>
</head>
<body>
<header>
    <div class="container">
      <a href="../TelaDeInicio/Tela.php" style="text-decoration:none;">
        <div class="logo">
          <img
            src="imagemLogo.png"
            style="border-radius: 25px"
            alt="Total Vitality Logo" />
      </a>
      <a href="../TelaDeInicio/Tela.php" style="text-decoration:none;">
        <h1 style="color: white;">Total Vitality</h1>
      </a>
      <div class="sidebar">
        <ul class="point-off">
          <li>
            <a href="../TelaDeInicio/Tela.php" class="bar-off"><i class="fa fa-home"></i>INICIO</a>
          </li>
          <br />
          <li>
            <a href="../TelaDeNutrição/Nutrição.php" class="bar-off"><i class="fa fa-cutlery"></i>NUTRIÇÃO</a>
          </li>
          <br />
          <li>
          <a href="../TelaFitness/Fitness.php" class="bar-off"><i class="fa fa-heart"></i>FITNESS</a>
          </li>
          <br />
          <li>
            <a href="../TelaDeDados/TelaDados.php" class="bar-off"><i class="fa fa-line-chart"></i>BEM-ESTAR</a>
          </li>
          <br />
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
<div class="container">
        <section id="dicas" class="section">
            <h2>Dicas de Treino</h2>
            <p style="color: white;">Aprenda como maximizar seus resultados com as melhores práticas de treino. Dicas para aquecimento, alongamento e técnicas de exercícios para evitar lesões e otimizar seu desempenho.</p>
        </section>
        <section id="treinos" class="section">
            <h2>Treinos Específicos</h2>
            <label for="objetivo" style="color: white;">Selecione seu objetivo:</label>
            <select id="objetivo">
                <option value="">-- Escolha um objetivo --</option>
                <option value="perdaPeso">Perda de Peso</option>
                <option value="ganhoMassa">Ganho de Massa</option>
                <option value="definicao">Definição</option>
                <option value="bemEstar">Bem-estar Geral</option>
            </select>
            <div id="treinos-especificos" class="hidden">
                <h3 style="color: white;">Treinos sugeridos:</h3>
                <div id="lista-treinos"></div>
                <div id="cronograma-semanal" class="hidden">
                    <h3 style="color: white;">Cronograma Semanal</h3>
                    <table id="cronograma-table">
                        <thead>
                            <tr>
                                <th>Dia</th>
                                <th>Exercício</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </section>
        <section id="personalizado" class="section">
            <h2>Monte seu Treino Personalizado</h2>
            <form action="salvar_treino.php" method="POST">
                <label for="exercicio" style="color: white;">Exercício:</label>
                <input type="text" id="exercicio" name="exercicio" placeholder="Exemplo: Supino, Corrida, etc." required>

                <label for="series" style="color: white;">Quantidade de Séries:</label>
                <input type="text" id="series" name="series" min="1" placeholder="Número de séries" required>

                <label for="dias" style="color: white;">Dias da Semana:</label>
                <select id="dias" name="dias[]" multiple required>
                    <option value="Segunda">Segunda-feira</option>
                    <option value="Terça">Terça-feira</option>
                    <option value="Quarta">Quarta-feira</option>
                    <option value="Quinta">Quinta-feira</option>
                    <option value="Sexta">Sexta-feira</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                </select>

                <button type="submit">Salvar Treino</button>
            </form>
            <form action="listar_treino.php">
            <button type="submit">Ver Meu Treino</button>
            </form>
        </section>
    </div>
    <footer>
        <p>&copy; 2024 Total Vitality. Todos os direitos reservados.</p>
    </footer>
    <script>
        const treinos = {
            perdaPeso: {
                exercicios: [
                    { nome: "Treino HIIT", imagem: "OIP.jpg", descricao: "20 minutos de alta intensidade" },
                    { nome: "Corrida leve", imagem: "corridaLeve.jpg", descricao: "30 minutos de corrida" },
                    { nome: "Circuito Funcional", imagem: "circuito.jpg", descricao: "Treino com peso corporal" }
                ],
                cronograma: [
                    { dia: "Segunda:", exercicio: " HIIT (20 min)" },
                    { dia: "Terça:", exercicio: " Corrida leve (30 min)" },
                    { dia: "Quarta:", exercicio: " Circuito Funcional" },
                    { dia: "Quinta:", exercicio: " Corrida leve" },
                    { dia: "Sexta:", exercicio: " HIIT Intensivo" }
                ]
            },
            ganhoMassa: {
                exercicios: [
                    { nome: "Supino", imagem: "supino.jpg", descricao: "Treino de força (3 séries de 8-12 repetições)" },
                    { nome: "Levantamento Terra", imagem: "terra.jpg", descricao: "Fortalecimento de costas e pernas" },
                    { nome: "Agachamento", imagem: "agachamento.jpg", descricao: "Treino de pernas e glúteos" }
                ],
                cronograma: [
                    { dia: "Segunda:", exercicio: " Supino + Agachamento" },
                    { dia: "Terça:", exercicio: " Levantamento Terra + Bíceps" },
                    { dia: "Quarta:", exercicio: " Descanso ou caminhada leve" }
                ]
            },
            definicao: {
                exercicios: [
                    { nome: "Abdominais", imagem: "abdominal.jpg", descricao: "Treino de definição abdominal" },
                    { nome: "Flexões", imagem: "flexao.jpg", descricao: "Fortalecimento do peitoral" }
                ],
                cronograma: [
                    { dia: "Segunda:", exercicio: " Flexões" },
                    { dia: "Quarta:", exercicio: " Abdominais" }
                ]
            },
            bemEstar: {
                exercicios: [
                    { nome: "Alongamento Matinal", imagem: "alongamento.jpg", descricao: "10 minutos para relaxar" },
                    { nome: "Ioga Básica", imagem: "yoga.jpg", descricao: "Posições simples para bem-estar" }
                ],
                cronograma: [
                    { dia: "Segunda:", exercicio: " Alongamento Matinal" },
                    { dia: "Terça:", exercicio: " Ioga Básica" },
                    { dia: "Quinta:", exercicio: " Alongamento Relaxante" }
                ]
            }
        };

        const objetivoSelect = document.getElementById("objetivo");
        const treinosEspecificos = document.getElementById("treinos-especificos");
        const listaTreinos = document.getElementById("lista-treinos");
        const cronogramaSemanal = document.getElementById("cronograma-semanal");
        const cronogramaTableBody = document.querySelector("#cronograma-table tbody");

        objetivoSelect.addEventListener("change", function () {
            const objetivo = objetivoSelect.value;
            listaTreinos.innerHTML = ""; // Limpa lista de exercícios
            cronogramaTableBody.innerHTML = ""; // Limpa cronograma
            if (objetivo && treinos[objetivo]) {
                // Adiciona exercícios
                treinos[objetivo].exercicios.forEach(exercicio => {
                    const div = document.createElement("div");
                    div.innerHTML = `
                        <h4 style="color: white;">${exercicio.nome}</h4>
                        <img src="${exercicio.imagem}" alt="${exercicio.nome}" style="height: 200px; width: 300px;">
                        <p style="color: white;">${exercicio.descricao}</p>
                    `;
                    listaTreinos.appendChild(div);
                });

                // Adiciona cronograma
                treinos[objetivo].cronograma.forEach(crono => {
                    const row = document.createElement("tr");
                    row.innerHTML = `<td style="color: white;">${crono.dia}</td><td style="color: white;">${crono.exercicio}</td>`;
                    cronogramaTableBody.appendChild(row);
                });

                treinosEspecificos.classList.remove("hidden");
                cronogramaSemanal.classList.remove("hidden");
            } else {
                treinosEspecificos.classList.add("hidden");
            }
        });
    const menuButton = document.querySelector(".menu-button");
    const sidebar = document.querySelector(".sidebar");

    menuButton.addEventListener("click", () => {
      sidebar.classList.toggle("open");
    });
  </script>
</body>
</html>
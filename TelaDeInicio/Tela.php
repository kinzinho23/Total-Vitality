<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="telaInicial.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <title>Total Vitality</title>
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
            <a href="Tela.php" class="bar-off"><i class="fa fa-home"></i>INICIO</a>
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
  <section class="hero">
    <div class="container">
      <h2></h2>
      <h3></h3>
      <!--<p>
          Descubra uma pessoa mais saudável e feliz com nossa orientação e
          suporte especializado
        </p>!-->
    </div>
  </section>
  <section class="features">
    <div class="container">
      <h2>O que você vai achar aqui</h2>
      <div class="feature">
        <img src="dieta&alimentação.jpeg" alt="Dieta e alimentação" />
        <h4>Dieta e Alimentação</h4>
        <p>
          A alimentação é um dos pilares fundamentais para a saúde e o
          bem-estar do ser humano. Ela é responsável por fornecer os
          nutrientes necessários para o funcionamento adequado do nosso corpo,
          garantindo energia, crescimento e manutenção das funções vitais.
        </p>
      </div>
      <div class="feature">
        <img
          src="dieta&orientação.jpeg"
          alt="Nutrition & Wellness Coaching" />
        <h4>Dicas e Orientações</h4>
        <p>
          As dietas são planos alimentares que visam melhorar a saúde, perder
          peso ou atingir objetivos relacionados à alimentação. Para ter
          sucesso, é importante seguir orientações nutricionais específicas,
          como balancear a ingestão de nutrientes, evitar alimentos
          processados, aumentar a ingestão de alimentos ricos em fibras e
          proteínas, manter-se hidratado e praticar atividade física
          regularmente. Consultar um nutricionista para personalizar o plano
          alimentar é essencial. Uma dieta equilibrada e saudável traz
          diversos benefícios à saúde e qualidade de vida.
        </p>
      </div>
      <div class="feature">
        <img src="exercicios&dicas.jpeg" alt="Fitness & Exercise Programs" />
        <h4>Programas de Exercicios</h4>
        <p>
          Praticar exercícios regularmente é essencial para manter a saúde e o
          bem-estar do corpo. Os treinos ajudam a fortalecer os músculos,
          aumentar a resistência física e melhorar a saúde cardiovascular.
          Além disso, a prática de atividades físicas também contribui para a
          redução do estresse, melhora a qualidade do sono e aumenta a
          autoestima. Encontre uma atividade que goste e se comprometa a
          praticá-la com regularidade, respeitando os limites do seu corpo e
          buscando orientação profissional para a realização dos exercícios de
          forma segura e eficaz.
        </p>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>© 2024 Total Vitality. Todos os direitos reservados.</p>
      <ul>
        <li><a href="#">Facebook</a></li>
        <li><a href="#">Instagram</a></li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">LinkedIn</a></li>
      </ul>
      <p>
        <a href="#">123-456-7890</a>
        <a href="#">info@TotalVitality.com</a>
        <a href="#">*** ** **, Birigui BRA</a>
      </p>
    </div>
  </footer>
  <script>
    const menuButton = document.querySelector(".menu-button");
    const sidebar = document.querySelector(".sidebar");

    menuButton.addEventListener("click", () => {
      sidebar.classList.toggle("open");
    });
  </script>
</body>

</html>
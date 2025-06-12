// Pegar todos os botões de rádio
const radios = document.querySelectorAll('input[name="water"]');
const cups = document.querySelectorAll('.cup');  // Pegar todos os elementos visuais dos copos
const resultDiv = document.getElementById('result');


radios.forEach((radio, index) => {
    radio.addEventListener('mousedown', (event) => {
        // Se o rádio já estiver marcado, prevenimos o comportamento padrão para desmarcar
        if (radio.checked) {
            event.preventDefault(); // Previne que o rádio seja marcado novamente
            radio.checked = false; // Desmarca o rádio

            // Desmarcar todos os copos
            cups.forEach((cup) => {
                cup.style.backgroundColor = '#e0f7fa'; // Copos vazios
                cup.style.borderColor = '#007BFF';
            });
        }
    });

    radio.addEventListener('change', () => {
        const valor = radio.value;

        // Preencher os copos até o selecionado
        cups.forEach((cup, cupIndex) => {
            if (cupIndex < index + 1) {
                cup.style.backgroundColor = '#007BFF'; // Copos preenchidos
                cup.style.borderColor = '#0056b3';
            } else {
                cup.style.backgroundColor = '#e0f7fa'; // Copos vazios
                cup.style.borderColor = '#007BFF';
            }
        });
    });
});

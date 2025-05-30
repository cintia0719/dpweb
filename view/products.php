<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efecto Matrix con HOLA</title>
    <style>
        body {
            background-color: #000; /* Fondo negro */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Ocupa toda la altura de la ventana */
            margin: 0;
            overflow: hidden; /* Evita barras de desplazamiento */
            font-family: 'Consolas', 'Monospace', sans-serif; /* Fuente tecnológica */
        }

        .matrix-text {
            color: #0F0; /* Verde Matrix */
            font-size: 5em; /* Tamaño grande de la fuente */
            text-shadow: 0 0 10px #0F0; /* Sombra para el efecto de brillo */
            position: relative;
            animation: glitch 1.5s infinite alternate; /* Animación de glitch */
        }

        /* Animación de Glitch para un efecto más "Matrix" */
        @keyframes glitch {
            0% {
                transform: translate(0);
            }
            20% {
                transform: translate(-2px, 2px);
            }
            40% {
                transform: translate(-2px, -2px);
            }
            60% {
                transform: translate(2px, 2px);
            }
            80% {
                transform: translate(2px, -2px);
            }
            100% {
                transform: translate(0);
            }
        }

        /* Opcional: un efecto de "lluvia" de caracteres de fondo */
        .matrix-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1; /* Envía al fondo */
            pointer-events: none; /* No interfiere con el ratón */
            color: #aaa; /* Verde más oscuro para el fondo */
            font-size: 1.2em;
            line-height: 1.2em;
            opacity: 0.5;
        }

        .matrix-column {
            position: absolute;
            white-space: pre; /* Mantiene los saltos de línea */
            animation: fall 5s linear infinite; /* Animación de caída */
        }

        @keyframes fall {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(100vh);
            }
        }
    </style>
</head>
<body>

    <div class="matrix-text">HOLA</div>

    <div class="matrix-background" id="matrix-bg"></div>

    <script>
        const bg = document.getElementById('matrix-bg');
        const chars = '0123456789ABCDEFHIJKLMNOPQRSTUVWXYZ'; // Caracteres para la lluvia
        const numColumns = Math.floor(window.innerWidth / 20); // Ajusta según el tamaño de la fuente

        for (let i = 0; i < numColumns; i++) {
            const column = document.createElement('span');
            column.className = 'matrix-column';
            column.style.left = `${i * 20}px`; // Espaciado entre columnas
            column.style.animationDelay = `-${Math.random() * 5}s`; // Retraso aleatorio para la caída

            let columnContent = '';
            for (let j = 0; j < 50; j++) { // Altura de cada columna
                columnContent += chars.charAt(Math.floor(Math.random() * chars.length)) + '\n';
            }
            column.textContent = columnContent;
            bg.appendChild(column);
        }
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOLA MUNDO Matrix</title>
    <style>
        body {
            margin: 0;
            overflow: hidden; /* Evita barras de desplazamiento */
            background-color: #000; /* Fondo negro */
            font-family: 'Consolas', 'Monospace', sans-serif; /* Fuente tecnológica */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Ocupa toda la altura de la ventana */
            position: relative; /* Para posicionar el texto encima de la lluvia */
        }

        /* Estilo para la lluvia de caracteres de fondo */
        .matrix-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0; /* Asegura que esté en el fondo */
            pointer-events: none; /* No interfiere con el ratón */
            color: palevioletred; /* Verde más oscuro para la lluvia */
            font-size: 1em; /* Tamaño de los caracteres de la lluvia */
            line-height: 1em; /* Espaciado entre líneas de la lluvia */
            opacity: 0.7;
        }

        .matrix-column {
            position: absolute;
            white-space: pre; /* Mantiene los saltos de línea */
            animation: fall 5s linear infinite; /* Animación de caída */
        }

        /* Animación para la caída de los caracteres */
        @keyframes fall {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(100vh); /* Cae hasta el final de la pantalla */
            }
        }

        /* Estilo para el texto "HOLA MUNDO" principal */
        .main-text {
            position: relative;
            z-index: 1; /* Asegura que esté por encima de la lluvia */
            color: #0F0; /* Verde brillante para el texto principal */
            font-size: 8vw; /* Tamaño del texto responsivo (8% del ancho del viewport) */
            text-align: center;
            text-shadow: 0 0 20px #0F0, 0 0 30px #0F0; /* Doble sombra para más brillo */
            animation: text-glitch 2s infinite alternate, pulse 1.5s infinite alternate; /* Animaciones combinadas */
            padding: 20px; /* Pequeño padding para asegurar visibilidad */
            box-sizing: border-box; /* Incluye padding en el ancho/alto */
            white-space: nowrap; /* Evita que el texto se rompa en varias líneas */
        }

        /* Animación de glitch para el texto "HOLA MUNDO" */
        @keyframes text-glitch {
            0% { transform: translate(0); opacity: 1; }
            25% { transform: translate(-5px, 5px); opacity: 0.8; }
            50% { transform: translate(5px, -5px); opacity: 1; }
            75% { transform: translate(-5px, -5px); opacity: 0.8; }
            100% { transform: translate(0); opacity: 1; }
        }

        /* Animación de pulso para el texto "HOLA MUNDO" */
        @keyframes pulse {
            0% { filter: brightness(1); }
            100% { filter: brightness(1.5); }
        }

        /* Media queries para ajustar el tamaño del texto en pantallas más pequeñas */
        @media (max-width: 768px) {
            .main-text {
                font-size: 12vw; /* Más grande en móviles para que se vea bien */
            }
        }
    </style>
</head>
<body>

    <div class="matrix-background" id="matrix-bg"></div>

    <div class="main-text">HOLA MUNDO</div>

    <script>
        const matrixBg = document.getElementById('matrix-bg');
        // Caracteres para la lluvia (letras, números y símbolos de Matrix)
        const matrixChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>/?`~';
        const fontSize = 15; // Tamaño de la fuente de los caracteres de la lluvia en píxeles
        let columns = Math.floor(window.innerWidth / fontSize); // Calcula cuántas columnas caben

        // Función para generar un carácter aleatorio de Matrix
        function getRandomChar() {
            return matrixChars.charAt(Math.floor(Math.random() * matrixChars.length));
        }

        // Crear las columnas de la lluvia
        for (let i = 0; i < columns; i++) {
            const column = document.createElement('span');
            column.className = 'matrix-column';
            column.style.left = `${i * fontSize}px`; // Posición de la columna
            column.style.animationDelay = `-${Math.random() * 5}s`; // Retraso aleatorio para el inicio de la caída
            column.style.animationDuration = `${5 + Math.random() * 3}s`; // Duración aleatoria de la caída

            let columnContent = '';
            // Generar una secuencia larga de caracteres para la columna
            for (let j = 0; j < Math.ceil(window.innerHeight / fontSize) * 2; j++) {
                columnContent += getRandomChar() + '\n';
            }
            column.textContent = columnContent;
            matrixBg.appendChild(column);
        }

        // Función para actualizar los caracteres de la lluvia (opcional, para mayor dinamismo)
        // setInterval(() => {
        //     const allColumns = document.querySelectorAll('.matrix-column');
        //     allColumns.forEach(col => {
        //         let newContent = '';
        //         for (let j = 0; j < col.textContent.length / 2; j++) { // Actualiza la mitad para ahorrar rendimiento
        //             newContent += getRandomChar() + '\n';
        //         }
        //         col.textContent = newContent + col.textContent.substring(newContent.length);
        //     });
        // }, 100); // Actualiza cada 100ms
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOLA MUNDO Matrix Interactivo</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background-color: #000; /* Fondo negro */
            font-family: 'Consolas', 'Monospace', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            cursor: crosshair; /* Cursor para indicar interactividad */
        }

        /* El canvas ocupa toda la pantalla para el efecto de lluvia */
        canvas {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0; /* Capa inferior */
        }

        /* Estilo para el texto "HOLA MUNDO" principal */
        .main-text {
            position: relative;
            z-index: 1; /* Por encima del canvas */
            color: #0F0; /* Verde brillante */
            font-size: 8vw; /* Tamaño responsivo */
            text-align: center;
            text-shadow: 0 0 20px #0F0, 0 0 30px #0F0; /* Brillo */
            animation: text-glitch 2s infinite alternate, pulse 1.5s infinite alternate; /* Animaciones */
            padding: 20px;
            box-sizing: border-box;
            white-space: nowrap;
            /* Asegura que el texto sea "clicable" también */
            pointer-events: none; /* Hace que el texto no bloquee los clics para el canvas */
        }

        /* Animación de glitch para el texto "HOLA MUNDO" */
        @keyframes text-glitch {
            0% { transform: translate(0); opacity: 1; }
            25% { transform: translate(-5px, 5px); opacity: 0.8; }
            50% { transform: translate(5px, -5px); opacity: 1; }
            75% { transform: translate(-5px, -5px); opacity: 0.8; }
            100% { transform: translate(0); opacity: 1; }
        }

        /* Animación de pulso para el texto "HOLA MUNDO" */
        @keyframes pulse {
            0% { filter: brightness(1); }
            100% { filter: brightness(1.5); }
        }

        /* Media queries para ajustar el tamaño del texto en pantallas más pequeñas */
        @media (max-width: 768px) {
            .main-text {
                font-size: 12vw;
            }
        }
    </style>
</head>
<body>

    <canvas id="matrixCanvas"></canvas>

    <div class="main-text">HOLA MUNDO</div>

    <script>
        const canvas = document.getElementById('matrixCanvas');
        const ctx = canvas.getContext('2d'); // Obtenemos el contexto de dibujo 2D

        // Ajustar el tamaño del canvas al de la ventana
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        // Listener para redimensionar el canvas si la ventana cambia de tamaño
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            columns = Math.floor(canvas.width / fontSize);
            // Reiniciar las "gotas" o columnas para que se ajusten al nuevo tamaño
            drops = Array(columns).fill(0);
        });

        
        // Array para mantener la posición de la "lluvia" en cada columna
        let drops = [];
        for (let i = 0; i < columns; i++) {
            drops[i] = 1; // La posición inicial de la "gota" en cada columna
        }

        // --- Función principal de dibujo de Matrix ---
        function drawMatrix() {
            // Fondo ligeramente transparente para el rastro de los caracteres
            ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = '#0F0'; // Color verde brillante para los caracteres
            ctx.font = `${fontSize}px monospace`; // Establece la fuente

            for (let i = 0; i < drops.length; i++) {
                // Obtener un carácter aleatorio
                const text = matrixChars.charAt(Math.floor(Math.random() * matrixChars.length));

                // Dibujar el carácter en la posición actual de la "gota"
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);

                // Si la "gota" ha llegado al final de la pantalla
                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    drops[i] = 0; // Reiniciarla en la parte superior
                }

                // Mover la "gota" hacia abajo
                drops[i]++;
            }
        }

        // Ejecutar el dibujo de Matrix en un bucle continuo
        setInterval(drawMatrix, 33); // Aproximadamente 30 fotogramas por segundo

        // --- Manejar la interacción (clic/toque) ---
        canvas.addEventListener('click', (event) => {
            // Calcular la columna más cercana al clic
            const clickedColumn = Math.floor(event.clientX / fontSize);

            // "Reiniciar" varias gotas en la columna clicada y sus adyacentes
            for (let i = -5; i <= 5; i++) { // Afecta 11 columnas alrededor del clic
                const colToAffect = clickedColumn + i;
                if (colToAffect >= 0 && colToAffect < columns) {
                    drops[colToAffect] = 0; // Reinicia la gota en la parte superior
                }
            }

            // Opcional: Un efecto visual de "shockwave" o "splash"
            // Puedes añadir aquí un círculo que se expanda, por ejemplo.
            // Para simplicidad, solo reiniciamos la lluvia.
        });

        // --- Ajustar el canvas cuando la ventana cambia de tamaño ---
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            // Recalcular columnas si el tamaño de la ventana cambia
            columns = canvas.width / fontSize;
            drops = [];
            for (let i = 0; i < columns; i++) {
                drops[i] = 1;
            }
        });
    </script>

</body>
</html>

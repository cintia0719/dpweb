<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Encanto</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background: #fff4fa;
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #b94fb9;
            margin-bottom: 40px;
            text-shadow: 0 0 6px rgba(185, 79, 185, 0.3);
        }

        .productos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            justify-content: center;
            align-items: stretch;
        }

        .producto {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(185, 79, 185, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .producto:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(185, 79, 185, 0.35);
        }

        .descuento {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ff66b3;
            color: white;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .producto img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-bottom: 1px solid #f2d1f2;
            transition: transform 0.4s ease;
        }

        .producto img:hover {
            transform: scale(1.05);
        }

        .info {
            padding: 15px;
            text-align: center;
        }

        .info h3 {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 5px;
        }

        .info p {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .precio {
            font-size: 1.2rem;
            color: #b94fb9;
            font-weight: 600;
        }

        .precio span {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9rem;
            margin-left: 5px;
        }

        .botones {
            display: flex;
            justify-content: space-around;
            padding: 10px 15px 20px;
        }

        .botones button {
            border: none;
            padding: 8px 14px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-ver {
            background: #e9b8f9;
            color: #fff;
        }

        .btn-ver:hover {
            background: #d184e2;
        }

        .btn-agregar {
            background: #b94fb9;
            color: #fff;
        }

        .btn-agregar:hover {
            background: #9d3d9d;
        }
    </style>
</head>
<body>

<h1>Librería Encanto </h1>

<div class="productos">
    <?php
    // Ejemplo de datos (en tu sistema vendrán de la base de datos)
    $libros = [
        ["titulo" => "Sigue mi voz", "autor" => "Ariana Godoy", "precio" => 49.90, "anterior" => 89.90, "descuento" => "", "imagen" => "https://i.pinimg.com/736x/e7/14/73/e714737a37dbf6b7f1823dc6ad0319c7.jpg"],
        ["titulo" => "Nosotros en Luna", "autor" => "Alice Kellen", "precio" => 39.90, "anterior" => 79.90, "descuento" => "", "imagen" => "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgLfN6FELLEAf5z5oG8ogkV1n5x4DVmwz9mboFU_K339ptdBiiTd9AAuGc8if_vBYWqKCIczUwk25SyJUi-sTE9m2U1-F9McrCEhfSVAJnP2rmoxZOza3t5a-UH1BhXQhpxuqHX-lIxGk3Z/s1600/nosotrosenlaluna.jpg"],
        ["titulo" => "El arte de ser nosotros", "autor" => "Inma Rubiales", "precio" => 54.90, "anterior" => 99.90, "descuento" => "", "imagen" => "https://dam.elcorteingles.es/producto/www-001006539587912-10.jpg?impolicy=Resize&width=1200&height=1200"],
        ["titulo" => "Harry Potter", "autor" => "J.K.Rowling", "precio" => 54.90, "anterior" => 99.90, "descuento" => "", "imagen" => "https://i.pinimg.com/564x/18/5e/b9/185eb936e25004249d73298323a27257.jpg"]
    ];

    foreach ($libros as $l): ?>
        <div class="producto">
            <div class="descuento"><?= $l['descuento']; ?></div>
            <img src="<?= $l['imagen']; ?>" alt="<?= $l['titulo']; ?>">
            <div class="info">
                <h3><?= $l['titulo']; ?></h3>
                <p>Autor/a: <?= $l['autor']; ?></p>
                <div class="precio">S/ <?= number_format($l['precio'], 2); ?>
                    <span>S/ <?= number_format($l['anterior'], 2); ?></span>
                </div>
            </div>
            <div class="botones">
                <button class="btn-ver" onclick="verLibro('<?= $l['titulo']; ?>')">Ver libro</button>
                <button class="btn-agregar" onclick="agregarCarrito('<?= $l['titulo']; ?>')">Agregar</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
function verLibro(titulo) {
    alert(" Ver detalles de: " + titulo);
}

function agregarCarrito(titulo) {
    alert("'" + titulo + "' agregado al carrito.");
}
</script>

</body>
</html>

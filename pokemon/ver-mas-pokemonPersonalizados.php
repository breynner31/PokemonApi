<?php
// Incluir archivo de conexión a la base de datos
include_once("database.php");

// Crear instancia de la clase Database y conectarse
$database = new Database();
$conn = $database->connect();

try {
    // Configurar el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener todos los registros de la tabla 'pokemons'
    $sql = "SELECT * FROM pokemons";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Almacenar los resultados en un array asociativo
    $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Mostrar mensaje de error si ocurre una excepción
    echo "Error de conexión: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pokémon</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <h2>Pokemones Personalizados</h2>
    <button class="add-pokemon-button" onclick="window.location.href='pokemons-personalizados.php'">Añadir Pokémon</button>
    
    <div class="container">
        <?php
        if (!empty($pokemons)) {
            foreach ($pokemons as $pokemon) {
                echo "<div class='pokemon-card'>";
                if ($pokemon["foto_pokemon"]) {
                    $imagen_base64 = base64_encode($pokemon["foto_pokemon"]);
                    echo "<img src='data:image/jpeg;base64," . $imagen_base64 . "' alt='" . htmlspecialchars($pokemon['name']) . "'>";
                } else {
                    echo "<img src='default-image.jpg' alt='No image available'>";
                }
                echo "<h3>" . htmlspecialchars($pokemon['name']) . "</h3>";
                echo "<p>" . htmlspecialchars($pokemon['tipo_pokemon']) . "</p>";
                echo "<p>" . htmlspecialchars($pokemon['tipo2_pokemon']) . "</p>";
                echo "<form action='form-editar.php' method='get'>";
                echo "<input type='hidden' name='id' value='" . $pokemon['id'] . "'>";
                echo "<button type='submit'>Editar</button>"; 
                echo "</form>";
                // Formulario de eliminación
                echo "<form action='eliminar-pokemon.php' method='post' onsubmit='return confirm(\"¿Estás seguro de que quieres eliminar a " . htmlspecialchars($pokemon['name']) . "?\");'>";
                echo "<input type='hidden' name='id' value='" . $pokemon['id'] . "'>";
                echo "<button type='submit'>Eliminar</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>No se encontraron Pokémon.</p>";
        }
        ?>
    </div>
</body>
</html>

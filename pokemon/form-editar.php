<?php
// Incluir archivo de conexión a la base de datos
include_once("database.php");

// Verificar si se ha proporcionado un ID de Pokémon válido en la URL
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pokemon_id = $_GET['id'];

    // Crear instancia de la clase Database y conectarse
    $database = new Database();
    $conn = $database->connect();

    try {
        // Consulta SQL para obtener los datos del Pokémon con el ID proporcionado
        $sql = "SELECT * FROM pokemons WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$pokemon_id]);
        $pokemon = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un Pokémon con el ID proporcionado
        if ($pokemon) {
            // Mostrar el formulario de edición con los datos del Pokémon
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon</title>
    <link rel="stylesheet" href="css/style4.css">
</head>
<body>
    <div class="container">
        <div class="edit-form">
            <h2>Editar Pokémon</h2>
            <form action="editar-pokemon.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $pokemon['id']; ?>">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($pokemon['name']); ?>" required>
                <label for="tipo_pokemon">Tipo de Pokémon:</label>
                <input type="text" name="tipo_pokemon" id="tipo_pokemon" value="<?php echo htmlspecialchars($pokemon['tipo_pokemon']); ?>" required>
                <label for="tipo2_pokemon">Segundo Tipo de Pokémon:</label>
                <input type="text" name="tipo2_pokemon" id="tipo2_pokemon" value="<?php echo htmlspecialchars($pokemon['tipo2_pokemon']); ?>">
                <label for="foto_pokemon">Imagen del Pokémon:</label>
                <?php if ($pokemon['foto_pokemon']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($pokemon['foto_pokemon']); ?>" alt="Imagen del Pokémon">
                <?php else: ?>
                    <p>No hay imagen disponible</p>
                <?php endif; ?>
                <input type="file" name="foto_pokemon" id="foto_pokemon">
                <!-- Agrega más campos para otros atributos del Pokémon -->
                <input type="submit" value="Guardar Cambios">
            </form>
        </div>
    </div>
</body>
</html>
<?php
            exit; // Salir del script después de mostrar el formulario
        } else {
            // Mostrar un mensaje de error si no se encontró ningún Pokémon con el ID proporcionado
            echo "No se encontró ningún Pokémon con el ID proporcionado.";
        }
    } catch (PDOException $e) {
        // Mostrar mensaje de error si ocurre una excepción
        echo "Error de conexión: " . $e->getMessage();
    }
} else {
    // Mostrar un mensaje de error si no se proporcionó un ID de Pokémon válido en la URL
    echo "ID de Pokémon no válido.";
}
?>

<?php
// Verificar si se han enviado datos por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han proporcionado todos los datos necesarios
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['tipo_pokemon'])) {
        // Obtener los datos del formulario
        $pokemon_id = $_POST['id'];
        $name = $_POST['name'];
        $tipo_pokemon = $_POST['tipo_pokemon'];
        $tipo2_pokemon = isset($_POST['tipo2_pokemon']) ? $_POST['tipo2_pokemon'] : null; // Tipo2 puede ser opcional

        // Procesar la imagen si se ha proporcionado
        if (isset($_FILES['foto_pokemon']) && $_FILES['foto_pokemon']['error'] === UPLOAD_ERR_OK) {
            $foto_tmp = $_FILES['foto_pokemon']['tmp_name'];
            // Leer el contenido del archivo de imagen y convertirlo en binario
            $foto_pokemon = file_get_contents($foto_tmp);
        } else {
            // Si no se proporcionó una nueva imagen, mantener la imagen existente en la base de datos
            $foto_pokemon = null;
        }

        // Conectar a la base de datos
        include_once("database.php");
        $database = new Database();
        $conn = $database->connect();

        try {
            // Preparar la consulta SQL para actualizar el registro del Pokémon
            $sql = "UPDATE pokemons SET name = ?, tipo_pokemon = ?, tipo2_pokemon = ?, foto_pokemon = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta con los nuevos valores
            $stmt->execute([$name, $tipo_pokemon, $tipo2_pokemon, $foto_pokemon, $pokemon_id]);

            // Redirigir a la página de éxito
            echo '<script>alert("Información del pokemon actualizada exitosamente"); window.location ="ver-mas-pokemonPersonalizados.php";</script>';

            exit();
        } catch (PDOException $e) {
            // Mostrar mensaje de error en caso de fallo
            echo "Error al actualizar el Pokémon: " . $e->getMessage();
        }

        // Cerrar la conexión a la base de datos
        $conn = null;
    } else {
        echo "Todos los datos requeridos no fueron proporcionados.";
    }
} else {
    echo "Este script solo puede ser accedido a través del método POST.";
}
?>

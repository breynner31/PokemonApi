<?php
// Verificar si se ha enviado un ID de Pokémon para eliminar
if(isset($_POST['id']) && is_numeric($_POST['id'])) {
    $pokemon_id = $_POST['id'];

    // Incluir archivo de conexión a la base de datos
    include_once("database.php");

    // Crear instancia de la clase Database y conectarse
    $database = new Database();
    $conn = $database->connect();

    try {
        // Preparar la consulta SQL para eliminar el Pokémon con el ID proporcionado
        $sql = "DELETE FROM pokemons WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Ejecutar la consulta para eliminar el Pokémon
        $stmt->execute([$pokemon_id]);

        // Redirigir de vuelta a la página de lista de Pokémon después de eliminar
        header("Location: ver-mas-pokemonPersonalizados.php");
        exit();
    } catch (PDOException $e) {
        // Mostrar mensaje de error en caso de fallo
        echo "Error al eliminar el Pokémon: " . $e->getMessage();
    }
} else {
    // Si no se proporcionó un ID válido, mostrar un mensaje de error
    echo "ID de Pokémon no válido.";
}
?>

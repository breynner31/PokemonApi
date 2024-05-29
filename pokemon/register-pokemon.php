<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $tipo_pokemon = isset($_POST['tipo_pokemon']) ? $_POST['tipo_pokemon'] : '';
    $tipo2_pokemon = isset($_POST['tipo2_pokemon']) ? $_POST['tipo2_pokemon'] : '';

    if (isset($_FILES['foto_pokemon']) && $_FILES['foto_pokemon']['error'] == 0) {
        $foto_tmp = file_get_contents($_FILES['foto_pokemon']['tmp_name']);
    } else {
        $foto_tmp = null;
    }

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=pokemon", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();

        $query_pokemon = "INSERT INTO pokemons (name, tipo_pokemon, tipo2_pokemon, foto_pokemon) VALUES (?,?,?,?)";
        $stmt_pokemon = $pdo->prepare($query_pokemon);
        $stmt_pokemon->bindParam(1, $name);
        $stmt_pokemon->bindParam(2, $tipo_pokemon);
        $stmt_pokemon->bindParam(3, $tipo2_pokemon);
        $stmt_pokemon->bindParam(4, $foto_tmp, PDO::PARAM_LOB);
        $stmt_pokemon->execute();

        $pdo->commit();
        echo '<script>alert("Pokemon registrado exitosamente"); window.location ="pokemons-personalizados.php";</script>';

    } catch (PDOException $e) {
        $pdo->rollBack();
        echo '<script>alert("Error al registrar el pokemon: ' . $e->getMessage() . '"); window.location ="pokemons-personalizados.php";</script>';
    }

} else {
    echo '<script>alert("No se ha enviado el formulario correctamente."); window.location ="pokemons-personalizados.php";</script>';
}
?>

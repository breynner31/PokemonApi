<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            color: #555;
        }
        input[type=text], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type=file] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ffffff;
            border-radius: 5px;
        }

        input[type=submit] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type=submit]:hover {
            background-color: #0056b3;
        }
        .file-input-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .file-input-container input[type=file] {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
            cursor: pointer;
            height: 100%;
            width: 100%;
        }
        .file-input-label {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
        }
        .file-input-label:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro de Pokemons Personalizados</h2>
        <form action="register-pokemon.php" method="post" enctype="multipart/form-data">
            <label for="name">Nombre del pokemon</label>
            <input type="text" id="name" name="name" required placeholder="Escriba el nombre de tu pokemon">

            <label for="type"> 1 Tipo de Pokemon</label>
            <select id="type" name="tipo_pokemon" required>
                <option value="Acero">Acero</option>
                <option value="Agua">Agua</option>
                <option value="Bicho">Bicho</option>
                <option value="Dragón">Dragón</option>
                <option value="Elécasma">Fantasma</option>
                <option value="Fuegtrico">Eléctrico</option>
                <option value="Fanto">Fuego</option>
                <option value="Hada">Hada</option>
                <option value="Hielo">Hielo</option>
                <option value="Lucha">Lucha</option>
                <option value="Normal">Normal</option>
                <option value="Planta">Planta</option>
                <option value="Psíquico">Psíquico</option>
                <option value="Roca">Roca</option>
                <option value="Siniestro">Siniestro</option>
                <option value="Tierra">Tierra</option>
                <option value="Veneno">Veneno</option>
                <option value="Volador">Volador</option>
               
                
            </select>

            <label for="type"> 2 Tipos de Pokemon </label>
            <select id="type" name="tipo2_pokemon" required>
                <option value="ninguno">ninguno</option>
                <option value="Acero">Acero</option>
                <option value="Agua">Agua</option>
                <option value="Bicho">Bicho</option>
                <option value="Dragón">Dragón</option>
                <option value="Eléctrico">Eléctrico</option>
                <option value="Fantasma">Fantasma</option>
                <option value="Fuego">Fuego</option>
                <option value="Hada">Hada</option>
                <option value="Hielo">Hielo</option>
                <option value="Lucha">Lucha</option>
                <option value="Normal">Normal</option>
                <option value="Planta">Planta</option>
                <option value="Psíquico">Psíquico</option>
                <option value="Roca">Roca</option>
                <option value="Siniestro">Siniestro</option>
                <option value="Tierra">Tierra</option>
                <option value="Veneno">Veneno</option>
                <option value="Volador">Volador</option>
               
                
            </select>


            <div class="form-group">
                <label for="foto">Foto del Pokemon </label>

                <input type="file" id="foto" name="foto_pokemon" required >
            </div>

            <input type="submit" value="Registrar">
        </form>
    </div>
</body>
</html>

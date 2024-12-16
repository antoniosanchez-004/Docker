<?php
$dsn = 'mysql:host=db;dbname=nombres;charset=utf8';
$username = 'root';
$password = 'root';

// try {
//     // Conectar a la base de datos usando PDO
//     $conn = new PDO($dsn, $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Obtener correos de la base de datos
//     $stmt = $conn->query("SELECT nombre FROM users");
//     $nombres = $stmt->fetchAll(PDO::FETCH_COLUMN);

//     if ($nombres) {
//         foreach ($nombres as $nombre) {
//             echo $nombre;
//         }
        
//     } else {
//         echo "No se encontraron nombres en la base de datos.";
//     }
// } catch (PDOException $e) {
//     echo "Error de conexión: " . $e->getMessage();
// }
?>

<style>
   body {
    font-family: 'Roboto', sans-serif;
    background-color: #f7f7f7;
    color: #333;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    max-width: 60%;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 5%;
    margin-bottom: 3%;
}

.text-center {
    color: #db4b4b;
    text-align: center;
    margin-bottom: 20px;
    font-size: 2em;
    letter-spacing: 1px;
    font-weight: 700;
}

.form {
    max-width: 60%;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 20px;
    position: relative;
}

.form-control {
    width: 100%;
    padding: 15px 10px;
    font-size: 1.1em;
    border-radius: 5px;
    border: 1px solid #ccc;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #db4b4b;
    box-shadow: 0 0 8px rgba(219, 75, 75, 0.2);
}

.btn {
    background-color: #db4b4b;
    border: none;
    padding: 15px;
    width: 100%;
    font-size: 1.2em;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #bf3f3f;
}

.btn-block {
    margin-top: 10px;
}
</style>

<div class='container'>
    <div class='form'>
        <form  action=" " id="form" class="validate" method="POST">
            <h2 class='text-center'>Nombres</h2>
            <div class='form-group'>
                <input type='text' class='form-control' name='nombre' placeholder='Nombre' required='required'>
            </div>
            <div class='form-group'>
                <button type='submit' name='submit' class='btn btn-primary btn-block' id="guardar">Guardar</button>
            </div>
            <div class='form-group'>
                <button type='submit' name='submit' class='btn btn-primary btn-block' id="todos">Traer Todos Nombres</button>
            </div>
        </form>
        <div id="lista">

        </div>
    </div>
</div>

<script src="nombres.js"></script>

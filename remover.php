<?php

include 'global\templates\cabecera.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Gerente </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        h1 {
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button.btn-primary {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button.btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1></h1>
    <form action="remover_crud.php" method="post" enctype="multipart/form-data">

        <label> Nombre del articulo </label>
        <input type="text" name="nombre" required>


        <button class="btn btn-primary" name="añadirdb" value="Agregar" type="submit">
            Remover Articulo
        </button>
    </form>
</body>
</html>

<?php
$hash = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (!empty($password)) {
        // Hashear la contraseña
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasher de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="submit"] {
            padding: 10px;
            width: 100%;
            max-width: 300px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1>Hashear Contraseña</h1>
    <form method="POST" action="">
        <label for="password">Contraseña:</label>
        <input type="text" id="password" name="password" required>
        <input type="submit" value="Hashear">
    </form>

    <?php if ($hash): ?>
        <h2>Hash Resultante:</h2>
        <p><?php echo htmlspecialchars($hash); ?></p>
    <?php endif; ?>
</body>
</html>

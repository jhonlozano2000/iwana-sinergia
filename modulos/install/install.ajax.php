<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';

    switch ($accion) {
        case 'create_db':
            // Datos de conexión
            $host = isset($_POST['host']) ? $_POST['host'] : '';
            $rootUser = isset($_POST['usernamePrivilegios']) ? $_POST['usernamePrivilegios'] : ''; // Usuario con privilegios suficientes para crear bases de datos y usuarios
            $rootPassword = isset($_POST['passwordPrivilegios']) ? $_POST['passwordPrivilegios'] : ''; // Contraseña del usuario root
            $databaseName = isset($_POST['dbnameIwana']) ? $_POST['dbnameIwana'] : '';
            $newUser = isset($_POST['userIwana']) ? $_POST['userIwana'] : '';
            $newPassword = isset($_POST['passwordIwana']) ? $_POST['passwordIwana'] : '';

            // Crear conexión
            $conn = new mysqli($host, $rootUser, $rootPassword);

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
                exit();
            }

            // Crear la base de datos
            $sql = "CREATE DATABASE IF NOT EXISTS $databaseName CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            if (!$conn->query($sql) === TRUE) {
                /* echo "Base de datos creada exitosamente.\n";
            } else { */
                die("Error al crear la base de datos: " . $conn->error);
                exit();
            }

            // Crear el usuario y otorgar permisos
            $sql = "CREATE USER IF NOT EXISTS '$newUser'@'$host' IDENTIFIED BY '$newPassword';";
            $sql .= "GRANT ALL PRIVILEGES ON $databaseName.* TO '$newUser'@'$host';";
            $sql .= "FLUSH PRIVILEGES;";
            if (!$conn->multi_query($sql)) {
                // echo "Usuario creado y privilegios otorgados exitosamente.\n";
                // Limpiar los resultados pendientes del multi_query
                die("Error al crear el usuario o asignar permisos: " . $conn->error);
                exit();
            } else {
                while ($conn->more_results() && $conn->next_result()) {
                }
            }

            // Cerrar la conexión
            $conn->close();

            // Importar el archivo .sql
            $estructuraSqlPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . 'bd_iwana.sql'); // Uso de DIRECTORY_SEPARATOR y realpath

            if ($estructuraSqlPath === false) {
                die("No se pudo encontrar el archivo estructura.sql.\n");
            }

            // Escapar la ruta si es Windows
            if (DIRECTORY_SEPARATOR === '\\') {
                $estructuraSqlPath = '"' . $estructuraSqlPath . '"';
            }

            $command = "mysql -u $newUser -p$newPassword $databaseName < $estructuraSqlPath 2>&1";
            $output = [];
            $return_var = NULL;
            exec($command, $output, $return_var);

            if ($return_var != 0) {
                echo "Error al importar la estructura de la base de datos.\n";
                echo "Detalles del error:\n";
                echo implode("\n", $output);
                echo $estructuraSqlPath;
                exit();
            }

            // Editar el archivo de conexión
            $filePath = '../../config/class.Conexion.php'; // Ruta al archivo de conexión en la misma carpeta
            $fileContents = file_get_contents($filePath);

            // Reemplazar los valores de las propiedades usando expresiones regulares
            $fileContents = str_replace('iwana_localhost', $host, $fileContents);
            $fileContents = str_replace('iwana_db', $databaseName, $fileContents);
            $fileContents = str_replace('iwana_user', $newUser, $fileContents);
            $fileContents = str_replace('iwana_password', $newPassword, $fileContents);

            // Guardar los cambios en el archivo
            $result = file_put_contents($filePath, $fileContents);

            // Verificar si los cambios fueron guardados correctamente
            if ($result === false) {
                echo "Error al actualizar el archivo de conexión.\n";
                exit();
            }

            echo 1;
            exit();
            break;
        default:
            echo "No hay acción para realizar";
            exit();
            break;
    }
}

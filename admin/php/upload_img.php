<?php
error_log(print_r($_FILES, true));
session_start();
// Directorio donde se almacenarán las imágenes
$upload_dir = "../images/";
$host = $_SESSION['dominio'];

// Comprobar si la petición incluye el archivo
if (isset($_FILES['upload'])) {
    // Información del archivo
    $file_name = $_FILES['upload']['name'];
    $file_tmp_name = $_FILES['upload']['tmp_name'];
    $file_error = $_FILES['upload']['error'];

    // Generar un nombre único para evitar colisiones
    $unique_file_name = uniqid() . "_" . $file_name;

    // Comprobar si se produjo un error al cargar el archivo
    if ($file_error === 0) {
        // Mover el archivo a la carpeta de imágenes
        if (move_uploaded_file($file_tmp_name, $upload_dir . $unique_file_name)) {
            // Preparar la respuesta
            $response = [
                "uploaded" => 1,
                "fileName" => $unique_file_name,
                "url" => $host . 'images/' . $unique_file_name
            ];
        } else {
            // Error al mover el archivo
            $response = [
                "uploaded" => 0,
                "error" => ["message" => "No se pudo mover el archivo a la carpeta de destino"]
            ];
        }
    } else {
        // Error al cargar el archivo
        $response = [
            "uploaded" => 0,
            "error" => ["message" => "Se produjo un error al cargar el archivo"]
        ];
    }

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
} else {
    // No se cargó ningún archivo
    $response = [
        "uploaded" => 0,
        "error" => ["message" => "No se cargó ningún archivo"]
    ];
    echo json_encode($response);
}
?>

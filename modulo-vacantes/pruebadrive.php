<?php

require_once __DIR__ . '/vendor/autoload.php'; // Ruta a tu archivo de autoload de Composer
use Google\Client as Google_Client;  // Importa el Cliente de Google con un alias
use Google\Service\Drive as Google_Service_Drive;  // Importa la clase correcta para el servicio de Google Drive
use Google\Service\Drive\DriveFile as Google_Service_Drive_DriveFile;

// Configura las credenciales desde el archivo .env
$client = new Google_Client();
$client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
$client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
$client->setAccessToken(json_decode(env('GOOGLE_DRIVE_REFRESH_TOKEN'), true));
$client->addScope(Google_Service_Drive::DRIVE);

// Autentica el cliente
$service = new Google_Service_Drive($client);

// Sube un archivo de prueba
$fileMetadata = new Google_Service_Drive_DriveFile([
    'name' => 'Archivo de Prueba',
    'parents' => [env('GOOGLE_DRIVE_FOLDER_ID')],
]);

$content = 'Contenido de prueba';
$file = $service->files->create($fileMetadata, [
    'data' => $content,
    'mimeType' => 'text/plain',
    'uploadType' => 'multipart',
]);

// Imprime el enlace al archivo subido
echo 'Archivo subido con éxito. Enlace: ' . $file->webViewLink;

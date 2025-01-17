<?php
$configPath = __DIR__ . '/config.json';
if (!file_exists($configPath)) {
    die("Configuration file not found.");
}

$config = json_decode(file_get_contents($configPath), true);
if ($config === null) {
    die("Error decoding configuration file.");
}

$host = $config['database']['host'] ?? null;
$username = $config['database']['username'] ?? null;
$password = $config['database']['password'] ?? null;
$dbname = $config['database']['dbname'] ?? null;

if ($host === null || $username === null || $password === null || $dbname === null) {
    die("Database configuration is incomplete.");
}

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
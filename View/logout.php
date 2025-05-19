<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Crud\Presentation\Controller\LogoutUsuarioController;

$controller = new LogoutUsuarioController();
$controller->handle();

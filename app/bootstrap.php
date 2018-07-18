<?php

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

//$configurator->setDebugMode('23.75.345.200'); // enable for your remote IP
$configurator->enableTracy(__DIR__ . '/../log');

$configurator->setTimeZone('Europe/Prague');
$configurator->setTempDirectory(__DIR__ . '/../temp');

$loader = $configurator->createRobotLoader();

$loader->addDirectory(__DIR__);
$loader->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

$files = scandir(__DIR__ . '/../vendor/absolute.app');

foreach ($files as $file)
{
  if ($file == "." || $file == "..")
    continue;

  if (is_dir(__DIR__ . '/../vendor/absolute.app/' . $file) && file_exists(__DIR__ . '/../vendor/absolute.app/' . $file . '/config/config.neon'))
    $configurator->addConfig(__DIR__ . '/../vendor/absolute.app/' . $file . '/config/config.neon');
}

$container = $configurator->createContainer();

return $container;

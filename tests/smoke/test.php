<?php

require __DIR__ . '/../../vendor/autoload.php';

use Francodacosta\Supervisord\Loader\ArrayLoader;
use Francodacosta\Supervisord\Configuration;
use Francodacosta\Supervisord\Processors\CommandConfigurationProcessor;

// setup supervisord config object, with a processor for command sextions
$configuration = new Configuration;
$configuration->registerProcessor(new CommandConfigurationProcessor);

// configuration to generate
$config = array(
    'programs' => array(
        'cat command' => array('command' => 'tail -f /var/log/messages'),
        'ls command' => array('command' => 'ls -la', 'numprocs' => 3),
    )
);

// load the configuration object from the $config array
$loader = new ArrayLoader($config, $configuration);
$supervisordConfig = $loader->load();

// dump the generate configuration
echo $supervisordConfig->generate();

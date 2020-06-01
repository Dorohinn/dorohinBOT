<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

$app->get('/', function() use($app) {
	return "Hello World!";
});

$app->post('/bot', function() use($app) {
	$data = json_decode(file_get_contents('php://input'));

	if(!$data )
		return 'nioh';

	if( $data->secret !== getnv('VK_SECRET_TOKEN') && $data->type !=='confirmation')
		return 'nioh';

	switch ( $data->type ) 
	{
		case 'confirmation':
			return getenv('VK_CONFIRMATTON_CODE');
			break;

		case 'massage_new':


	}

	return "nioh";
});

$app->run();

<?php

namespace Modules\Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Db\Adapter\Pdo\Mysql as MySQLAdapter;

class Module
{

	public function registerAutoloaders()
	{

		$loader = new Loader();

		$loader->registerNamespaces(array(
			'Modules\Backend\Controllers' => __DIR__ . '/controllers/',
			'Modules\Backend\Models' => __DIR__ . '/models/',
		));

		$loader->register();
	}

	public function registerServices(DiInterface $di)
	{

		/**
		 * Read configuration
		 */
		$config = include __DIR__ . "/config/config.php";

		$di['dispatcher'] = function() {
			$dispatcher = new Dispatcher();
			$dispatcher->setDefaultNamespace("Modules\Backend\Controllers");
			return $dispatcher;
		};

		/**
		 * Setting up the view component
		 */
		$di['view'] = function() {

			$view = new View();

			$view->setViewsDir(__DIR__ . '/views/');
			$view->setLayoutsDir('../../common/layouts/');
			$view->setTemplateAfter('admin');

			return $view;
		};

		$di->set('assets', function() use ($config) {
		    $assets = new \Phalcon\Assets\Manager();
		    $assets
		    	->collection('footerJS')
		            ->addJs('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', false)
		            ->addJs('js/bootstrap.min.js', false)
		            ->addJs('js/admin/docs.min.js')
		            ;
		    $assets
			    ->collection('headerCss')
				->addCss('css/bootstrap.min.css')
				->addCss('css/dashboard.css');
		    return $assets;
        });
		/**
		 * Database connection is created based in the parameters defined in the configuration file
		 */
		$di['db'] = function() use ($config) {
			return new MySQLAdapter(array(
				"host" => $config->database->host,
				"username" => $config->database->username,
				"password" => $config->database->password,
				"dbname" => $config->database->name
			));
		};
	}
}

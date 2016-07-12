<?php

namespace Modules\Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Db\Adapter\Pdo\Mysql as MySQLAdapter;

class Module
{

	public function registerAutoloaders()
	{

		$loader = new Loader();

		$config = include __DIR__ . "/config/config.php";
		$loader->registerDirs(
		    array(
		        $config->application->controllersDir,
		        $config->application->modelsDir,
		        //$config->application->libraryDir,
		        $config->application->pluginsDir
		    )
		);
		$loader->registerNamespaces(array(
			'Modules\Backend\Controllers' => __DIR__ . '/controllers/',
			'Modules\Backend\Models' => __DIR__ . '/models/',
			'Modules\Backend\Plugin' => __DIR__ . '/pugins/',
			'Modules\Backend\Forms'       => $config->application->formsDir,
		));
		$loader->register();
	}

	public function registerServices(DiInterface $di)
	{
		$debug = new \Phalcon\Debug();
		$debug->listen();
		/*
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

			$view->registerEngines(array(
				".volt" => 'volt'
			));
			$view->setViewsDir(__DIR__ . '/views/');
			$view->setLayoutsDir('../../common/layouts/');
			$view->setTemplateAfter('admin');

			return $view;
		};

		$di->set('volt', function ($view, $di) {

			$volt = new VoltEngine($view, $di);

			$volt->setOptions(array(
				"compiledPath" => __DIR__ . "/cache/volt/"
			));

			$compiler = $volt->getCompiler();
			$compiler->addFunction('is_a', 'is_a');

			return $volt;
		}, true);

		$di->set('assets', function() use ($config) {
		    $assets = new \Phalcon\Assets\Manager();
		    $assets
		    	->collection('footerJS')
		            ->addJs('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', false)
		            ->addJs('js/bootstrap.min.js')
		            ->addJs('js/admin/docs.min.js')
		            ->addJs('js/plugins/morris/raphael.min.js')
		            ->addJs('js/plugins/morris/morris.min.js')
		            ->addJs('js/plugins/morris/morris-data.js')
		            ->addJs('//cdn.tinymce.com/4/tinymce.min.js', false)
		            ;
		    $assets
			    ->collection('headerCss')
					->addCss('css/bootstrap.min.css')
					->addCss('css/sb-admin.css')
					->addCss('css/plugins/morris.css')
					->addCss('font-awesome/css/font-awesome.min.css');
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

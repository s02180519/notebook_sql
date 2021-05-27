<?php

// подключаем файлы ядра
require_once 'faq/application/core/ModelFaq.php';
require_once 'faq/application/core/ViewFaq.php';
require_once 'faq/application/core/ControllerFaq.php';

/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
*/
//print $_SERVER['REQUEST_URI'];
$_SERVER['REQUEST_URI']='/MainFaq';
//print $_SERVER['REQUEST_URI'];
require_once 'faq/application/core/RouteFaq.php';
RouteFaq::start(); // запускаем маршрутизатор

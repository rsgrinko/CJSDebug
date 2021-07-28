<?php
/*
	Класс для отладки через консоль браузера
	Позволяет вывести данные отладки в консоль браузера,
	не пугая посетителей сайта
	Роман Гринько <rsgrinko@gmail.com>
	https://it-stories.ru/
	
	Пример использования:
	CJSDebug::print_r($_SERVER, 'Debug $_SERVER array');
	Выведет в консоль браузера массив $_SERVER в удобном виде
*/
	
class CJSDebug {
	private static function run(){
		echo '<script>console.warn(\'Debug message from '.__FILE__.'\')</script>';
		return;	
	}
	
	public static function print_r($str, $label = '') {
		self::run();
		echo '<script>console.group(\''.$label.'\');';
		echo 'console.log(\''.json_encode(print_r($str, true)).'\');';
		echo 'console.groupEnd();</script>';
		return;
	}
	
	public static function var_dump($str, $label = '') {
		self::run();
		ob_start();
		var_dump($str);
		$result = json_encode(ob_get_clean());
		echo '<script>console.group(\''.$label.'\');';
		echo 'console.log(\''.$result.'\');';
		echo 'console.groupEnd();</script>';
		return;
	}
}
?>
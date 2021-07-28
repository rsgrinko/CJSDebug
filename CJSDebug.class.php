<?php
/*
	Класс для отладки
	Роман Гринько <rsgrinko@gmail.com>
	https://it-stories.ru/
	
	Пример использования:
	CJSDebug::print_r($_SERVER, 'Debug $_SERVER array');
	Выведет в консоль браузера массив $_SERVER в удобном виде
    
    CJSDebug::log($_SERVER, 'log_test.txt');
    Запишет данные в лог-файл

*/
	
class CJSDebug {
	private static function run(){
		echo '<script>console.warn(\'Debug message from '.__FILE__.'\')</script>';
		return;	
	}
	
    // print_r в консоль
	public static function print_r($str, $label = '') {
		self::run();
		echo '<script>console.group(\''.$label.'\');';
		echo 'console.log(\''.json_encode(print_r($str, true)).'\');';
		echo 'console.groupEnd();</script>';
		return;
	}
	
    //var_dump в консоль
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

    // если вдруг понадобится - вывод в контент
    public static function pre($arr){
        echo '<pre>'.print_r($arr, true).'</pre>';
        return;
    }

    // логирование в файл
    public static function log($arr, $name = 'log.txt'){
        $result  = '------------- Log from '.__FILE__."\n";
        $result .= '------------- Date: '.date("d.m.Y H:i:s")."\n";
        $result .= print_r($arr, true)."\n";
        $result .= '------------- End log'."\n\n";

        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/'.$name, $result, FILE_APPEND | LOCK_EX);
        return;
    }
}
?>

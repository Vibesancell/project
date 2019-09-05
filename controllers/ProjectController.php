<?php

require_once('Controller.php');

class ProjectController extends Controller {
    private $pageTpl = '/views/main.tpl.php';
    public function saveNumber() {

    if( ! empty( $_POST['roman_number'] ) && ! empty( $_POST['arabic_number'] )  ) {
      $romanNumber = $_POST['roman_number'];
      $arabicNumber = $_POST['arabic_number'];
  }

  if($this->model->addNewUser($romanNumber, $arabicNumber )) {
  echo json_encode(array("success" => true, "text" => "Пользователь добавлен"));
} else {
  echo json_encode(array("success" => false, "text" => "Ошибка добавления"));
}
}



    public static $roman_values=array(
        'I' => 1, 'V' => 5,
        'X' => 10, 'L' => 50,
        'C' => 100, 'D' => 500,
        'M' => 1000,
    );

    public static $roman_zero=array( 'N', 'nulla' );

    public static $roman_regex='/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/';

  	public function __construct() {
  		$this->model = new ProjectModel();
  		$this->view = new View();
  	}

  	public function index() {
  		$this->view->render( $this->pageTpl, $this->pageData );
  	}

    static function IsRomanNumber( $roman ) {
         return preg_match( self::$roman_regex, $roman ) > 0;
    }
//Метод для конвертирование римских чисел в арабсике
    static function Roman2Int ( $roman ) {
        if ( in_array( $roman, self::$roman_zero ) ) {
            return 0;
        }

        if ( !self::IsRomanNumber( $roman ) ) {
            return false;
        }

        $values=self::$roman_values;
        $result = 0;

        for ( $i = 0, $length = strlen( $roman ); $i < $length; $i++ ) {
            $value = $values[$roman[$i]];
            $nextvalue = !isset( $roman[$i + 1] ) ? null : $values[$roman[$i + 1]];
            $result += ( !is_null( $nextvalue ) && $nextvalue > $value ) ? -$value : $value;
        }
        echo $result;
        return $result;
    }
//Метод для конвертирование арабских чисел в римские
    static function toNumeral($num, $uppercase = true, $html = true) {
    $conv = array(10 => array('X', 'C', 'M'),
    5 => array('V', 'L', 'D'),
    1 => array('I', 'X', 'C'));
    $roman = '';
    if ($num < 0) {
        return '';
    }
    $num = (int) $num;
    $digit = (int) ($num / 1000);
    $num -= $digit * 1000;
    while ($digit > 0) {
        $roman .= 'M';
        $digit--;
    }
    for ($i = 2; $i >= 0; $i--) {
        $power = pow(10, $i);
        $digit = (int) ($num / $power);
        $num -= $digit * $power;
        if (($digit == 9) || ($digit == 4)) {
            $roman .= $conv[1][$i] . $conv[$digit+1][$i];
        } else {
            if ($digit >= 5) {
                $roman .= $conv[5][$i];
                $digit -= 5;
            }
            while ($digit > 0) {
                $roman .= $conv[1][$i];
                $digit--;
            }
        }
    }

    if ($html == true) {
        $over = '<span style="text-decoration:overline;">';
        $overe = '</span>';
    } elseif ($html == false) {
        $over = '_';
        $overe = '';
    }

    $roman = str_replace(str_repeat('M', 1000),
                         $over.'AFS'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 900),
                         $over.'C'.$overe.$over.'AFS'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 500),
                         $over.'D'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 400),
                         $over.'C'.$overe.$over.'D'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 100),
                         $over.'C'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 90),
                         $over.'X'.$overe.$over.'C'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 50),
                         $over.'L'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 40),
                         $over.'X'.$overe.$over.'L'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 10),
                         $over.'X'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 5),
                         $over.'V'.$overe, $roman);
    $roman = str_replace(str_repeat('M', 4),
                         'M'.$over.'V'.$overe, $roman);

    $roman = str_replace('AFS', 'M', $roman);

    if ($html == true) {
        $roman = str_replace($overe.$over, '', $roman);
    }

    if ($uppercase == false) {
        $roman = strtolower($roman);
    }
    echo $roman;
    return $roman;
  }
}

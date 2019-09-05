<?php

require_once('Controller.php');

class ProjectController extends Controller {
    private $pageTpl = '/views/main.tpl.php';

    private $convertedResult = '';

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
}

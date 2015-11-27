<?php

/**
 *
 */
class Format extends Eloquent {

	public static function valorDB($valor) {

		if (empty($valor)) {
			return 0;
		} else {
			return str_replace(',', '.', str_replace('.', '', $valor));
		}
	}

	public static function valorView($valor, $decimais = 0) {
		return number_format((float) $valor, $decimais, ',', '.');
	}

	public static function dateView($data) {
		return implode('/', array_reverse(explode('-', $data)));
	}
}
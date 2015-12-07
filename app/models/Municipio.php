<?php

/**
 *
 */
class Municipio extends \Eloquent {
	protected $connection = 'pgsql2';
	protected $table      = 'municipio';

	public function scopeMs($query) {
		return $query->select('cidade')->where('estado', 'MS')->groupBy('cidade')->orderBy('cidade')->get();
	}

	public static function municipios(){
		$municipios = Municipio::ms();

		foreach ($municipios as $municipio) {
			$return[utf8_encode($municipio->cidade)] = utf8_encode($municipio->cidade);
		}

		return $return;
	}

}
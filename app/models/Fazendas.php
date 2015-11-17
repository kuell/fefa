<?php

/**
 *
 */
class Fazendas extends \Eloquent {
	protected $connection = 'pgsql2';
	protected $table = 'ce.fazendas';

	public function municipio() {
		return $this->belongsTo('Municipio', 'codigo_municipio', 'codigo_municipio');
	}

}
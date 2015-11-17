<?php

/**
 *
 */
class Pecuarista extends \Eloquent {
	protected $connection = 'pgsql2';
	protected $table      = 'fi.cadastro';

	public function fazendas() {
		return $this->hasMany('Fazendas', 'codigo_pecuarista', 'codigo_cadastro');
	}

}
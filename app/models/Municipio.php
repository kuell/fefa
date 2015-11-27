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

}
<?php

/**
 *
 */
class Fefa extends \Eloquent {
	protected $guarded = [];
	protected $table   = 'mov_fefa';

	public $rules =
	[
		'gta'       => 'required',
		'gta_serie' => 'required'
	];

	public function scopeCidade($query) {
		return $query->where('cidade', Input::get('cidade'));
	}

	public function scopePeriodo($query) {
		$periodo = explode(' - ', Input::get('periodo'));

		return $query->whereBetween('data_compra', $periodo);
	}

}
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
		'gta_serie' => 'required',
		'produtor'=>'required',
		'propriedade'=>'required',
		//'nfe'=>'required|unique:mov_fefa,nfe',
		'cidade'=>'required'
	];

	public function scopePeriodo($query) {
		$periodo = explode(' - ', Input::get('periodo'));

		return $query->whereBetween('data_compra', $periodo);
	}

	public function scopeAbertas($query){
		return $query->whereNull('fechamento');
	}

	public function empresa(){
	    return $this->belongsTo('Empresa', 'empresa_id');
    }

	public static function total($campo) {
		$total = DB::table('mov_fefa')->whereNull('fechamento')->sum($campo);

		return $total;
	}

	public function nota() {
		return $this->belongsTo('NotaEntrada', 'chave', 'chave_acesso_nfe');
	}

	public function getDataCompraAttribute() {

		if (!empty($this->attributes['data_compra'])) {
			return date('d/m/Y', strtotime($this->attributes['data_compra']));
		}
	}


	public static function getTotalPeso($sexo, $cidade) {
		$periodo = explode(' - ', Input::get('periodo'));

		$return = DB::table('mov_fefa')->where('situacao', 'ativo');

		if ($sexo == 'M') {
			if (!empty(Input::get('cidade'))) {
				$return = $return->where('cidade', Input::get('cidade'))->sum('peso_macho');
			} else {
				$return = $return->sum('peso_macho');
			}
		} else {
			if (Input::get('cidade') != null) {
				$return = $return->where('cidade', Input::get('cidade'))->sum('peso_femea');
			} else {
				$return = $return->sum('peso_femea');
			}
		}

		return $return;

	}

	public function setQtdMachoAttribute($val) {
		return $this->attributes['qtd_macho'] = Format::valorDB($val);
	}
	public function setPesoMachoAttribute($val) {
		return $this->attributes['peso_macho'] = Format::valorDB($val);
	}
	public function setQtdFemeaAttribute($val) {
		return $this->attributes['qtd_femea'] = Format::valorDB($val);
	}
	public function setPesoFemeaAttribute($val) {
		return $this->attributes['peso_femea'] = Format::valorDB($val);
	}

}

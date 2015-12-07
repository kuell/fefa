<?php

/**
 *
 */
class NotaEntrada extends \Eloquent {
	protected $connection = 'pgsql2';
	protected $table      = 'ce.notaentrada';

	public function produtos() {
		return $this->hasMany('NotaProduto', 'numero_nota_entrada', 'numero_nota_entrada');
	}

	public function fefa() {
		return $this->belongsTo('Fefa', 'chave_acesso_nfe', 'chave');
	}

	public function pecuarista() {
		return $this->belongsTo('Pecuarista', 'codigo_pecuarista', 'codigo_cadastro');
	}
	public function fazenda() {

		return $this->pecuarista->fazendas()->where('codigo_fazendas', $this->attributes['codigo_fazendas'])->first();
	}

	public function notasPecuarista() {
		return $this->hasMany('NotaPecuarista', 'numero_nota_entrada', 'numero_nota_entrada');
	}

	public function getNfpAttribute() {
		return implode('/', $this->notas_pecuarista->lists('numero_nota_produtor'));
	}
	public function getNfeAttribute() {
		return $this->numero_nota_fiscal;
	}

	public function getCidadeAttribute() {

		return utf8_encode($this->fazenda()->municipio->cidade);
	}

	public function getProdutorAttribute() {
		return $this->pecuarista->razao_social.' - '.$this->pecuarista->codigo_cadastro;
	}
	public function getPropriedadeAttribute() {
		return $this->fazenda()->nomefazenda;
	}

	public function getDataCompraAttribute() {
		return date('d/m/Y', strtotime($this->data_digitacao));
	}
	public function getChaveAttribute() {
		return $this->chave_acesso_nfe;
	}

	public function getGtaAttribute() {
		if (count($this->fefa)) {
			return $this->fefa->gta;
		}
	}
	public function getGtaSerieAttribute() {
		if (count($this->fefa)) {
			return $this->fefa->gta_serie;
		}

	}

	public function getQtdMachoAttribute() {
		$total = 0;

		foreach ($this->produtos as $produto) {
			if ($produto->animal->sexo == 'M') {
				$total = $total+$produto->quantidade_item;
			}
		}
		return $total;

	}
	public function getQtdFemeaAttribute() {
		$total = 0;

		foreach ($this->produtos as $produto) {
			if ($produto->animal->sexo == 'F') {
				$total = $total+$produto->quantidade_item;
			}
		}
		return $total;

	}

	public function getPesoMachoAttribute() {
		$total = 0;

		foreach ($this->produtos as $produto) {
			if ($produto->animal->sexo == 'M') {
				$total = $total+$produto->peso_item;
			}
		}
		return Format::valorView($total, 2);

	}

	public function getPesoFemeaAttribute() {
		$total = 0;

		foreach ($this->produtos as $produto) {
			if ($produto->animal->sexo == 'F') {
				$total = $total+$produto->peso_item;
			}
		}
		return Format::valorView($total, 2);

	}

}
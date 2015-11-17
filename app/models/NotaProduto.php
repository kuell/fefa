<?php

/**
 *
 */
class NotaProduto extends \Eloquent {
	protected $connection = 'pgsql2';
	protected $table      = "ce.notaprodutos";

	public function animal() {
		return $this->belongsTo('Animal', 'codigo_nota_produtos', 'codigo_animais');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;

class CreateMovFefaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('mov_fefa', function ($table) {
				$table->increments('id');
				$table->date('data_compra');
				$table->integer('nfe');
				$table->integer('nfp');
				$table->string('produtor');
				$table->string('propriedade');
				$table->string('cidade');
				$table->string('gta');
				$table->integer('qtd_macho');
				$table->integer('qtd_femea');
				$table->double('peso_macho');
				$table->double('peso_femea');
				$table->string('situacao');
				$table->string('fechamento');
				$table->string('chave', 50);

				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('mov_fefa');
	}

}

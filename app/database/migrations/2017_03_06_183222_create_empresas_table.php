<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('razao');
			$table->bigInteger('cnpj');
			$table->string('connection');
			$table->text('sql_nota');
			$table->text('sql_nfp');
			$table->timestamps();
		});

        Schema::table('mov_fefa', function ($table) {
            $table->integer('empresa_id')->default(1);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('empresas');
        Schema::table('mov_fefa', function ($table) {
            $table->dropColumn('empresa_id');
        });
	}

}

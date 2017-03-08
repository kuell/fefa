<?php

class EmpresasTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$empresas = [
		    [
		        'razao'     => 'Frizelo Frigorificos Ltda.',
                'cnpj'      => '13837014000106',
                'connection' => 'frigodata',
                'sql_nota'  => 'select 
                                    nf.chave_acesso_nfe as chave, 
                                    nf.data_emissao as data_compra, 
                                    nf.numero_nota_fiscal as numero_nfe, 
                                    nf.numero_nota_entrada,
                                    nf.codigo_pecuarista,
                                    (select razao_social from fi.cadastro where codigo_cadastro = nf.codigo_pecuarista and codigo_filiais= 1 and codigo_empresas = 1) as produtor, 
                                    (select nomefazenda from ce.fazendas where codigo_pecuarista = nf.codigo_pecuarista and codigo_fazendas = nf.codigo_fazendas and codigo_filiais = 1 and codigo_empresas = 1) as fazenda, 
                                    (select cidade from ce.fazendas inner join municipio on ce.fazendas.codigo_municipio = municipio.codigo_municipio where codigo_pecuarista = nf.codigo_pecuarista and codigo_fazendas = nf.codigo_fazendas and codigo_empresas = 1 and codigo_filiais = 1) as cidade,
                                    
                                
                                    coalesce(( select sum(quantidade_item) 
                                    from ce.notaprodutos np inner join ce.animais an on np.codigo_nota_produtos = an.codigo_animais and an.sexo = \'M\' 
                                    where np.numero_nota_entrada = nf.numero_nota_entrada and an.codigo_empresas = 1), 0) as qtd_macho, 
                                
                                    coalesce(( select sum(peso_item) from ce.notaprodutos np inner join ce.animais an on np.codigo_nota_produtos = an.codigo_animais and an.sexo = \'M\' 
                                    where np.numero_nota_entrada = nf.numero_nota_entrada and an.codigo_empresas = 1), 0) as peso_macho, 
                                    coalesce(( select sum(quantidade_item) 
                                    from ce.notaprodutos np inner join ce.animais an on np.codigo_nota_produtos = an.codigo_animais and an.sexo = \'F\' 
                                    where np.numero_nota_entrada = nf.numero_nota_entrada and an.codigo_empresas = 1), 0) as qtd_femea, 
                                    coalesce(( select sum(peso_item) from ce.notaprodutos np inner join ce.animais an on np.codigo_nota_produtos = an.codigo_animais and an.sexo = \'F\' where np.numero_nota_entrada = nf.numero_nota_entrada and an.codigo_empresas = 1), 0) as peso_femea 
                                from 
                                    ce.notaentrada nf 
                                where 
                                    nf.chave_acesso_nfe = ?',
                'sql_nfp'       => 'select 
                                        numero_nota_produtor
                                    from 
                                        ce.notapecuarista 
                                    where
                                        codigo_empresas = 1 and
                                        codigo_filiais = 1 and
                                        codigo_pecuarista = ? and
                                        numero_nota_entrada = ?',
                'created_at'    => 'now()',
                'updated_at'    => 'now()'
            ],
            [
                'razao'     => 'Braz Peli.',
                'cnpj'      => '08217906000174',
                'connection' => 'brazpeli',
                'sql_nota'  => 'select 
                                    nf.chave_acesso_nfe as chave, 
                                    nf.data_emissao as data_compra, 
                                    nf.numero_nota_fiscal as numero_nfe, 
                                    nf.numero_nota_entrada,
                                    nf.codigo_pecuarista,
                                    (select razao_social from fi.cadastro where codigo_cadastro = nf.codigo_pecuarista and codigo_filiais= 1 and codigo_empresas = 1) as produtor, 
                                    (select nomefazenda from ce.fazendas where codigo_pecuarista = nf.codigo_pecuarista and codigo_fazendas = nf.codigo_fazendas and codigo_filiais = 1 and codigo_empresas = 1) as fazenda, 
                                    (select cidade from ce.fazendas inner join municipio on ce.fazendas.codigo_municipio = municipio.codigo_municipio where codigo_pecuarista = nf.codigo_pecuarista and codigo_fazendas = nf.codigo_fazendas and codigo_empresas = 1) as cidade,
                                    
                                
                                    coalesce(( select sum(quantidade_item) 
                                    from ce.notaprodutos np inner join ce.animais an on np.codigo_nota_produtos = an.codigo_animais and an.sexo = \'M\' 
                                    where np.numero_nota_entrada = nf.numero_nota_entrada and an.codigo_empresas = 1), 0) as qtd_macho, 
                                
                                    coalesce(( select sum(peso_item) from ce.notaprodutos np inner join ce.animais an on np.codigo_nota_produtos = an.codigo_animais and an.sexo = \'M\' 
                                    where np.numero_nota_entrada = nf.numero_nota_entrada and an.codigo_empresas = 1), 0) as peso_macho, 
                                    coalesce(( select sum(quantidade_item) 
                                    from ce.notaprodutos np inner join ce.animais an on np.codigo_nota_produtos = an.codigo_animais and an.sexo = \'F\' 
                                    where np.numero_nota_entrada = nf.numero_nota_entrada and an.codigo_empresas = 1), 0) as qtd_femea, 
                                    coalesce(( select sum(peso_item) from ce.notaprodutos np inner join ce.animais an on np.codigo_nota_produtos = an.codigo_animais and an.sexo = \'F\' where np.numero_nota_entrada = nf.numero_nota_entrada and an.codigo_empresas = 1), 0) as peso_femea
                                from 
                                    ce.notaentrada nf 
                                where 
                                    nf.chave_acesso_nfe = ?',
                'sql_nfp'       => 'select 
                                      numero_nota_produtor
                                    from 
                                      ce.notapecuarista 
                                    where
                                        codigo_empresas = 1 and
                                        codigo_filiais = 1 and
                                        codigo_pecuarista = ? and
                                        numero_nota_entrada = ?',
                'created_at'    => 'now()',
                'updated_at'    => 'now()'
            ],
        ];

	DB::table('empresas')->insert($empresas);
	}

}

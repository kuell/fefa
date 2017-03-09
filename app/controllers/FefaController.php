<?php

class FefaController extends \BaseController {

	private $fefas;

	public function __construct(Fefa $fefa) {
		$this->fefas = $fefa;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$fefas = $this->fefas->abertas()->get();

		return View::make('index', compact('fefas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {

	    $fefa = Fefa::where(Input::all())->first();

        if(count($fefa)){
            $nota = $fefa;
            $empresa = $fefa->empresa;

            return View::make('form', compact('nota', 'empresa'));
        }
        else {

            $empresas = Empresa::all();

            foreach ($empresas as $emp) {
                $pos = strpos(Input::get('chave'), "$emp->cnpj");


                if ($pos) {
                    $empresa = $emp;
                    break;
                } else {
                    $empresa = null;
                }
            }


            if ($empresa) {

                $nf = DB::connection($empresa->connection)->select($empresa->sql_nota, [Input::get('chave')]);
                $nota = $nf[0];

                $nfp = DB::connection($empresa->connection)->select($empresa->sql_nfp, [$nota->codigo_pecuarista, $nota->numero_nota_entrada]);

                foreach ($nfp as $n) {
                    $nota_produtor[] = $n->numero_nota_produtor;

                }

                $nota->nfp = implode($nota_produtor, ' ,');


                return View::make('form', compact('nota', 'empresa'));

            } else {
                return Redirect::back()->with('message', 'Erro ao encontrar a empresa emissora da nota');
            }

        }

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();
        $fefa = Fefa::where('chave', $input['chave'])->first();

        if(count($fefa)){
            $validate = Validator::make($input, $this->fefas->rules);

            if ($validate->passes()) {
                $fefa->chave = $input['chave'];
                $fefa->data_compra = $input['data_compra'];
                $fefa->nfe = $input['nfe'];
                $fefa->nfp = $input['nfp'];
                $fefa->cidade = $input['cidade'];
                $fefa->produtor = $input['produtor'];
                $fefa->propriedade = $input['propriedade'];
                $fefa->qtd_macho = $input['qtd_macho'];
                $fefa->peso_macho = $input['peso_macho'];
                $fefa->qtd_femea = $input['qtd_femea'];
                $fefa->peso_femea = $input['peso_femea'];
                $fefa->gta = $input['gta'];
                $fefa->gta_serie = $input['gta_serie'];
                $fefa->empresa_id = $input['empresa_id'];

                $fefa->save();

                return Redirect::back()->with('message', 'Registro atualizado com sucesso!');
            }else {
                return Redirect::route('fefa.create', ['chave' => $input['chave']])
                    ->withInput()
                    ->withErrors($validate)
                    ->with('message', 'Houve erros na validação dos dados.');
            }
        }
        else{

            $validate = Validator::make($input, $this->fefas->rules);

            if ($validate->passes()) {
                $fefa = new Fefa();
                $fefa->chave = $input['chave'];
                $fefa->data_compra = $input['data_compra'];
                $fefa->nfe = $input['nfe'];
                $fefa->nfp = $input['nfp'];
                $fefa->cidade = $input['cidade'];
                $fefa->produtor = $input['produtor'];
                $fefa->propriedade = $input['propriedade'];
                $fefa->qtd_macho = $input['qtd_macho'];
                $fefa->peso_macho = $input['peso_macho'];
                $fefa->qtd_femea = $input['qtd_femea'];
                $fefa->peso_femea = $input['peso_femea'];
                $fefa->gta = $input['gta'];
                $fefa->gta_serie = $input['gta_serie'];
                $fefa->empresa_id = $input['empresa_id'];

                $fefa->save();

                return Redirect::to('/');
            } else {
                return Redirect::route('fefa.create', ['chave' => $input['chave']])
                    ->withInput()
                    ->withErrors($validate)
                    ->with('message', 'Houve erros na validação dos dados.');
            }

        }

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$nota = $this->fefas->find($id);

		return View::make('form', compact('nota'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		$rules = $this->fefas->rules;

	//	$rules['nfe'] = $this->fefas->rules['nfe'].','.$id;
		
		$validate = Validator::make($input, $rules);

		if ($validate->passes()) {
			$fefa = $this->fefas->find($id);

			$fefa->update($input);

			return Redirect::route('fefa.index');
		} else {
			return Redirect::route('fefa.create', ['chave' => $input['chave']])
				->withInput()
				->withErrors($validate)
				->with('message', 'Houve erros na validação dos dados.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$fefa = $this->fefas->find($id);
		$fefa->delete();

		return Redirect::route('fefa.index');
	}

	public function getRelatorios() {
		return View::make('form_relatorio');
	}

	public function getRelatorioSif() {
		$fefas = $this->fefas->abertas()->orderBy('data_compra');

//		if (!empty(Input::get('periodo'))) {
//			$fefas = $fefas->periodo();
//		}

		return View::make('relatorio_sif', compact('fefas'));
	}

	public function getRelatorioFefa($empresa_id = 0) {

	    if($empresa_id == 0){
	        $empresa = Empresa::find(1);
            $fefas = $this->fefas->abertas()->orderBy('data_compra');
        }
        else{
	        $empresa = Empresa::find($empresa_id);
	        $fefas = $empresa->fefas()->abertas()->orderBy('data_compra');
        }


//		if(!empty(Input::get('periodo'))){
//			$fefas = $fefas->periodo();	
//		}
		
		return View::make('relatorio_fefa', compact('fefas', 'empresa'));


	}

}

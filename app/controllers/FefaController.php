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

		if (!empty(Input::get('avulsa')) && empty(Input::get('chave'))) {
			$nota = new Fefa();
			return View::make('form', compact('nota'));

		} else if (!empty(Input::get('chave'))) {

			$nota = NotaEntrada::where('chave_acesso_nfe', Input::get('chave', null))->first();
			
			if(!empty($nota)){

				
				if (count($nota->fefa) != 0) {
					return Redirect::route('fefa.edit', $nota->fefa->id);
				} else {
					return View::make('form', compact('nota'));
				}

			}
			else{
				
				return Redirect::route('fefa.index')
					->withErrors(Input::all())
					->with('message', 'Chave de acesso da nota não encontrada!');
				
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

			$fefa->save();

			return Redirect::to('/');
		} else {
			return Redirect::route('fefa.create', ['chave' => $input['chave']])
				->withInput()
				->withErrors($validate)
				->with('message', 'Houve erros na validação dos dados.');
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

		$rules['nfe'] = $this->fefas->rules['nfe'].','.$id;
		
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

		if (!empty(Input::get('periodo'))) {
			$fefas = $fefas->periodo();
		}

		return View::make('relatorio_sif', compact('fefas'));
	}

	public function getRelatorioFefa() {
		$fefas = $this->fefas->abertas()->orderBy('data_compra');

		return View::make('relatorio_fefa', compact('fefas'));
	}

}

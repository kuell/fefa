<?php

use Carbon\Carbon as Carbon;

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

        if(count($fefa))
        {
            $nota = $fefa;
            $empresa = $fefa->empresa;

            return View::make('form', compact('nota', 'empresa'));
        }

        else {

            $empresa = Empresa::find(1);

            $nf = DB::connection($empresa->connection)->select($empresa->sql_nota, [Input::get('nfe')]);

            $nota = $nf[0];

            $nfp = DB::connection($empresa->connection)->select($empresa->sql_nfp, [$nota->codigo_pecuarista, $nota->numero_nota_entrada]);

            $nota_produtor = [];

            foreach ($nfp as $n) {
                $nota_produtor[] = $n->numero_nota_produtor;

            }

            $nota->nfp = implode($nota_produtor, ' ,');


            return View::make('form', compact('nota', 'empresa'));



        }

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

        $fefa = Fefa::where('nfe', $input['nfe'])->first();

        $input['cidade'] = strtr(

            $input['cidade'],

            array (

                'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
                'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
                'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
                'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
                'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
                'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
                'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
                'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
                'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
                'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
                'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r'
            )
        );

        if(count($fefa)){
            $validate = Validator::make($input, $this->fefas->rules);

            if ($validate->passes()) {
                $fefa->chave = $input['chave'];
                $fefa->data_compra = $input['data_compra'];
                $fefa->nfe = $input['nfe'];
                $fefa->nfp = $input['nfp'];
                $fefa->cidade = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $input['cidade'] ) );
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
                $fefa->data_compra = Carbon::createFromFormat('d/m/Y', $input['data_compra'])->format('Y-m-d');
                $fefa->nfe = $input['nfe'];
                $fefa->nfp = $input['nfp'];
                $fefa->cidade = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $input['cidade'] ) );
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

		return Redirect::back();
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

	public function getRelatorioFefaExcel($empresa_id = 0) {

	    if($empresa_id == 0){
	        $empresa = Empresa::find(1);
            $fefas = $this->fefas->abertas()->orderBy('data_compra');
        }
        else{
	        $empresa = Empresa::find($empresa_id);
	        $fefas = $empresa->fefas()->abertas()->orderBy('data_compra');
        }

        $fefas = $empresa->fefas()->get();

//		if(!empty(Input::get('periodo'))){
//			$fefas = $fefas->periodo();	
//		}
		
		return View::make('relatorio_fefa_excel', compact('fefas'));


	}

}

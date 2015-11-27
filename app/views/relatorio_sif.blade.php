<?php

/**
 *
 */
class RelatorioSif extends Fpdf {

	public function Header() {
		$this->SetFont('Arial', 'B', 16);
		$this->SetFillColor(200);
		$this->image(public_path().'/logo.jpg', 14, 14, 25, 11);
		$this->Cell(0, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 6);
		$this->Cell(0, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'LR', 0, 'C', 0);
		$this->SetFont('Arial', '', 9);
		$this->Ln();
		$this->Cell(0, 5, utf8_decode('RELATÓRIO AO SIF REF:'.Input::get('periodo')), 'BLR', 0, 'C', 0);
		$this->Ln(7);

	}

	public function Dados($fefas) {
		$this->AddPage();

		$this->SetFillColor(200);
		$this->SetFont('Arial', '', 8);

		if (Input::get('cidade') != '') {
			$this->Cell(0, 4, Input::get('cidade'), 1, 0, 'C', 1);
			$this->Ln();

			$this->listar($fefas->where('cidade', Input::get('cidade'))->get());
		} else {
			$this->Cell(0, 4, 'GERAL', 1, 0, 'C', 1);
			$this->Ln();

			$this->listar($fefas->get());
		}

	}

	public function listar($fefas) {

		$this->Cell(25, 4, 'Data Compra', 1, 0, "C", 1);
		$this->Cell(25, 4, 'NFE', 1, 0, "C", 1);
		$this->Cell(25, 4, 'Qtd. Macho', 1, 0, "C", 1);
		$this->Cell(25, 4, 'Peso Macho', 1, 0, "C", 1);
		$this->Cell(25, 4, 'Qtd. Femea', 1, 0, "C", 1);
		$this->Cell(25, 4, 'Peso Femea', 1, 0, "C", 1);
		$this->Cell(0, 4, 'Municipio', 1, 0, "C", 1);
		$this->Ln();

		foreach ($fefas as $fefa) {
			$this->Cell(25, 4, Format::dateView($fefa->data_compra), 1, 0, "C", 0);
			$this->Cell(25, 4, $fefa->nfe, 1, 0, "C", 0);
			$this->Cell(25, 4, $fefa->qtd_macho, 1, 0, "R", 0);
			$this->Cell(25, 4, $fefa->peso_macho, 1, 0, "R", 0);
			$this->Cell(25, 4, $fefa->qtd_femea, 1, 0, "R", 0);
			$this->Cell(25, 4, $fefa->peso_femea, 1, 0, "R", 0);
			$this->Cell(0, 4, substr(utf8_decode($fefa->cidade), 0, 22), 1, 0, "L", 0);

			$this->Ln();
		}

		$this->Ln();

		$this->Cell(30, 4, 'QTD MACHOS', 1, 0, "R", 1);
		$this->Cell(25, 4, Format::valorView($fefas->sum('qtd_macho')), 1, 0, "R", 0);
		$this->Cell(30, 4, 'PESO MACHOS', 1, 0, "R", 1);
		$this->Cell(25, 4, Format::valorView(Fefa::getTotalPeso('M', Input::get('cidade', null)), 2), 1, 0, "R", 0);
		$this->Ln();

		$this->Cell(30, 4, 'QTD FEMEA', 1, 0, "R", 1);
		$this->Cell(25, 4, Format::valorView($fefas->sum('qtd_femea')), 1, 0, "R", 0);
		$this->Cell(30, 4, 'PESO FEMEA', 1, 0, "R", 1);
		$this->Cell(25, 4, Format::valorView(Fefa::getTotalPeso('F', Input::get('cidade', null)), 2), 1, 0, "R", 0);
		$this->Ln();

		$this->Cell(30, 4, 'TOTAL QTD', 1, 0, "R", 1);
		$this->Cell(25, 4, Format::valorView($fefas->sum('qtd_femea')+$fefas->sum('qtd_macho'), 0), 1, 0, "R", 0);
		$this->Cell(30, 4, 'TOTAL PESO', 1, 0, "R", 1);
		$this->Cell(25, 4, Format::valorView(Fefa::getTotalPeso('M', Input::get('cidade', null))+Fefa::getTotalPeso('F', Input::get('cidade', null)), 2), 1, 0, "R", 0);
	}

	public function Footer() {
		$this->SetY(-15);
		$this->SetFont("Arial", "I", 6);
		$this->SetDrawColor(200);
		$this->Cell(0, 4, utf8_decode("Página ").$this->PageNo()." | Processado em ".date('d/m/Y H:i'), 0, 0, "C");
	}

}

$pdf            = new RelatorioSif("P", "mm", "A4");
$pdf->tituloDoc = Input::get('cidade', 'TODOS');
$pdf->Dados($fefas);
$pdf->Output();
exit;
<?php

/**
 *
 */
class RelatorioSif extends Fpdf {

	public $tituloDoc = '';
	public $angle     = 0;

	public function Header() {
		$this->SetFont('Arial', 'B', 16);
		$this->SetFillColor(200);
		$this->image(public_path().'/logo.jpg', 11, 11, 25, 11);
		$this->Cell(0, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 6);
		$this->Cell(0, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
		$this->SetFont('Arial', '', 9);
		$this->Ln();

		$this->Cell(0, 5, utf8_decode('RELATÓRIO FEFA REF:'.Input::get('periodo')), 'BLTR', 0, 'C', 0);
		$this->Ln();

	}

	public function Dados($fefas) {
		$this->AddPage();

		$this->SetFillColor(200);
		$this->SetFont('Arial', '', 8);

		$this->listar($fefas->get());

	}

	public function listar($fefas) {

		$this->Cell(15, 4, 'Data Compra', 1, 0, "C", 1);
		$this->Cell(37, 4, 'GTA', 1, 0, "C", 1);
	//	$this->Cell(10, 4, 'SERIE', 1, 0, "C", 1);
		$this->Cell(45, 4, 'NFP', 1, 0, "C", 1);
		$this->Cell(40, 4, 'MUNICIPIO', 1, 0, "C", 1);
		$this->Cell(50, 4, 'PRODUTOR', 1, 0, "C", 1);
		$this->Cell(40, 4, 'PROPRIEDADE', 1, 0, "C", 1);
		$this->Cell(15, 4, 'MACHO', 1, 0, "C", 1);
		$this->Cell(15, 4, 'FEMEA', 1, 0, "C", 1);
		$this->Cell(20, 4, 'TOTAL', 1, 0, "C", 1);

		$this->Ln();

		$totalMacho = 0;
		$totalFemea = 0;

		$this->SetFont('Arial', '', 6);

		foreach ($fefas as $fefa) {
			$this->Cell(15, 4, Format::dateView($fefa->data_compra), 1, 0, "C", 0);
			$this->Cell(37, 4, substr($fefa->gta, 0, 33), 1, 0, "L", 0);
		//	$this->Cell(10, 4, $fefa->gta_serie, 1, 0, "C", 0);
			$this->Cell(45, 4, substr($fefa->nfp, 0, 40), 1, 0, "L", 0);
			$this->Cell(40, 4, utf8_decode($fefa->cidade), 1, 0, "L", 0);
			$this->Cell(50, 4, substr($fefa->produtor, 0, 35), 1, 0, "L", 0);
			$this->Cell(40, 4, substr($fefa->propriedade, 0, 29), 1, 0, "L", 0);
			$this->Cell(15, 4, $fefa->qtd_macho, 1, 0, "L", 0);
			$this->Cell(15, 4, $fefa->qtd_femea, 1, 0, "L", 0);
			$this->Cell(20, 4, $fefa->qtd_macho+$fefa->qtd_femea, 1, 0, "L", 0);

			$totalMacho = $totalMacho+$fefa->qtd_macho;
			$totalFemea = $totalFemea+$fefa->qtd_femea;

			$this->Ln();
		}

		$this->Ln();

		$this->Cell(30, 4, 'QTD MACHOS', 1, 0, "R", 1);
		$this->Cell(25, 4, Format::valorView($totalMacho), 1, 0, "R", 0);
		$this->Ln();

		$this->Cell(30, 4, 'QTD FEMEA', 1, 0, "R", 1);
		$this->Cell(25, 4, Format::valorView($totalFemea), 1, 0, "R", 0);
		$this->Ln();

		$this->Cell(30, 4, 'TOTAL QTD', 1, 0, "R", 1);
		$this->Cell(25, 4, Format::valorView($totalFemea+$totalMacho, 0), 1, 0, "R", 0);

	}

	public function Footer() {
		$this->SetY(-15);
		$this->SetFont("Arial", "I", 6);
		$this->SetDrawColor(200);
		$this->Cell(0, 4, utf8_decode("Página ").$this->PageNo()." | Processado em ".date('d/m/Y H:i'), 0, 0, "C");
	}

}

$pdf = new RelatorioSif("L", "mm", "A4");
$pdf->Dados($fefas);
$pdf->Output();
exit;

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
		//$this->image(public_path().'/img/logo.png', 11, 11, 25, 11);
		$this->Cell(0, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 6);
		$this->Cell(0, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
		$this->SetFont('Arial', '', 9);
		$this->Ln(7);
		if ($this->tituloDoc != '') {
			$this->Cell(0, 5, utf8_decode($this->tituloDoc), 'BLTR', 0, 'C', 0);
			$this->Ln();
		}

	}

	public function Dados($fefas) {
		$this->SetFillColor(200);

		$this->Cell(25, 4, 'Data Compra', 1, 0, "C", 1);
		$this->Cell(25, 4, 'NFE', 1, 0, "C", 1);
		$this->Cell(25, 4, 'Qtd. Macho', 1, 0, "C", 1);
		$this->Cell(25, 4, 'Peso Macho', 1, 0, "C", 1);
		$this->Cell(25, 4, 'Qtd. Femea', 1, 0, "C", 1);
		$this->Cell(25, 4, 'Peso Femea', 1, 0, "C", 1);
		$this->Cell(0, 4, 'Municipio', 1, 0, "C", 1);
		$this->Ln();

		$qtdMacho = 0;
		$qtdFemea = 0;

		$pesoMacho = 0;
		$pesoFemea = 0;

		foreach ($fefas as $fefa) {
			$this->Cell(25, 4, date('d/m/Y', strtotime($fefa->data_compra)), 1, 0, "C", 0);
			$this->Cell(25, 4, $fefa->nfe, 1, 0, "C", 0);
			$this->Cell(25, 4, $fefa->qtd_macho, 1, 0, "C", 0);
			$this->Cell(25, 4, $fefa->peso_macho, 1, 0, "C", 0);
			$this->Cell(25, 4, $fefa->qtd_femea, 1, 0, "C", 0);
			$this->Cell(25, 4, $fefa->peso_femea, 1, 0, "C", 0);
			$this->Cell(0, 4, $fefa->cidade, 1, 0, "C", 0);

			$this->Ln();

			$qtdMacho = $fefa->qtd_macho+$qtdMacho;
			$qtdFemea = $fefa->qtd_femea+$qtdFemea;

			$pesoMacho = $fefa->peso_macho+$pesoMacho;
			$pesoFemea = $fefa->peso_femea+$pesoFemea;
		}

		$this->Ln();

		$this->Cell(30, 4, 'QTD MACHOS', 1, 0, "R", 1);
		$this->Cell(25, 4, number_format($qtdMacho, 0, ',', '.'), 1, 0, "R", 0);
		$this->Cell(30, 4, 'PESO MACHOS', 1, 0, "R", 1);
		$this->Cell(25, 4, number_format($pesoMacho, 2, ',', '.'), 1, 0, "R", 0);
		$this->Ln();

		$this->Cell(30, 4, 'QTD FEMEA', 1, 0, "R", 1);
		$this->Cell(25, 4, number_format($qtdFemea, 0, ',', '.'), 1, 0, "R", 0);
		$this->Cell(30, 4, 'PESO FEMEA', 1, 0, "R", 1);
		$this->Cell(25, 4, number_format($pesoFemea, 2, ',', '.'), 1, 0, "R", 0);
		$this->Ln();

		$this->Cell(30, 4, 'TOTAL QTD', 1, 0, "R", 1);
		$this->Cell(25, 4, number_format($qtdFemea+$qtdMacho, 0, ',', '.'), 1, 0, "R", 0);
		$this->Cell(30, 4, 'TOTAL PESO', 1, 0, "R", 1);
		$this->Cell(25, 4, number_format($pesoFemea+$pesoMacho, 2, ',', '.'), 1, 0, "R", 0);

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
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Dados($fefas);
$pdf->Output();
exit;
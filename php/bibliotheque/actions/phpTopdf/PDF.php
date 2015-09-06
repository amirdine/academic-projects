<?
require_once('actions/phpTopdf/fpdf.php');

class PDF extends FPDF
{
function Header()
{
	global $titre;

	
	// Saut de ligne
	$this->Ln(10);
}

function Footer()
{
	// Positionnement à 1,5 cm du bas
	$this->SetY(-15);
	// Arial italique 8
	$this->SetFont('Arial','I',8);
	// Couleur du texte en gris
	$this->SetTextColor(128);
	// Numéro de page
	$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function TitreChapitre($num, $libelle)
{
	// Arial 12
	$this->SetFont('Arial','',12);
	// Couleur de fond
	$this->SetFillColor(200,220,255);
	// Titre
	$this->Cell(0,6," $libelle",0,1,'L',true);
	// Saut de ligne
	$this->Ln(4);
}

function CorpsChapitre($fichier)
{
	// Lecture du fichier texte
	$txt = file_get_contents($fichier);
	// Times 12
	$this->SetFont('Times','',12);
	// Sortie du texte justifié
	$this->MultiCell(0,5,$txt);
	// Saut de ligne
	$this->Ln();
	// Mention en italique
	$this->SetFont('','I');
	$this->Cell(0,5,"Merci.");
}

function AjouterChapitre($num, $titre, $fichier)
{
	$this->AddPage();
	$this->TitreChapitre($num,$titre);
	$this->CorpsChapitre($fichier);
}
}
?>

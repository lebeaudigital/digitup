<?php
require_once __DIR__.'/views/config/sessionAuth.php';
require_once __DIR__ . '/vendor/autoload.php'; // Inclure TCPDF

// Création du PDF en format A4 avec suppression de la marge inférieure
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->setPrintHeader(false); // Désactiver le header
$pdf->setPrintFooter(false); // Désactiver le footer
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Michael');
$pdf->SetTitle('PDF avec HTML et Images');
$pdf->SetSubject('Mise en page avancée');
$pdf->SetMargins(30, 10, 30); // Définit les marges (10mm sur les côtés)
$pdf->SetAutoPageBreak(true, 0); // 🔹 Active/Désactive le saut de page automatique et enlève la marge basse
$pdf->AddPage();

// Définition des images (assurez-vous qu'elles existent)
$image1 = 'assets/img/buddizsport.png'; // Image en haut à gauche
$image2 = 'assets/img/casdar.png'; // Image en haut à droite
$image3 = 'assets/img/ifip-partenaire.png'; // Image en bas au centre

// Contenu HTML (sans les images du bas)
$html = <<<EOD
<style>
    .container { width: 100%; position: relative; }
    .title { font-size: 18px; font-weight: bold; text-align: center;}
    .content { font-size: 10px; text-align: left;}
</style>

<br><br><br>
<div class="container">
    <h1 class="title">Exemple de PDF avec HTML et Images</h1>
    <br><br><br>
    <p class="content">Ce fichier PDF est généré en HTML et CSS avec TCPDF. On peut ainsi positionner du texte, des images et structurer le contenu facilement.</p>
</div>
EOD;

// Ajout du HTML au PDF
$pdf->writeHTML($html, true, false, true, false, '');

// 🔹 Positionnement des images en bas
$y_bottom = -35; // Position de base pour toutes les images en bas
$partners = 15;

$pdf->SetY($y_bottom);
$pdf->Image($image1, 85, $pdf->GetY(), 40, 20, '', '', '', false, 300, '', false, false, 0, false, false, false);

$pdf->SetY($y_bottom);
$pdf->Image($image2, 20, $pdf->GetY(), 40, 20, '', '', '', false, 300, '', false, false, 0, false, false, false);

$pdf->SetY($partners);
$pdf->Image($image3, 140, $pdf->GetY(), 70, 10, '', '', '', false, 300, '', false, false, 0, false, false, false);

// Génération du fichier PDF
$pdf->Output('mise_en_page.pdf', 'I'); // 'I' pour afficher, 'D' pour télécharger
?>
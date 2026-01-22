<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Récupération des données du formulaire
$prenom = $_POST['prenom'] ?? '';
$nom = $_POST['nom'] ?? '';
$titre = $_POST['titre'] ?? '';
$email = $_POST['email'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$profil = $_POST['profil'] ?? '';

// Expériences
$exp_postes = $_POST['exp_poste'] ?? [];
$exp_entreprises = $_POST['exp_entreprise'] ?? [];
$exp_debuts = $_POST['exp_debut'] ?? [];
$exp_fins = $_POST['exp_fin'] ?? [];
$exp_descriptions = $_POST['exp_description'] ?? [];

// Formations
$form_diplomes = $_POST['form_diplome'] ?? [];
$form_etablissements = $_POST['form_etablissement'] ??  [];
$form_debuts = $_POST['form_debut'] ?? [];
$form_fins = $_POST['form_fin'] ??  [];
$form_descriptions = $_POST['form_description'] ?? [];

// Compétences
$competences = $_POST['competences'] ?? '';
$competences_array = array_filter(array_map('trim', explode(',', $competences)));

// CHARGER LE CSS DEPUIS LE FICHIER
$css = file_get_contents('Assets/css/export.css');

// Construction du HTML pour le CV
$html = '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        ' . $css . '
    </style>
</head>
<body>
    <div class="cv-header">
        <h1 class="cv-name">' . htmlspecialchars($prenom . ' ' . $nom) . '</h1>
        <div class="cv-title">' .  htmlspecialchars($titre) . '</div>
        <div class="cv-contact">' . htmlspecialchars($email) . ' | ' . htmlspecialchars($telephone) . '</div>
    </div>';

// Profil
if (!empty($profil)) {
    $html .= '
    <div class="cv-section">
        <h2 class="cv-section-title">Profil</h2>
        <p>' .  nl2br(htmlspecialchars($profil)) . '</p>
    </div>';
}

// Expériences
if (! empty($exp_postes[0])) {
    $html .= '
    <div class="cv-section">
        <h2 class="cv-section-title">Expériences professionnelles</h2>';
    
    for ($i = 0; $i < count($exp_postes); $i++) {
        if (!empty($exp_postes[$i]) || !empty($exp_entreprises[$i])) {
            $html .= '
        <div class="experience-item">
            <div class="item-header">' . htmlspecialchars($exp_postes[$i]) . ' - ' . htmlspecialchars($exp_entreprises[$i]) . '</div>
            <div class="item-dates">' . htmlspecialchars($exp_debuts[$i]) . ' - ' . htmlspecialchars($exp_fins[$i]) . '</div>
            <p>' . nl2br(htmlspecialchars($exp_descriptions[$i])) . '</p>
        </div>';
        }
    }
    
    $html .= '
    </div>';
}

// Formations
if (!empty($form_diplomes[0])) {
    $html .= '
    <div class="cv-section">
        <h2 class="cv-section-title">Formations</h2>';
    
    for ($i = 0; $i < count($form_diplomes); $i++) {
        if (!empty($form_diplomes[$i]) || !empty($form_etablissements[$i])) {
            $html .= '
        <div class="formation-item">
            <div class="item-header">' . htmlspecialchars($form_diplomes[$i]) . ' - ' . htmlspecialchars($form_etablissements[$i]) . '</div>
            <div class="item-dates">' . htmlspecialchars($form_debuts[$i]) . ' - ' . htmlspecialchars($form_fins[$i]) . '</div>
            <p>' .  nl2br(htmlspecialchars($form_descriptions[$i])) . '</p>
        </div>';
        }
    }
    
    $html .= '
    </div>';
}

// Compétences
if (!empty($competences_array)) {
    $html .= '
    <div class="cv-section">
        <h2 class="cv-section-title">Compétences</h2>
        <ul class="cv-skills">';
    
    foreach ($competences_array as $competence) {
        $html .= '<li class="cv-skill">' . htmlspecialchars($competence) . '</li>';
    }
    
    $html .= '
        </ul>
    </div>';
}

$html .= '
</body>
</html>';

// Configuration de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Téléchargement du PDF
$dompdf->stream("CV_" .  $prenom . "_" . $nom . ".pdf", ["Attachment" => true]);
?>
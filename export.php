<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);


$prenom = htmlspecialchars($_POST['prenom'] ?? '');
$nom = htmlspecialchars($_POST['nom'] ?? '');
$titre = htmlspecialchars($_POST['titre'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$telephone = htmlspecialchars($_POST['telephone'] ?? '');
$profil = htmlspecialchars($_POST['profil'] ?? '');

$competences_raw = $_POST['competences'] ?? '';
$competences = array_filter(array_map('trim', explode(',', $competences_raw)));


$exp_postes = $_POST['exp_poste'] ?? [];
$exp_entrs = $_POST['exp_entreprise'] ?? [];
$exp_debuts = $_POST['exp_debut'] ?? [];
$exp_fins = $_POST['exp_fin'] ?? [];
$exp_descs = $_POST['exp_description'] ?? [];

$form_diplomes = $_POST['form_diplome'] ?? [];
$form_etabs = $_POST['form_etablissement'] ?? [];
$form_debuts = $_POST['form_debut'] ?? [];
$form_fins = $_POST['form_fin'] ?? [];
$form_descs = $_POST['form_description'] ?? [];


$html = "
<!DOCTYPE html>
<html lang='fr'>
<head>
<meta charset='UTF-8'>
<style>
@page { margin: 0px; }
body { margin: 0px; padding: 0px; font-family: Arial, sans-serif; background-color: #f5f1ed; }
/* شريط جانبي ثابت لملء الصفحة لأسفلها */
.sidebar-bg {
position: fixed;
top: 0; left: 0; bottom: 0;
width: 30%; background-color: #b39090;
z-index: -1;
}

.container { width: 100%; display: block; }

.left-col { width: 30%; float: left; padding: 40px 20px; color: #333; box-sizing: border-box; }
.right-col { width: 70%; float: left; padding: 40px 30px; box-sizing: border-box; }

h1 { font-size: 26px; text-transform: uppercase; margin: 0; color: #333; }
.job-title { font-size: 18px; color: #666; font-weight: bold; margin-bottom: 20px; }
h3 { border-bottom: 2px solid #333; padding-bottom: 5px; text-transform: uppercase; font-size: 14px; margin-top: 25px; }

p, li { font-size: 13px; line-height: 1.5; }
ul { padding-left: 15px; }
.date { font-size: 11px; font-weight: bold; color: #555; }
.entry { margin-bottom: 15px; }
.clearfix::after { content: ''; clear: both; display: table; }
</style>
</head>
<body>
<div class='sidebar-bg'></div>

<div class='container clearfix'>
<div class='left-col'>
<h3>👤 CONTACT</h3>
<p><strong>Email:</strong><br>$email</p>
<p><strong>Tel:</strong><br>$telephone</p>

<h3>🔧 COMPÉTENCES</h3>
<ul>";
foreach ($competences as $skill) {
$html .= "<li>" . htmlspecialchars($skill) . "</li>";
}
$html .= "</ul>
</div>

<div class='right-col'>
<h1>$prenom $nom</h1>
<div class='job-title'>$titre</div>

<h3>📝 PROFIL</h3>
<p>" . nl2br($profil) . "</p>

<h3>💼 EXPÉRIENCES PROFESSIONNELLES</h3>";
foreach ($exp_postes as $i => $poste) {
if (!empty(trim($poste))) {
$html .= "<div class='entry'>
<strong>" . htmlspecialchars($poste) . "</strong> @ " . htmlspecialchars($exp_entrs[$i] ?? '') . "<br>
<span class='date'>" . htmlspecialchars($exp_debuts[$i] ?? '') . " - " . htmlspecialchars($exp_fins[$i] ?? '') . "</span>
<p>" . nl2br(htmlspecialchars($exp_descs[$i] ?? '')) . "</p>
</div>";
}
}

$html .= "<h3>🎓 FORMATIONS</h3>";
foreach ($form_diplomes as $i => $diplome) {
if (!empty(trim($diplome))) {
$html .= "<div class='entry'>
<strong>" . htmlspecialchars($diplome) . "</strong><br>
" . htmlspecialchars($form_etabs[$i] ?? '') . " |
<span class='date'>" . htmlspecialchars($form_debuts[$i] ?? '') . " - " . htmlspecialchars($form_fins[$i] ?? '') . "</span>
<p>" . nl2br(htmlspecialchars($form_descs[$i] ?? '')) . "</p>
</div>";
}
}
$html .= "
</div>
</div>
</body>
</html>";


$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("CV_" . $nom . ".pdf", ["Attachment" => true]);

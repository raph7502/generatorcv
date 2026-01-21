<! DOCTYPE html> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <title>Créer mon CV - Générateur de CV</title> 
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="Assets/css/style.css">
</head>
</head>
<body>
   <body>
    <div class="container-fluid py-4">
        <div class="row">
            <!-- COLONNE GAUCHE :   FORMULAIRE -->
            <div class="col-lg-6">
                <h2 class="mb-4">✍️ Remplissez vos informations</h2>
                
                <form id="cvForm" method="POST" action="export.php">
                    
                    <!-- Section :   Informations personnelles -->
                    <div class="form-section">
                        <h4 class="section-title">👤 Informations personnelles</h4>
                        
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre professionnel</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="Ex: Développeur Web Full Stack">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone">
                            </div>
                        </div>
                    </div>

                    <!-- Section :  Profil -->
                    <div class="form-section">
                        <h4 class="section-title">📝 Profil</h4>
                        <div class="mb-3">
                            <label for="profil" class="form-label">Résumé professionnel</label>
                            <textarea class="form-control" id="profil" name="profil" rows="4" placeholder="Décrivez-vous en quelques lignes..."></textarea>
                        </div>
                    </div>

                    <!-- Section :   Expériences -->
                    <div class="form-section">
                        <h4 class="section-title">💼 Expériences professionnelles</h4>
                        <div id="experiences-container">
                            <div class="experience-group mb-3">
                                <input type="text" class="form-control mb-2" name="exp_poste[]" placeholder="Poste occupé">
                                <input type="text" class="form-control mb-2" name="exp_entreprise[]" placeholder="Entreprise">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control mb-2" name="exp_debut[]" placeholder="Date début">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control mb-2" name="exp_fin[]" placeholder="Date fin">
                                    </div>
                                </div>
                                <textarea class="form-control" name="exp_description[]" rows="2" placeholder="Description de vos missions..."></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="addExperience">+ Ajouter une expérience</button>
                    </div>

                    <!-- Section :   Formations -->
                    <div class="form-section">
                        <h4 class="section-title">🎓 Formations</h4>
                        <div id="formations-container">
                            <div class="formation-group mb-3">
                                <input type="text" class="form-control mb-2" name="form_diplome[]" placeholder="Diplôme">
                                <input type="text" class="form-control mb-2" name="form_etablissement[]" placeholder="Établissement">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control mb-2" name="form_debut[]" placeholder="Date début">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control mb-2" name="form_fin[]" placeholder="Date fin">
                                    </div>
                                </div>
                                <textarea class="form-control" name="form_description[]" rows="2" placeholder="Description..."></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="addFormation">+ Ajouter une formation</button>
                    </div>

                    <!-- Section :  Compétences -->
                    <div class="form-section">
                        <h4 class="section-title">🔧 Compétences</h4>
                        <div class="mb-3">
                            <label for="competences" class="form-label">Compétences (séparez par des virgules)</label>
                            <input type="text" class="form-control" id="competences" name="competences" placeholder="HTML, CSS, JavaScript, PHP, MySQL">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100">Générer mon CV en PDF 📄</button>
                </form>
            </div>

            <!-- COLONNE DROITE :   PRÉVISUALISATION -->
            <div class="col-lg-6">
                <h2 class="mb-4">👁️ Aperçu en temps réel</h2>
                <div class="cv-preview" id="cvPreview">
                    
                    <header class="cv-header">
                        <h1 class="cv-name" id="preview-nom">Prénom Nom</h1>
                        <h2 class="cv-title" id="preview-titre">Votre titre professionnel</h2>
                        <div class="cv-contact mt-3">
                            <span id="preview-email">email@exemple.com</span> | 
                            <span id="preview-telephone">06 00 00 00 00</span>
                        </div>
                    </header>

                    <section id="section-profil" style="display: none;">
                        <h3 class="cv-section-title">Profil</h3>
                        <p id="preview-profil"></p>
                    </section>

                    <section id="section-experiences">
                        <h3 class="cv-section-title">Expériences professionnelles</h3>
                        <div id="preview-experiences"><p class="text-muted">Aucune expérience ajoutée</p></div>
                    </section>

                    <section id="section-formations">
                        <h3 class="cv-section-title">Formations</h3>
                        <div id="preview-formations"><p class="text-muted">Aucune formation ajoutée</p></div>
                    </section>

                    <section id="section-competences" style="display: none;">
                        <h3 class="cv-section-title">Compétences</h3>
                        <ul class="cv-skills-list" id="preview-competences"></ul>
                    </section>

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap. bundle.min.js"></script>
    <script src="Assets/js/main.js"></script>
</body>
</html>
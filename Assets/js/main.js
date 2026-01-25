
function updatePreview() {

    const prenom = document.getElementById('prenom')?.value || 'Prénom';
    const nom = document.getElementById('nom')?.value || 'Nom';
    const titre = document.getElementById('titre')?.value || 'Votre titre professionnel';
    const email = document.getElementById('email')?.value || 'email@exemple.com';
    const telephone = document.getElementById('telephone')?.value || '06 00 00 00 00';

    const previewNom = document.getElementById('preview-nom');
    const previewTitre = document.getElementById('preview-titre');
    const previewEmail = document.getElementById('preview-email');
    const previewTelephone = document.getElementById('preview-telephone');

    if (previewNom) previewNom.textContent = `${prenom} ${nom}`;
    if (previewTitre) previewTitre.textContent = titre;
    if (previewEmail) previewEmail.textContent = email;
    if (previewTelephone) previewTelephone.textContent = telephone;


    const profil = document.getElementById('profil')?.value || '';
    const sectionProfil = document.getElementById('section-profil');
    const previewProfil = document.getElementById('preview-profil');

    if (sectionProfil && previewProfil) {
        if (profil.trim()) {
            sectionProfil.style.display = 'block';
            previewProfil.textContent = profil;
        } else {
            sectionProfil.style.display = 'none';
        }
    }


    updateExperiences();


    updateFormations();


    const competences = document.getElementById('competences')?.value || '';
    const sectionCompetences = document.getElementById('section-competences');
    const previewCompetences = document.getElementById('preview-competences');

    if (sectionCompetences && previewCompetences) {
        if (competences.trim()) {
            sectionCompetences.style.display = 'block';
            const skills = competences.split(',').map(s => s.trim()).filter(s => s);
            previewCompetences.innerHTML = skills.map(skill =>
                `<li class="cv-skill">${skill}</li>`
            ).join('');
        } else {
            sectionCompetences.style.display = 'none';
        }
    }
}


function updateExperiences() {
    const postes = document.querySelectorAll('input[name="exp_poste[]"]');
    const entreprises = document.querySelectorAll('input[name="exp_entreprise[]"]');
    const debuts = document.querySelectorAll('input[name="exp_debut[]"]');
    const fins = document.querySelectorAll('input[name="exp_fin[]"]');
    const descriptions = document.querySelectorAll('textarea[name="exp_description[]"]');

    const previewExperiences = document.getElementById('preview-experiences');
    if (!previewExperiences) return;

    let html = '';

    for (let i = 0; i < postes.length; i++) {
        const poste = postes[i]?.value || '';
        const entreprise = entreprises[i]?.value || '';
        const debut = debuts[i]?.value || '';
        const fin = fins[i]?.value || '';
        const description = descriptions[i]?.value || '';

        if (poste || entreprise) {
            html += `
                <div class="experience-item">
                    <div><strong>${poste || 'Poste'}</strong> - ${entreprise || 'Entreprise'}</div>
                    <div class="text-muted small">${debut || 'Date début'} - ${fin || 'Date fin'}</div>
                    <p class="mb-0 mt-2">${description}</p>
                </div>
            `;
        }
    }

    previewExperiences.innerHTML = html || '<p class="text-muted">Aucune expérience ajoutée</p>';
}


function updateFormations() {
    const diplomes = document.querySelectorAll('input[name="form_diplome[]"]');
    const etablissements = document.querySelectorAll('input[name="form_etablissement[]"]');
    const debuts = document.querySelectorAll('input[name="form_debut[]"]');
    const fins = document.querySelectorAll('input[name="form_fin[]"]');
    const descriptions = document.querySelectorAll('textarea[name="form_description[]"]');

    const previewFormations = document.getElementById('preview-formations');
    if (!previewFormations) return;

    let html = '';

    for (let i = 0; i < diplomes.length; i++) {
        const diplome = diplomes[i]?.value || '';
        const etablissement = etablissements[i]?.value || '';
        const debut = debuts[i]?.value || '';
        const fin = fins[i]?.value || '';
        const description = descriptions[i]?.value || '';

        if (diplome || etablissement) {
            html += `
                <div class="formation-item">
                    <div><strong>${diplome || 'Diplôme'}</strong> - ${etablissement || 'Établissement'}</div>
                    <div class="text-muted small">${debut || 'Date début'} - ${fin || 'Date fin'}</div>
                    <p class="mb-0 mt-2">${description}</p>
                </div>
            `;
        }
    }

    previewFormations.innerHTML = html || '<p class="text-muted">Aucune formation ajoutée</p>';
}


function setupAddExperience() {
    const addBtn = document.getElementById('addExperience');
    if (!addBtn) return;

    addBtn.addEventListener('click', function () {
        const container = document.getElementById('experiences-container');
        if (!container) return;

        const newExp = document.createElement('div');
        newExp.className = 'experience-group mb-3';
        newExp.innerHTML = `
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
            <textarea class="form-control mb-2" name="exp_description[]" rows="2" placeholder="Description de vos missions... "></textarea>
            <button type="button" class="btn btn-sm btn-danger remove-item">Supprimer</button>
        `;
        container.appendChild(newExp);
        attachEventListeners();
    });
}


function setupAddFormation() {
    const addBtn = document.getElementById('addFormation');
    if (!addBtn) return;

    addBtn.addEventListener('click', function () {
        const container = document.getElementById('formations-container');
        if (!container) return;

        const newForm = document.createElement('div');
        newForm.className = 'formation-group mb-3';
        newForm.innerHTML = `
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
            <textarea class="form-control mb-2" name="form_description[]" rows="2" placeholder="Description... "></textarea>
            <button type="button" class="btn btn-sm btn-danger remove-item">Supprimer</button>
        `;
        container.appendChild(newForm);
        attachEventListeners();
    });
}


function attachEventListeners() {

    document.querySelectorAll('#cv.php input, #cv.php textarea').forEach(input => {
        input.removeEventListener('input', updatePreview);
        input.addEventListener('input', updatePreview);
    });


    document.querySelectorAll('. remove-item').forEach(btn => {
        btn.removeEventListener('click', handleRemove);
        btn.addEventListener('click', handleRemove);
    });
}


function handleRemove(e) {
    e.target.parentElement.remove();
    updatePreview();
}


document.addEventListener('DOMContentLoaded', function () {
    setupAddExperience();
    setupAddFormation();
    attachEventListeners();
    updatePreview();
});
<!DOCTYPE html> 
<html lang="fr"> 
    <head> 
        <meta charset="UTF-8" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <title>Générateur de CV</title> 
         <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    </head> 
       <body>
         <h1>Générateur de CV</h1>

         <form action="" method="post">
          <label for="prenom"></label>
          <input type="text" >
         </form>
         <div id="cv-preview" class="cv-container p-4">


  <header class="cv-header mb-4">
    <h1 id="cv-name" class="cv-name">Prénom Nom</h1>
    <h2 id="cv-title" class="cv-title text-muted">Développeur Web</h2>

    <div class="cv-contact">
      <span id="cv-email" class="cv-email">mail.e@email.com</span><br>
      <span id="cv-phone" class="cv-phone">06 00 00 00 00</span>
    </div>
  </header>

  <section id="cv-profile" class="cv-section mb-3">
    <h3 class="cv-section-title">Profil</h3>
    <p id="cv-summary" class="cv-summary">
      Développeur web passionné avec une expérience en HTML, CSS, JavaScript et PHP.
    </p>
  </section>

  <section id="cv-experiences" class="cv-section mb-3">
    <h3 class="cv-section-title">Expériences professionnelles</h3>

    <div class="cv-experience">
      <div class="cv-experience-header">
        <span class="cv-experience-job">Développeur Web</span>
        <span class="cv-experience-company">WebAgency</span>
      </div>

      <div class="cv-experience-dates">
        <span class="cv-experience-start">Janvier 2025</span>
        <span class="cv-experience-end">Aujourd’hui</span>
      </div>

      <p class="cv-experience-description">
        Création de sites web, intégration HTML/CSS, développement JavaScript.
      </p>
    </div>

  </section>

  <section id="cv-formations" class="cv-section mb-3">
    <h3 class="cv-section-title">Formations</h3>

    <div class="cv-formation">
      <div class="cv-formation-header">
        <span class="cv-formation-title">BTS SIO</span>
        <span class="cv-formation-school"></span>
      </div>

      <div class="cv-formation-dates">
        <span class="cv-formation-start"></span>
        <span class="cv-formation-end"></span>
      </div>

      <p class="cv-formation-description">
        Option SLAM, développement d’applications web.
      </p>
    </div>

  </section>

  <section id="cv-competences" class="cv-section mb-3">
    <h3 class="cv-section-title">Compétences</h3>

    <ul class="cv-skills-list">
      <li class="cv-skill">HTML / CSS</li>
      <li class="cv-skill">JavaScript</li>
      <li class="cv-skill">PHP / MySQL</li>
      <li class="cv-skill">Bootstrap</li>
    </ul>
  </section>

</div>


        </body> 
 </html>
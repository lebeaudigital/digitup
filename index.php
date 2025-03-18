<?php require_once __DIR__.'/views/config/sessionAuth.php' ?>
<?php require __DIR__.'/views/blocs/doctype.php' ?>


<!-- 
<div>
<a href="<?= $path ?>generate_pdf.php" target="_blank" class="btn btn-primary">générer un pdf</a>
</div> -->

<nav class="sticky-nav navbar navbar-expand d-none d-md-block">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" href="#home">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#features">Fonctionnalités</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#pricing">Tarifs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#faq">F.A.Q</a>
        </li>
    </ul>
</nav>

<header>
    <section class="hero_section py-5" id="home">
        <aside class="under_hero">
            <svg id="animated-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2062.37 882.67">
                <path class="cls-1" d="M.4,129.64C125.48-33.47,462.86-39.44,676.93,96.86c286.31,182.3,254.59,732.82-37.66,746.41-286.43,13.32-289.28-292.86-274.13-373.71C405.92,251.98,553.73,60.9,891.21,60c219.28-.58,396.36,103.48,463.76,157.87,249,200.92,265.25,654.86-31.53,664.21-271.76,8.56-311.7-532.46-1.81-652.48,357.49-138.46,651.15,159.95,740.36,255.74" fill="none"/>
            </svg>
        </aside>

        <main class="front_hero">
            <div class="heroTitles">
                <p class="animateAfterH1 text-center mb-3 h3 fw-light fs-5">Learning Management System 🎓</p>
                <h1 class="d-flex flex-wrap flex-column text-center col-12">
                    <span class="line d-block">Bienvenue sur <span class="text-light-purple">Digitup</span>,</span>
                    <span class="line d-block">La <span class="text-light-success">plateforme</span> LMS <span class="text-light-primary">simple.</span></span>
                </h1>
                <p class="animateAfterH1 w-100 text-center fw-light display-6 mt-3">Créer et diffuser des formations e-learning est un jeu d'enfant.</p>
                <a href="<?= $path ?>login.php" class="animateAfterH1 mt-4 btn btn-light-purple btn-lg px-4 py-2 rounded-pill">Commencer</a>
            </div>
            <div class="animated-boxes d-flex flex-wrap justify-content-center mt-5">
                <div class="box bg-white shadow d-none d-lg-flex flex-column justify-content-center align-content-center align-items-center p-4">
                    <img src="<?= $path ?>assets/img/user1.jpg" width="80" height="80" class="rounded-pill">
                    <p class="text-center mt-2 mb-2">Plateforme intuitive et rapide pour créer une formation e-learning.</p>
                    <div class="stars">
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                    </div>
                </div>
                <div class="box bg-white shadow d-none d-lg-flex flex-column justify-content-center align-content-center align-items-center p-4">
                    <img src="<?= $path ?>assets/img/user3.jpg" width="80" height="80" class="rounded-pill">
                    <p class="text-center mt-2 mb-2">Je glisse mon fichier SCORM, et c'est déjà presque terminé !</p>
                    <div class="stars">
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                    </div>
                </div>
                <div class="box bg-white shadow d-none d-lg-flex flex-column justify-content-center align-content-center align-items-center p-4">
                    <img src="<?= $path ?>assets/img/user5.jpg" width="80" height="80" class="rounded-pill">
                    <p class="text-center mt-2 mb-2">Plus besoin de chercher, nous avons trouvé LA bonne plateforme !</p>
                    <div class="stars">
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                    </div>
                </div>
                <div class="box bg-white shadow d-none d-lg-flex flex-column justify-content-center align-content-center align-items-center p-4">
                    <img src="<?= $path ?>assets/img/user4.jpg" width="80" height="80" class="rounded-pill">
                    <p class="text-center mt-2 mb-2">C'est rapide, les équipes sont contentes donc je suis contente 🚀.</p>
                    <div class="stars">
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                    </div>
                </div>
            </div>
        </main>
    </section>
</header>

<section id="features" class="container py-5 my-5 px-4 px-xxl-0 h-100">
    <div class="pb-5 d-flex justify-content-center col-12">
        <div class="col-12 col-md-5">
            <h2 class="text-center">Boostez la performance de votre équipe !</h2>
            <p class="text-center">De l’amélioration continue au développement des compétences, en passant par la conformité, Digitup vous accompagne avec des solutions sur mesure. 🚀</p>
        </div>
    </div>
    <div class="row align-items-stretch g-4">
        <div class="col-12 col-md-3 align-items-stretch">
            <article class="border border-1 bg-white rounded-5 p-4 d-flex flex-column justify-content-start h-100">
                <div>
                    <span class="badge badge-light-success mb-5">Académie</span>
                    <h3 class="mb-3" style="text-wrap:balance">Une académie corporate</h3>
                    <p class="mb-5">Accompagnez vos clients dans l'utilisation de vos produits / services via une académie en accès libre ou payant selon votre modèle.</p>
                </div>
                <div class="h-100">
                    <img src="<?= $path ?>assets/img/jason-goodman-Kt-E_Qq8DW4-unsplash.jpg" class="img-fluid rounded-4 h-100 w-100" alt="User interaction">
                </div>
            </article>
        </div>
        <div class="col-12 col-md-6 align-items-stretch">
            <article class="d-flex flex-column justify-content-between h-100">
                <div class="h-100 rounded-5" style="background:url('<?= $path ?>assets/img/brooke-cagle-g1Kr4Ozfoac-unsplash.jpg');background-size:cover;background-position:center center;height:100%;background-repeat:no-repeat">
                </div>
                <div class="mt-4">
                    <div class="row align-items-stretch g-4">
                        <div class="col-12 col-md-8 align-items-stretch">
                            <article class="border border-1 bg-white rounded-5 p-4 d-flex flex-column justify-content-between h-100">
                                <div>
                                    <span class="badge badge-light-purple mb-5">Formations</span>
                                    <h3 class="mb-3" style="text-wrap:balance">Votre marque inspire la confiance ?</h3>
                                    <p class="">Une académie e-learning en marque blanche permet de proposer des formations sous votre identité. Cette solution offre une plateforme clé en main, adaptable aux besoins spécifiques avec gestion des utilisateurs, suivi des progrès et intégration SCORM.</p>
                                </div>
                            </article>
                        </div>
                        <div class="col-12 col-md-4 align-items-stretch">
                            <div class="row align-items-stretch g-4">
                                <div class="col-12 align-items-stretch">
                                    <article class="bg-primary text-white rounded-5 p-3 d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <p class="display-4 h3">93 %</p>
                                            <p class="small">des entreprises estiment que l’apprentissage personnalisé améliore l’engagement.</p>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-12 align-items-stretch">
                                    <article class="bg-dark text-white rounded-5 p-3 d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <p class="display-5 h1">83 %</p>
                                            <p class="small">des entreprises ont adopté un LMS.</p>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-12 col-md-3 align-items-stretch">
            <article class="border border-1 bg-white rounded-5 p-4 d-flex flex-column justify-content-start h-100">
                <div>
                    <span class="badge badge-light-yellow mb-5">Parcours</span>
                    <h3 class="mb-3" style="text-wrap:balance">Des parcours pédagogiques captivants</h3>
                    <p class="mb-5">Gérez vos apprenants et donnez accès à vos contenus pédagogiques simplement tout au long de leur parcours.</p>
                </div>
                <div class="h-100">
                    <img src="<?= $path ?>assets/img/annie-spratt-vGgn0xLdy8s-unsplash.jpg" class="img-fluid rounded-4 h-100 w-100" alt="User interaction">
                </div>
            </article>
        </div>
    </div>
</section>

<section id="pricing" class="container my-5 py-5">
    <div class="pb-5 d-flex justify-content-center col-12">
        <div class="col-12 col-md-5">
        <h2 class="text-center">Choisissez selon votre projet</h2>
        <p class="text-center">Toutes nos offres incluent les apprenants et les contenus <span class="fw-bold">en illimité</span></p>
        </div>
    </div>
    <main class="d-flex justify-content-center">
        <div class="col-12 col-md-9 row align-items-stretch g-4">
            <div class="col-12 col-md-6 align-items-stretch">
                <article class="border border-1 bg-white rounded-4 p-4 d-flex flex-column justify-content-start h-100">
                    <p class="mb-0">à partir de</p>
                    <h3 class="h2">3 490 € HT / an</h3>
                    <p>Lancez votre Académie en marque blanche, sans limite d'apprenants, à un prix compétitif tout inclus !</p>
                    <hr>
                    <div class="d-flex flex-column justify-content-between h-100">
                        <ul class="list-group list-group-flush mt-4">
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Plateforme en marque blanche</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Intégration de fichiers SCORM</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Contenus textes, images, quiz, vidéos...</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Génération d'attestation de formation</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Responsable de compte dédié</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Accompagnement 3 mois inclus</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Serveur mutualisé hébergé en UE</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Connexion SSO (optionnel)</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> 3 Administrateurs (extensible)</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Support en Français</li>
                        </ul>
                        <div class="mt-4 w-100 d-flex flex-column justify-content-end h-100">
                            <a href="" class="btn btn-light-yellow-outline py-3">Demander une démo</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-12 col-md-6 align-items-stretch">
                <article class="border border-2 border-yellow bg-white rounded-4 p-4 d-flex flex-column h-100">
                    <p class="mb-0">Tarif</p>
                    <h3 class="h2">À la carte</h3>
                    <p>Nous vous accompagnons à chaque étape pour vous offrir un LMS taillé pour votre entreprise.</p>
                    <hr> 
                    <div class="d-flex flex-column justify-content-between h-100"></div>
                        <ul class="list-group list-group-flush mt-4">
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Plateforme en marque blanche</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Intégration de fichiers SCORM</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Contenus textes, images, quiz, vidéos...</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Génération d'attestation de formation</li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bxs-check-circle text-light-success me-3'></i> Responsable de compte dédié</li>
                            <li class="d-flex align-items-center mb-3 fw-bold"><i class='bx bxs-check-circle text-light-success me-3'></i> Accompagnement sur-mesure</li>
                            <li class="d-flex align-items-center mb-3 fw-bold"><i class='bx bxs-check-circle text-light-success me-3'></i> Serveur dédié (ou votre serveur)</li>
                            <li class="d-flex align-items-center mb-3 fw-bold"><i class='bx bxs-check-circle text-light-success me-3'></i> Connexion SSO sans-frais d'installation</li>
                            <li class="d-flex align-items-center mb-3 fw-bold"><i class='bx bxs-check-circle text-light-success me-3'></i> Nombre d'administrateurs illimité</li>
                            <li class="d-flex align-items-center mb-3 fw-bold"><i class='bx bxs-check-circle text-light-success me-3'></i> Support en Français / Anglais</li>
                            <li class="d-flex align-items-center mb-3 fw-bold"><i class='bx bxs-check-circle text-light-success me-3'></i> Connecteur et support API inclus</li>
                        </ul>
                        <div class="mt-4 w-100 d-flex flex-column justify-content-end h-100">
                            <a href="" class="btn btn-light-yellow py-3">Demander une démo</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </main>
</section>

<section id="faq">
    <div class="container py-5 my-5">
        <div class="pb-5 d-flex justify-content-center col-12">
            <div class="col-12 col-md-5">
            <h2 class="text-center">Parce que vous avez des questions, nous y répondons !</h2>
            <p class="text-center">Nous avons collecté vos questions les plus fréquentes</p>
            </div>
        </div>
        <main class="pb-4 d-flex justify-content-center flex-wrap col-12">
            <div class="col-12 col-md-8 accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h4 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
                        <span class="w-75">Est-il possible de bénéficier d'une période d'essai sur la plateforme ?</span>
                            </button>
                    </h4>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Tout à fait ! 😀</p>
                            <p>Après une démonstration par l'un de nos collaborateur, nous faisons tester Digitup pour une période de 7 jours, où vous pourrez tester les différents contenus disponibles, intégrer vos fichiers SCORM, ou encore nous poser vos questions.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h4 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                        <span class="w-75">Peux-t-on intégrer des fichiers SCORM ?</span>
                            </button>
                    </h4>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Oui !</p>
                            <p>Digitup est prévu pour fonctionner avec vos exports SCORM, et ce, peut importe le logiciel que vous utilisez (StoryLine, Genially...). Le plus simple c'est de tester ! 😉</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h4 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                <span class="">Mon entreprise est déjà abonnée à une plateforme LMS. <br>Je voudrais passer sur Digitup. Quelle est la marche à suivre ?</span>
                            </button>
                    </h4>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Nous vous remercions pour l'intêret que vous portez à Digitup !</p>
                            <p>Pour nous rejoindre, rien de plus simple ! Il suffit de demander une démo à nos équipes et de rapatrier vos fichiers. Nous vous aiderons à tout reprendre de l'ancienne plateforme pendant votre accompagnement.</p>
                            <p>Lors de la mise en place de Digitup, nous pourrons aussi récupérer vos apprenants.</p>
                            <h4 class="fw-bold">⚠️ Attention aux mots de passe :</h4>
                            <p>À moins, d'utiliser un SSO (Single Sign On), vos apprenants devront réinitialiser leur mot de passe sur Digitup après un envoi de mail global.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h4 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                            <span class="w-75">Comment fonctionne l'API Digitup ?</span>
                        </button>
                    </h4>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body w-75">
                            <p>L'API Digitup fonctionne comme beaucoup d'API. Les modules et parcours de formations sont hébergés sur nos serveurs, mais il est très facile d'y accéder via des "méthodes" <code>(POST, PUT, GET ou DELETE)</code>.</p>
                            <p>L'API permet donc d'enregistrer des nouveaux modules depuis un site externe à Digitup. Vous pourrez ainsi lire ou ajouter de nouveaux modules de formation depuis votre site internet par exemple.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div class="d-flex flex-wrap justify-content-center">
            <a class="btn btn-light-yellow py-3 px-5">Demander une démo</a>
        </div>
    </div>
</section>


 
  
    
 
  



<?php require __DIR__.'/views/blocs/footer.php' ?>
<?php require __DIR__.'/views/blocs/end.php' ?>

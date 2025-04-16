document.addEventListener("DOMContentLoaded", function () {
    const champs = window.calculData.champs;
    const expression = window.calculData.expression;

    document.getElementById('btn-resultat').addEventListener('click', function () {
        console.log("🔍 Bouton 'Calculer' cliqué");
        calculer();
        // ===========================
        calculData.champs.forEach(function(champ) {
            const inputValue = document.getElementById(champ).value;
            document.getElementById('pdf-' + champ).value = inputValue;
        });
        // ===========================
    });

    function calculer() {
        const valeurs = {};
        console.log("🔍 Début de la fonction calculer");

        for (const nom of champs) {
            const champ = document.getElementById(nom);
            if (champ && champ.value !== "") {
                const valeur = parseFloat(champ.value);
                valeurs[nom] = valeur;
                console.log(`🔍 Valeur du champ ${nom}:`, valeur);

                const tdValeur = document.getElementById(`valeur-${nom}`);
                if (tdValeur) {
                    tdValeur.innerText = valeur;
                    console.log(`🔍 Injecté dans le tableau: valeur-${nom} =`, valeur);
                }
            } else {
                document.getElementById('resultat').innerText = "Veuillez remplir tous les champs.";
                alert("⚠️ Veuillez remplir tous les champs avant de calculer.");
                return;
            }
        }

        try {
            let formuleCalculee = expression;
            Object.keys(valeurs).forEach(key => {
                // formuleCalculee = formuleCalculee.replace(new RegExp('\\b' + key + '\\b', 'g'), valeurs[key]);
                formuleCalculee = formuleCalculee.replaceAll(`{${key}}`, valeurs[key]);

            });
            console.log("🔍 Expression après remplacement :", formuleCalculee);

            let resultat = eval(formuleCalculee);
            resultat = Math.round(resultat * 10000) / 10000;

            document.getElementById('resultat').innerText = resultat + ' mm';
            document.getElementById('resultat-tableau').innerText = resultat + ' mm';

            console.log("✅ Résultat calculé :", resultat);
        } catch (error) {
            console.error("❌ Erreur dans le calcul :", error);
            document.getElementById('resultat').innerText = "Erreur dans le calcul.";
        }
    }

    window.calculer = calculer;
});

// ✅ Génération du PDF
function generatePDF() {
    const element = document.getElementById('pdf-content');
    console.log("🔍 Début de generatePDF()");
    
    // Vérification du contenu
    if (!element) {
        alert("❌ Élément PDF introuvable !");
        return;
    }

    const contenuBrut = element.innerText.trim();
    console.log("🔍 Contenu actuel du PDF :", contenuBrut);

    if (contenuBrut === "") {
        alert("⚠️ Aucun contenu à exporter. Veuillez effectuer le calcul d'abord.");
        return;
    }

    element.classList.remove('hidden');
    console.log("🔍 Élément rendu visible");

    // Pause pour laisser le DOM se mettre à jour
    setTimeout(() => {
        const opt = {
            margin:       0.5,
            filename:     'calcul-resultat.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        };

        console.log("📄 Lancement de html2pdf...");
        html2pdf().set(opt).from(element).save();
    }, 300);
}

window.generatePDF = generatePDF;

// ✅ Affichage du contenu PDF et bouton
let showPDFButton = document.getElementById('show-pdf-btn');
let pdfContent = document.getElementById('pdf-content');
let generatePdfBtn = document.getElementById('generate-pdf-btn');

showPDFButton.addEventListener('click', function () {
    console.log("🔍 Bouton 'Afficher le fichier PDF' cliqué");
    pdfContent.classList.remove('hidden');
    generatePdfBtn.classList.remove('hidden');
});

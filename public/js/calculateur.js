document.addEventListener("DOMContentLoaded", function () {
    const champs = window.calculData.champs;
    const expression = window.calculData.expression;

    document.getElementById('btn-resultat').addEventListener('click', function () {
        calculer();
    });

    function calculer() {
        alert("Calcul lancé !");
        console.log("Champs:", champs);
        console.log("Expression:", expression);

            const valeurs = {};
        
            champs.forEach(nom => {
                const champ = document.getElementById(nom);
                if (champ && champ.value !== "") {
                    valeurs[nom] = parseFloat(champ.value);
                } else {
                    document.getElementById('resultat').innerText = "Veuillez remplir tous les champs.";
                    return;
                }
            });
        
            try {
                // Remplacer les variables dans l'expression avec leurs valeurs
                let formuleCalculee = expression;
                Object.keys(valeurs).forEach(key => {
                    // Utiliser des regex pour remplacer uniquement les variables entières
                    formuleCalculee = formuleCalculee.replace(new RegExp('\\b' + key + '\\b', 'g'), valeurs[key]);
                });
        
                let resultat = eval(formuleCalculee);
                resultat = Math.round(resultat * 10000) / 10000;
        
                document.getElementById('resultat').innerText = resultat + ' mm';
            } catch (error) {
                console.error(error);
                document.getElementById('resultat').innerText = "Erreur dans le calcul.";
            }
        }
        window.calculer = calculer;
    
});

function generatePDF() {
    const element = document.getElementById('pdf-content');
    const opt = {
        margin:       0.5,
        filename:     'calcul-resultat.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
}

window.generatePDF = generatePDF; // Rendre la fonction accessible globalement

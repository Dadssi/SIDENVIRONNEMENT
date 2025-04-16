<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat de calcul - {{ $formule->nom }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            color: #333;
            padding: 20px;
            line-height: 1.6;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap; /* 🛡️ important pour éviter que le contenu déborde */
            gap: 20px; /* espace entre les blocs si nécessaire */
        }
        .logo {
            width: 20%;
        }
        .logo img {
            max-width: 100%;
            height: auto;
        }
        .company-info {
            width: 40%;
            text-align: left;
            font-size: 12px;
        }
        h1, h2, h3 {
            color: #1e3a8a;
        }
        .intro {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #bbb;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
        }
        .result-row {
            background-color: #e7fbe9;
            font-weight: bold;
        }
        footer {
            border-top: 1px solid #ccc;
            padding-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

    <!-- En-tête -->
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('images/sid.png') }}" alt="Logo SID">
        </div>
        <div class="company-info">
            <h2>SID ENVIRONNEMENT</h2>
            <p>15 bd Sebta, complexe Mont-Jolie</p>
            <p>28630 Mohammedia - Maroc</p>
            <p>Email : contact@sidenvironnement.com</p>
            <p>Tél : +212 6 66 23 54 47</p>
            <p>Date : {{ $date }}</p>
        </div>
    </div>

    <!-- Titre et description -->
    <div class="intro">
        <h3>Rapport de calcul : {{ $formule->nom }}</h3>
        <p>
            Ce document présente le résultat du calcul de <strong>{{ $formule->nom }}</strong>,
            réalisé selon les paramètres saisis ci-dessous.
            Le calcul est basé sur la formule suivante :
            <em>{{ $formule->expression }}</em>
        </p>
    </div>

    <!-- Tableau des paramètres -->
    <h3>Détails des paramètres</h3>
    <table>
        <thead>
            <tr>
                <th>Paramètre</th>
                <th>Valeur</th>
                <th>Unité</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formule->champs as $champ)
                <tr>
                    <td>{{ $champ->nom_champ }}</td>
                    <td>{{ $parametres[$champ->nom_champ] ?? '-' }}</td>
                    <td>{{ $champ->unite }}</td>
                    <td>{{ $champ->libelle }}</td>
                </tr>
            @endforeach
            <tr class="result-row">
                <td colspan="3">Résultat Calculé</td>
                <td>{{ $resultat }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Pied de page -->
    <footer>
        SID ENVIRONNEMENT · 15 bd Sebta, complexe Mont-Jolie 28630 Mohammedia - Maroc · contact@sidenvironnement.com · +212 6 66 23 54 47
    </footer>
</body>
</html>

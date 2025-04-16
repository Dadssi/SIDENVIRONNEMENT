<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat du Calcul</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
    </style>
</head>
<body>

    <h1>Résultat du Calcul</h1>

    <p><strong>Formule :</strong> {{ $formule->expression }}</p>

    <h3>Paramètres</h3>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parametres as $cle => $valeur)
                <tr>
                    <td>{{ $cle }}</td>
                    <td>{{ $valeur }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Résultat : {{ $resultat }}</h3>

</body>
</html>

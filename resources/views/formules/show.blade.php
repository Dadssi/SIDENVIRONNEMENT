@extends('layouts.app')

@section('content')
<div class="container w-[90%] mx-auto mt-5 border-2 border-blue-900 rounded-lg shadow-lg p-4 bg-white dark:bg-gray-800">
    <h2 class="my-4 text-center font-bold text-blue-900 dark:text-white">{{ $formule->nom }}</h2>
    <h4 class="my-4 dark:text-white text-center">{{ $formule->description }}</h4>

    <form id="formuleForm" class="mb-4 w-[60%] mx-auto">
        @foreach ($formule->champs as $champ)
        <div class="mb-3 flex flex-col">
            <label for="{{ $champ->nom_champ }}" class="form-label dark:text-white">{{ $champ->libelle }}</label>
            <input type="number" step="any" name="{{ $champ->nom_champ }}" id="{{ $champ->nom_champ }}" class="form-control" required>
        </div>
        @endforeach

        <button type="button" class="btn btn-success text-white bg-green-600 px-4 py-2 rounded" id="btn-resultat">Calculer le résultat</button>
    </form>

    <hr>

    <div class="mt-4">
        <h4 class="font-semi-bold dark:text-white text-blue-700">Résultat :</h4>
        <div class="alert alert-info flex justify-between items-center mt-3" role="alert">
            <h3 id="resultat" class="text-blue-700 dark:text-white font-bold text-lg"></h3>
        </div>
    </div>

    <hr class="mb-4">
    
    <!-- BOUTON GÉNÉRER LE PDF -->
    <div class="text-center mt-6">
        <button id="show-pdf-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-4">
            Afficher le fichier PDF
        </button>
    </div>
    <!-- partie Document pdf -->
    
    <div class="hidden w-4/5 mx-auto bg-white p-6 rounded-lg shadow-md border border-gray-200" id="pdf-content">
        
        <!-- EN-TÊTE -->
        <div class="flex justify-between items-center mb-4">
            <div>
                <!-- <h1 class="text-2xl font-bold text-gray-700">Résultat de Calcul</h1>
                <p class="text-sm text-gray-500">Date : {{ now()->format('d/m/Y') }}</p> -->
                <img src="{{ asset('images/sid.png')}}" alt="sid_logo" class="w-32 h-auto mb-2">
            </div>
            <div class="text-left">
                <h2 class="text-lg font-semibold text-gray-600">SID ENVIRONNEMENT</h2>
                <p class="text-sm text-gray-500">15 bd Sebta, complexe Mont-Jolie 28630 Mohammedia - Maroc</p>
                <p class="text-sm text-gray-500">Email : contact@sidenvironnement.com</p>
                <p class="text-sm text-gray-500">Téléphone : +212 6 66 23 54 47</p>
            </div>
        </div>
        
        <!-- INTRO -->
        <p class="mb-6 text-gray-700 leading-relaxed w-[80%]">
            Ce document présente le résultat du calcul de <strong>{{ $formule->nom }}</strong>, réalisé selon les paramètres saisis ci-dessous.
            Le calcul est basé sur la formule suivante :
                <span class="italic">{{ $formule->expression }}</span>
            </p>
            
            <!-- TABLEAU DES PARAMÈTRES -->
            <table class="w-full text-left border border-gray-300 mb-6">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-500 px-4 py-2 w-1/2">Paramètre</th>
                        <th class="border border-gray-500 px-4 py-2">Valeur</th>
                        <th class="border border-gray-500 px-4 py-2">Unité</th>
                        <th class="border border-gray-500 px-4 py-2">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formule->champs as $champ)
                <tr>
                    <td class="border border-gray-500 px-4 py-2 font-medium">{{ $champ->nom_champ }}</td>
                    <!-- <td class="border border-gray-500 px-4 py-2">valeur</td> -->
                    <td class="border border-gray-500 px-4 py-2 valeur-champ" id="valeur-{{ $champ->nom_champ }}"></td>
                    <td class="border border-gray-500 px-4 py-2">{{ $champ->unite }}</td>
                    <td class="border border-gray-500 px-4 py-2">{{ $champ->libelle }}</td>
                </tr>
                @endforeach
                <!-- LIGNE DU RÉSULTAT -->
                <tr class="bg-gray-100">
                    <td class="border px-4 py-2 font-bold text-gray-800">Résultat Calculé</td>
                    <td id="resultat-tableau" class="border px-4 py-2 font-bold text-lg text-green-600"></td>
                </tr>
            </tbody>
        </table>
        
        <!-- PIED DE PAGE ENTREPRISE -->
        <div class="text-center text-sm text-gray-500 mt-8 border-t pt-4">
            SID ENVIRONNEMENT · 15 bd Sebta, complexe Mont-Jolie 28630 Mohammedia - Maroc · contact@sidenvironnement.ma · +212 6 66 23 54 47
        </div>
    </div>
    
    <div class="text-center mt-6">
        <button id="generate-pdf-btn" onclick="generatePDF()" class="hidden bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-4">
            Générer un PDF
        </button>
    </div>
    
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    window.calculData = {
        champs: {!! json_encode($formule->champs->pluck('nom_champ')) !!},
        expression: {!! json_encode($formule->expression) !!}
    };
</script>
    <script src="{{ asset('js/calculateur.js') }}"></script>





    <!-- Contenu statique -->
<div id="test-pdf" style="padding: 20px; border: 1px solid #ccc; margin-top: 20px;">
  <h1>Bonjour depuis SID Environnement</h1>
  <p>Ceci est un test de génération de PDF avec un contenu simple et statique.</p>
</div>

<!-- Bouton pour générer le PDF -->
<button onclick="genererPDFTest()">Générer PDF test</button>

<!-- Script html2pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- Script JS -->
<script>
  function genererPDFTest() {
    const element = document.getElementById('test-pdf');

    // Options PDF
    const opt = {
      margin:       0.5,
      filename:     'test-pdf.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2 },
      jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    console.log("🚀 Lancement du test PDF");
    html2pdf().set(opt).from(element).save();
  }
</script>
<script>
  console.log("✅ Script html2pdf chargé ?", typeof html2pdf !== 'undefined');
</script>

@endsection
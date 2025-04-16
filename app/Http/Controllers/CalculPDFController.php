<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Formule;

class CalculPDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $formule = Formule::with('champs')->findOrFail($request->formule_id);

        // Récupère les valeurs envoyées par le formulaire
        $parametres = $request->except(['_token', 'formule_id']);

        // Effectue le calcul (tu peux adapter cette logique selon ta méthode)
        $expression = $formule->expression;
        foreach ($parametres as $cle => $valeur) {
            // $expression = str_replace($cle, $valeur, $expression);
            $expression = str_replace('{' . $cle . '}', $valeur, $expression);
        }
        // dd($expression);

        try {
            // Évalue la formule finale
            $resultat = eval("return $expression;");
        } catch (\Throwable $e) {
            return back()->withErrors(['erreur' => 'Erreur lors du calcul']);
        }

        // Génère le PDF depuis une vue dédiée
        $pdf = Pdf::loadView('pdf', [
            'formule' => $formule,
            'parametres' => $parametres,
            'resultat' => $resultat,
            'date' => now()->format('d/m/Y'),
        ]);

        return $pdf->download('resultat-calcul.pdf');
    }
}

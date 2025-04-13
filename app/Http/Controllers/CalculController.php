<?php

namespace App\Http\Controllers;
use App\Models\Formule;
use App\Models\Calcul;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CalculController extends Controller
{
    public function calculer(Request $request)
{
    $formule = Formule::findOrFail($request->formule_id);
    $expression = $formule->expression;

    foreach ($request->except(['_token', 'formule_id']) as $cle => $valeur) {
        $expression = str_replace($cle, $valeur, $expression);
    }

    try {
        // Sécurité : utilise eval seulement si tu maîtrises les entrées
        $resultat = eval("return $expression;");
    } catch (\Throwable $e) {
        $resultat = "Erreur de calcul";
    }

    return view('formules.resultat', compact('resultat', 'formule'));
}



public function genererPDF($id)
{
    $calcul = Calcul::findOrFail($id);

    $pdf = Pdf::loadView('pdf.resultat', compact('calcul'));
    return $pdf->download('resultat.pdf');
}

}

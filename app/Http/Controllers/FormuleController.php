<?php

namespace App\Http\Controllers;

use App\Models\Formule;
use Illuminate\Http\Request;

class FormuleController extends Controller
{
    // public function index(Request $request)
    // {
    //     $search = $request->input('search');
    //     $formules = Formule::where('nom', 'like', "%$search%")->get();

    //     return view('formules.index', compact('formules'));
    // }

    public function index()
{
    $formules = \App\Models\Formule::all();
    return view('formules.index', compact('formules'));
}


    public function show($id)
    {
        $formule = Formule::with('champs')->findOrFail($id);
        return view('formules.show', compact('formule'));
    }
}

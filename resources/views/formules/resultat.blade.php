@extends('layouts.app')
@section('content')
<div class="container text-grey-900 dark:text-white">
    <h2>Résultat : {{ $formule->nom }}</h2>
    <p><strong>Valeur calculée :</strong> {{ $resultat }}</p>
</div>
@endsection
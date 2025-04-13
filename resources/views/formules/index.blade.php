@extends('layouts.app')
@section('content')
<div class="container w-[80%] mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4 text-center text-blue-900 dark:text-white">Liste des formules</h1>
    <input type="text" id="searchInput" class="form-control mb-3 w-full rounded-3xl px-4" placeholder="Chercher une formule...">
    <table class="min-w-full table-auto border-collapse text-gray-900 dark:text-gray-100">
        <thead class="text-gray-800 dark:text-white dark:bg-orange-700">
            <tr>
                <th class="px-2 border dark:bx-white-1 py-3 text-left font-semibold">Nom de la formule</th>
                <th class="px-2 border dark:bx-white-1 py-3 text-left font-semibold">Note de Calcul</th>
                <th class="px-2 border dark:bx-white-1 py-3 text-left font-semibold">Tester</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formules as $formule)
            <tr class="border-b border-orange-700 dark:border-orange-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                <td class="px-2 border dark:bx-white-1 py-4">{{ $formule->nom }}</td>
                <td class="px-2 border dark:bx-white-1 py-4">{{ $formule->expression }}</td>
                <td class="px-2 border dark:bx-white-1 py-4 text-center">
                    <a href="{{ route('formules.show', $formule->id) }}" class="text-center text-orange-600 dark:bg-orange-900 dark:text-white border py-2 px-4 rounded">Commencer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<script>
    const searchInput = document.getElementById('searchInput');
    const formuleList = document.getElementById('formuleList');

    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();
        Array.from(formuleList.children).forEach(item => {
            const text = item.innerText.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endsection
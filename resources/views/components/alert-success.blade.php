@if (session('success'))
    <div class="p-3 mb-3 text-green-800 bg-green-100 border border-green-300 rounded">
        {{ session('success') }}
    </div>
@endif

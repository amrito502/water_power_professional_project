@if (Session::has('success'))
    <div class="p-4 mb-3 bg-green-200 border-green-600 rounded-sm shadow-sm">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="p-4 mb-3 bg-red-200 border-red-600 rounded-sm shadow-sm">
        {{ Session::get('error') }}
    </div>
@endif

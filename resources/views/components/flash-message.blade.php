
@if (session()->has('status'))
    <div class="fixed bottom-0 right-0 m-6 p-4 bg-green-500 text-white rounded-lg shadow-lg">
        {{ session('status') }}
    </div>
@endif

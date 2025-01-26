{{-- resources/views/admin/search_results.blade.php --}}
<h2>Tenants</h2>
@foreach($tenants as $tenant)
    <div>
        <p>Name: {{ $tenant->user->name }}</p>
        <p>Email: {{ $tenant->user->email }}</p>
        <!-- Add a link for download functionality later -->
    </div>
@endforeach

<h2>Homeowners</h2>
@foreach($homeowners as $homeowner)
    <div>
        <p>Name: {{ $homeowner->user->name }}</p>
        <p>Email: {{ $homeowner->user->email }}</p>
        <!-- Add a link for download functionality later -->
    </div>
@endforeach
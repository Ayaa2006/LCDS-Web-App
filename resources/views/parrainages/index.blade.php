@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="text-center mb-4">Parrainages</h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">List of Parrainages</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name Filleul</th>
                        <th>Name Parrain</th>
                        <th>User ID</th>
                        <th>Referrer ID</th>
                        
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($parrainages as $parrainage)
                        <tr>
                            <td>{{ $parrainage->id }}</td>
                            <td>{{ $parrainage->filleul->name }}</td> 
                            <td>{{ $parrainage->parrain->name }}</td>     
                            <td>{{ $parrainage->user_id }}</td>
                            <td>{{ $parrainage->reff_id }}</td>
                            <td>{{ $parrainage->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $parrainage->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No parrainages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.table').DataTable(); // Optional: Use DataTables for pagination and search
    });
</script>
@endsection

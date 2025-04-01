@extends('layouts.app')

@section('title', 'Activity Log')

@section('contents')
    <div class="container">
        <h1>Activity Log</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activityLogs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->user ? $log->user->name : 'N/A' }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

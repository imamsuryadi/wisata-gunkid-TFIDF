@extends('layouts.dashboard')

@section('title', 'Wisatawan')

@section('judul', 'Wisatawan')

@section('content')
<div class="card shadow border-0">
    <div class="card-body">
        <table class="table table-bordered mt-4" id="datatable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Email</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wisatawan as $index => $w)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $w->email }}</td>
                    <td>{{ $w->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
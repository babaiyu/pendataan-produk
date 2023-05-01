@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif
<div class="container">
<a href="/data-staff/create" class="btn btn-primary mb-3">Tambah Data Staff</a>
<table class="table table-bordered">
<thead>
<tr>
<th>Nama</th>
<th>Jenis Kelamin</th>
<th>User</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($staffs as $staff)
<tr>
<td>{{ $staff->nama }}</td>
<td>{{ $staff->jenis_kelamin }}</td>
<td>{{ $staff->user }}</td>
<td>
<a href="/data-staff/{{ $staff->id }}/edit" class="btn btn-warning">Edit</a>
<form action="/staff/{{ $staff->id }}" method="POST" class="d-inline">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Hapus</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection
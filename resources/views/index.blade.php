@extends('master')
@section('title', 'Halaman Utama Portal - Kabar Burung')
@section('body')
<h1>Portal - Kabar Burung</h1>
<table class="table table-hover table-striped">
<thead>
<tr>
<th>No</th>
<th>Title</th>
<th>Published</th>
<th>Tanggal</th>
</tr>
</thead>
<tbody>
<?php $no=0 ?>
@foreach (App\Models\Post::all() as $post)
<?php $no++ ?>
<tr>
<td>{{ $no }}</td>
<td>{{ $post->title }}</td>
<td>{{ $post->published }}</td>
<td>{{ $post->created_at->format('M d, Y') }}</td>
</tr>
@endforeach
</tbody>
</table>
@stop
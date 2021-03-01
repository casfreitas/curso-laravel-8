@extends('admin.layouts.app')

@section('title', 'Editar post')

@section('content')


	<h1>Editar o post: <strong>{{ $post->title }}</strong></h1>

	<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">

		@method('put') <!-- Método para realizar a edição -->

		@include('admin.includes.form')


	</form>


@endsection
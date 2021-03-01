@extends('admin.layouts.app')

@section('title', 'Listagem dos posts')

@section('content')



	<h1 class="mb-5">Meus Posts</h1>


	<!-- <form class="form-inline col-md-3" action="" method="POST">
	  <div class="form-group">
	    <input type="text" class="form-control" name="search"  placeholder="Busca">
	    <button type="submit" class="btn btn-primary mt-2">Busca</button>
	  </div>
	</form> -->

	<!-- CAMPO BUSCA -->
	<form action="{{ route('posts.search') }}" method="post"> <!-- "ACTION" aponta para a Rota de busca: "posts.search" -->

		@csrf <!-- Token do Laravel que precisa para o formulário funcionar --> 

		<div class="row mb-4">
			<div class="col-md-3">
				<input type="text" name="search" class="form-control" placeholder="Busca"> 
			</div>
			<div class="col">
				<button type="submit" class="btn btn-primary">Buscar</button>
		 	</div>
		</div>

	</form>


	<!-- Esse IF exibe a mensagem de confirmação de cadastro -->
	@if(session('msg'))

		<div class="alert alert-success msg" role="alert">
		  {{ session('msg') }}
		</div>

	@endif


	<table class="table">
	  <thead>
	    <tr>
			<th scope="col">Imagem</th>
			<th scope="col">Título</th>
			<th scope="col">Ações</th>
	    </tr>
	  </thead>
	  <tbody>

	  	@foreach ($posts as $post)

		<tr>
			<td><img src="{{ url("storage/{$post->image}") }}" alt="{{ $post->title }}" style="max-width: 50px;"></td>
			<td scope="row">{{ $post->title }}</td>
			<td><a href="{{ route('posts.show', $post->id) }}">Ver</a> <a href="{{ route('posts.edit', $post->id) }}">Editar</a> </td>
		</tr>

	    @endforeach

	  </tbody>
	</table>

		

	@if (isset($filters))
		{{ $posts->appends($filters)->links() }}
	@else
		{{ $posts->links() }}
	@endif



@endsection


@extends('admin.layouts.app')

@section('title', 'Post')

@section('content')


<h1>Detalhes do post {{ $post->title }}</h1>

<ul>
	<li><strong>Título: </strong>{{ $post->title }}</h1>
	<li><strong>Conteudo: </strong>{{ $post->content }}</h1>
</ul>

<!-- Chama a rota de nome "posts.destroy" passando o ID do arquivo que será excluido -->
<form action="{{ route('posts.destroy', $post->id) }}" method="POST"> 
	@csrf <!-- Diretiva do Laravel para que a operaçãos do form funcione -->
	<input type="hidden" name="_method" value="DELETE">
	<button type="submit">Deletar</button>
</form>

@endsection

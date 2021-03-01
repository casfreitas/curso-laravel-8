	<!-- Validações do formulário -->
	@if($errors->any())
		@foreach($errors->all() as $error)

			<div class="alert alert-danger" role="alert">
			  {{ $error }}
			</div>

		@endforeach
	@endif


	@csrf  <!-- Token do Laravel que é preciso para segurança e envio de dados pelo formulário  -->

	<div class="mb-3">
	  <label for="image" class="form-label">Upload de imagem</label>
	  <input class="form-control" type="file" name="image" id="image">
	</div>
	<div class="mb-3">
	  <label for="exampleFormControlInput1" class="form-label">Título</label>
	  <input type="text" class="form-control" name="title" id="exampleFormControlInput1" value="{{ $post->title ?? old('title') }}">
	</div>
	<div class="mb-3">
	  <label for="exampleFormControlTextarea1" class="form-label">Conteúdo</label>
	  <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3">{{ $post->content ?? old('content') }}</textarea>
	</div>
	<button type="submit" class="btn btn-primary">Cadastrar</button>
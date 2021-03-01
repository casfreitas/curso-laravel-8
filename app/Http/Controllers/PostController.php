<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdadePost; //Inserido para realizar a validação do formulario de posts

use App\Models\Post; //Inserido para chamar o Models/Post.php, necessário para conexão com a tabela "posts".

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PostController extends Controller
{

    //"index" é o nome da classe passada pela routes/web.php
    public function index(){ 

    	//Chamando todos os campos da tabela "posts" do BD, onde "Post" é o nome do Models e "all" chama todos os campos. "all()" ou "get()"

    	//$posts = Post::all();

        //$posts = Post::paginate(3); //Usando paginação

        $posts = Post::orderBy('title', 'DESC')->paginate(5); //Usando paginação e coluna TITLE em ordem decrescente.

    	//Mandando as variáveis para a "view";
    	return view('admin.posts.index', compact('posts')); //Caminho do arquivo index.Blade

    	/* Ou

    	return view('admin.posts.index', [

    		'posts' => $posts

    	]); */

    }


    //Função para receber os parâmentros do formulário dos posts
    public function create(){

    	return view('admin.posts.create');

    }



    //Função para enviar os dados do post para o banco de dados
    public function store(StoreUpdadePost $request){

        $data = $request->all();

        if ($request->image->isValid()){

           $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

           $image = $request->image->storeAs('posts', $nameFile);
           $data['image'] = $image;

        }


    	Post::create($data); //Os campos que serão cadastrados estão no Models/Post.php

        return redirect()->route('posts.index')->with('msg', 'Cadastro criado com sucesso!');
    }



    //Função para exibir as postagem
    public function show($id){

        //$post = Post::where('id', $id)->first(); //Uma outra forma
        $post = Post::find($id); //o ID é passado pela ROTA

        if(!$post) {
            return redirect()->route('posts.index'); /* Se não encontrar o ID, retona
                                                        para a "view" index.blade.php */
        }

        return view('admin.posts.show', compact('post')); /* Os dados serão exibindos em show.blade.php.
                                                            Certifixe se a view foi criada! */
    }





    //Função para deletar um postagem
    public function destroy($id){

        $post = Post::find($id); //o ID é passado pela ROTA

        if (!$post = Post::find($id))

            return redirect()->route('posts.index'); /* Se não encontrar o ID, retona
                                                        para a "view" index.blade.php */

            if (Storage::exists($post->image))
                Storage::delete($post->image);

        $post->delete(); //Deleta o arquivo.

        return redirect()

            ->route('posts.index') //Após a exclusão, será enviado para a view index.blade.php
            ->with('msg', 'Arquivo excluído com sucesso!'); //Envia mensagem de sucesso.        

    }




    //Função para capturar os dados que não serão editados.
    public function edit($id){

        if(!$post = Post::find($id)) {
            return redirect()->back(); /* Se não encontrar o ID, retona
                                          para a "view" anterior. */
        }

        return view('admin.posts.edit', compact('post')); 
    }


    //Função para editar os dados.
    public function update(StoreUpdadePost $request, $id) // O parâmetro "StoreUpdadePost $request" foi inserido para as validações.
    {

        if(!$post = Post::find($id)) {
            return redirect()->back(); /* Se não encontrar o ID, retona
                                          para a "view" anterior. */
        }

        $data = $request->all();

        if ($request->image && $request->image->isValid()){

            if (Storage::exists($post->image))
                Storage::delete($post->image);


           $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

           $image = $request->image->storeAs('posts', $nameFile);
           $data['image'] = $image;

        }


        $post->update($data);

        return redirect()

            ->route('posts.index') //Após a edição, será enviado para a view index.blade.php
            ->with('msg', 'Arquivo atualizado com sucesso!'); //Envia mensagem de sucesso 
    }


    //Função para o campo BUSCA
    public function search(Request $request){

        $filters = $request->except('_token');

        $posts = Post::where('title', 'LIKE', "%{$request->search}%") //Filtrando pelo Titulo

                   ->orWhere('content', 'LIKE', "%{$request->search}%") //"OU" Filtrando pelo Conteúdo
                   ->paginate(3); //Paginando a busca e mostrando 3 por página.

        return view('admin.posts.index', compact('posts', 'filters'));                

    }



}

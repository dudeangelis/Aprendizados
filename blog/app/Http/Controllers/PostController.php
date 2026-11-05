<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10); #Ordena a consulta por created_at em ordem decrescente. Os mais novos posts aparecem primeiro, limitando os resultados a 10 por página com "paginate(10)"
        return view('posts.index', compact('posts')); #Passa o $posts à visão da lâmina.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['slug'=> Str::slug($request->title),]); #Gera uma slug(lesma), a qual serve como um tipo de ponteiro, usando "Str::slug()"

         $validateData = $request->validate([ #Verifica se todos os campos obrigatórios etão presentes e válidos.
            'title'=>'required|max:255',
            'slug'=>'required|unique:posts,slug|max:255',
            'content'=>'required';
            'status'=>'required|in:draft,publish',
         ]);

         Post::create($validateData); #Insere um novo recorde no posts tabela.
         return redirect()->route('posts.index')->with('Sucesso', 'Post criado com sucesso.'); #Envia o usuário de volta para a página de listagem.
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) #Encontra automaticamente o Post com ID 1 e injeta no método.
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->merge(['slug' => Str::slug($request->title), ]);

        $validatedData=$request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|unique:posts, slug,' .$post->id . '|max:255',
            'content'=> 'required',
            'status'=> 'required|in:draft, publish',
        ])

        $post->update($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.' );
    }
}

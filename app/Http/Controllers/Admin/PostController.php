<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validazione dei dati

        $request->validate([
            'title' => 'required|max:60',
            'description' => 'required',
            'category_id' =>'nullable|exists:categories,id'
        ]);




        $newPost = $request->all();
        $new_Post = new Post();
        
        $slug = Str::slug($newPost['title'], '-');
        $slug_base = $slug;
        $slug_alredy_exist = post::where('slug', $slug)->first();
        $counter = 1;
        while($slug_alredy_exist){
            $slug = $slug_base . '-' . $counter;
            $slug_alredy_exist = post::where('slug', $slug)->first();
                
            $counter++;
        }
        $new_Post->slug = $slug;
        

        
        $new_Post->fill($newPost);

        // con il save() salviamo i dati della tabella post
        $new_Post->save();

        // se ci sono salva i dati nella tabella ponte
        // la funzione array_key_exists ritorna vero se in quel array e' presente una key che si chiamo tags
        if(array_key_exists('tags' ,$newPost)){
            $new_Post->tags()->attach($newPost['tags']);
        }
        

        return redirect()->route('admin.posts.index')->with('creato' , 'Hai creato l\' elemento id #' . $new_Post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tags = Tag::all();
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:60',
            'description' => 'required',
            'category_id' =>'nullable|exists:categories,id'
            
        ]);
        $editPost = $request->all();

        // controllo se il titolo e' stato modificato, altrimenti non cambio lo slug,
        // se lo slug nuovo glia esiste creo un contatore da aggiungere alla fine dello slug
       if($editPost['title'] != $post->title){
            $slug = Str::slug($editPost['title'], '-');
            $slug_base = $slug;
            $slug_alredy_exist = post::where('slug', $slug)->first();
            $counter = 1;

            // controllo che lo slug sia univoco
            while($slug_alredy_exist){
                $slug = $slug_base . '-' . $counter;
                $slug_alredy_exist = post::where('slug', $slug)->first();
                
                $counter++;
                
            }
            $editPost['slug'] = $slug;

        }
       $post->update($editPost);
       
       if(array_key_exists('tags' ,$editPost)){
        $post->tags()->sync($editPost['tags']);
    }

       return redirect()->route('admin.posts.index')->with('modifica','Hai modificato l\'elemento #' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // posso anche ometterlo se la relazione onDelete e' cascade
        $post->tags()->detach();    
        

        $post->delete();
        

        return redirect()->route('admin.posts.index')->with('cancella','Hai cancellato l\'elemento #' . $post->id);
    }
}

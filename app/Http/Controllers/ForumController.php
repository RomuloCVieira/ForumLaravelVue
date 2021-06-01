<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Forum;
use App\Models\SubComentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ForumController extends Controller
{
    private Forum $forum;
    private Comentario $comentario;
    private SubComentario $subComentario;

    public function __construct()
    {
        
        $this->forum = new Forum();
        $this->comentario = new Comentario();
        $this->subComentario = new SubComentario();
    }

    public function index()
    {
        $data = $this->forum
              ->leftJoin('users', 'users.id', '=', 'idusuario')->get();
            //   ->where('iusuario', '=', $request->user()->id );
        return Inertia::render('Dashboard', [
            'topicos' => $data
        ]);
    }

    public function create()
    {
        return Inertia::render('Forum/Create');
    }

    public function store(Request $request)
    {
        $data['idusuario'] = $request->user()->id;
        $data = array_merge($data, $request->all());
        $this->forum->create($data);
        return Redirect::route('forum.index')->with('success', 'Tópico criado');
    }

    public function show($id)
    {
        $data = $this->forum->find($id);

        $comentarios = $this->comentario  
        ->join('forums', 'forums.id', '=', 'comentarios.idforum')
        ->select('comentarios.*')
        ->where('idforum', '=', $id)
        ->get();

        $subcomentario = $this->subComentario 
        ->select('sub_comentarios.*')
        ->where('idcomentario', '=', $comentarios->first()->id)
        ->get();
        
        return Inertia::render('Topicos', [
            'topicos' => $data,
            'comentarios' => $comentarios,
            'subcomentarios' => $subcomentario
        ]);
    }

    public function edit(Forum $forum)
    {
        return Inertia::render('Forum/Edit', [
            'forum' => $forum
        ]);
    }

    public function update(Request $request, $id)
    {

        if(!$data = $this->forum->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!!!'],404);
        }

        $dataForm = $request->all();

        $data->update($dataForm);

        return Redirect::route('forum.index')->with('success', 'Forum Atulizado.');
    }

    public function destroy($id)
    {
        $this->forum->destroy($id);
        return Redirect::route('forum.index')->with('success', 'Tópico Excluido');
    }
}

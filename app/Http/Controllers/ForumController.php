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

    public function create()
    {
        return Inertia::render('Forum/Create');
    }

    public function store(Request $request)
    {
        $data['idusuario'] = $request->user()->id;
        $data = array_merge($data, $request->all());
        $this->forum->create($data);
        return Redirect::route('items.index')->with('success', 'Tópico criado');
    }

    public function show($id)
    {
        $data = $this->forum->find($id);

        $subcomentario = $this->subComentario
        ->join('users', 'users.id', '=', 'sub_comentarios.idusuario')
        ->select('sub_comentarios.*', 'users.name')->get();

        $comentarios = $this->comentario  
        ->where('idforum', '=', $id)
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

        return Redirect::route('items.index')->with('success', 'Forum Atulizado.');
    }

    public function destroy($id)
    {
        $this->forum->destroy($id);
        return Redirect::route('items.index')->with('success', 'Tópico Excluido');
    }
}

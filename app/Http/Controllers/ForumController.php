<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ForumController extends Controller
{
    private Forum $forum;
    private Comentario $comentario;

    public function __construct()
    {
        
        $this->forum = new Forum();
        $this->comentario = new Comentario();
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
        $comentarios = $this->comentario->find($id)
        ->join('forums', 'forums.id', '=', 'comentarios.idforum')
        ->select('forums.*', 'forums.id')
        ->where('idforum', '=', $id)
        ->get();
        return Inertia::render('Topicos', [
            'topicos' => $data,
            'comentarios' => $comentarios
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

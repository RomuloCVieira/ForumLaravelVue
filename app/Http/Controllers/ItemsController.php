<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Forum;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ItemsController extends Controller
{
    private $forum;
    private $comentarios;

    public function __construct()
    {
        $this->forum = new Forum();
        $this->comentarios = new Comentario();
    }

    public function index()
    {
        $data = $this->forum
        ->join('users', 'users.id', '=', 'forums.idusuario')
        ->select('forums.*', 'users.name')
        ->get();

        return Inertia::render('Welcome', [
            'topicos' => $data
        ]);
    }

    public function edit($id)
    {
        $data = $this->forum->find($id);

        return Inertia::render('Comentario/Create', [
            'params' => $data
        ]);
    }

    public function store(Request $request, )
    {
        $data['idforum'] = $request->all()['id'];
        $data = array_merge($data, $request->all());
        $this->comentarios->create($data);
        return redirect()->route('forum.show', ['forum' => $data['idforum']]);
    }
   
}

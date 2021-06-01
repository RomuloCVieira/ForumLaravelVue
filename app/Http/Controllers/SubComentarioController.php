<?php

namespace App\Http\Controllers;

use App\Models\SubComentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SubComentarioController extends Controller
{
    private SubComentario $subcomentario;

    public function __construct()
    {
        $this->subcomentario = new SubComentario();
    }

    public function create($comentario, $forum)
    {
        return Inertia::render('SubComentario/Create', [
            'params' => [
                'idcomentario' => $comentario,
                'idforum' => $forum
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->subcomentario->create($data);
        return redirect()->route('forum.show', ['forum' => $data['idforum']]);
    }
}

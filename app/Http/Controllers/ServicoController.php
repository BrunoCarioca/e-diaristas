<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoRequest;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {  
        $servicos = Servico::simplepaginate(10);
        return view('servicos.index')->with('servicos', $servicos);
    }

    public function create() 
    {
        return view('servicos.create');
    }

    public function store( ServicoRequest $request) 
    {
        $data = $request->except('_token');
        Servico::create($data);
        return redirect()->route('servicos.index'); 
    }

    public function edit (int $id) 
    {
        $servico = Servico::findOrFail($id);

        return view('servicos.edit')->with('servico', $servico);
    }

    public function update( int $id, ServicoRequest $request) 
    {
        $data = $request->except(['_token', '_method']);
        
        $servico = Servico::findOrFail($id);

        $servico->update($data);

        return redirect()->route('servicos.index');
    } 


}

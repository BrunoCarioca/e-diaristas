<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoRequest;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    /**
     * lista os serviços
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $servicos = Servico::simplepaginate(10);
        return view('servicos.index')->with('servicos', $servicos);
    }

    /**
     * Mostra o form vazio
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('servicos.create');
    }

    /**
     * Cria um novo registro de servico no bando de dados
     *
     * @param ServicoRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store( ServicoRequest $request)
    {
        $data = $request->except('_token');
        Servico::create($data);
        return redirect()->route('servicos.index')
                        ->with('mensagem', 'Serviço criado com sucesso!');
    }

    /**
     * Mostra o formulário preenchido para alteração
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit (int $id)
    {
        $servico = Servico::findOrFail($id);

        return view('servicos.edit')->with('servico', $servico);
    }

    /**
     * Atualiza um registro no banco de dados
     *
     * @param integer $id
     * @param ServicoRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update( int $id, ServicoRequest $request)
    {
        $data = $request->except(['_token', '_method']);

        $servico = Servico::findOrFail($id);

        $servico->update($data);

        return redirect()->route('servicos.index')
                        ->with('mensagem', 'Serviço atualizado com sucesso!');
    }


}

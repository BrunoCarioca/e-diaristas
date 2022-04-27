<?php

namespace App\Http\Requests;

use Dotenv\Parser\Value;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'min:2', 'max:255'],
            'valor_minimo' => ['required', 'numeric'],
            'quantidade_horas' => ['required', 'integer', 'min:1', 'max:8'],
            'porcentagem' => ['required', 'integer', 'min:1', 'max:99'],
            'valor_quarto' => ['required', 'numeric'],
            'horas_quarto' => ['required', 'integer', 'min:1', 'max:8'],
            'valor_sala' => ['required', 'numeric'],
            'horas_sala' => ['required', 'integer', 'min:1', 'max:8'],
            'valor_banheiro' => ['required', 'numeric'],
            'horas_banheiro' => ['required', 'integer', 'min:1', 'max:8'],
            'valor_cozinha' => ['required', 'numeric'],
            'horas_cozinha' => ['required', 'integer', 'min:1', 'max:8'],
            'valor_quintal' => ['required', 'numeric'],
            'horas_quintal' => ['required', 'integer', 'min:1', 'max:8'],
            'valor_outros' => ['required', 'numeric'],
            'horas_outros' => ['required', 'integer', 'min:1', 'max:8'],
            'icone' => ['required', Rule::in(['twf-cleaning-1', 'twf-cleaning-2', 'twf-cleaning-3'])],
            'posicao' => ['required', 'integer', 'min:1', 'max:99']
        ];
    }

    /**
     *  Substitui os valores antes da validação
     *
     * @return void
     */
    public function validationData()
    {
        #pega todos os valores da request.
        $data = $this->all();

        $data['valor_minimo'] = $this->formataValorMonetario( $data['valor_minimo']);
        $data['valor_quarto'] = $this->formataValorMonetario( $data['valor_quarto']);
        $data['valor_sala'] = $this->formataValorMonetario( $data['valor_sala']);
        $data['valor_banheiro'] = $this->formataValorMonetario( $data['valor_banheiro']);
        $data['valor_cozinha'] = $this->formataValorMonetario( $data['valor_cozinha']);
        $data['valor_quintal'] = $this->formataValorMonetario( $data['valor_quintal']);
        $data['valor_outros'] = $this->formataValorMonetario( $data['valor_outros']);

        $this->replace($data);

        return $data;
    }

    /**
     * formata o valor do padrão brasileiro para o internacional
     *
     * @param string $value
     * @return void
     */
    protected function formataValorMonetario(string $value)
    {
        return str_replace(['.', ','], ['', '.'], $value);
    }
}

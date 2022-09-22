<?php

namespace App\Http\Requests;

use App\Models\NuevaEntidad;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNuevaEntidadRequest extends FormRequest
{
    public function authorize()
    {
        return true;//Gate::allows('');
    }

    public function rules()
    {
        return [
            'slug' => ['string','nullable',],
			'descripcion' => ['string','nullable',],
			'id' => ['integer','nullable',],
			'quantity' => ['integer','nullable',],
			'amount' => ['number','nullable',],
			];
    }
}

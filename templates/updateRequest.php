<?php

namespace App\Http\Requests;

use App\Models\entity_name;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class Updateentity_nameRequest extends FormRequest
{
    public function authorize()
    {
        return true;//Gate::allows('');
    }

    public function rules()
    {
        return [
            // REQUEST_ATTRIBUTES];
    }
}

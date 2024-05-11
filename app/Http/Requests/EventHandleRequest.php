<?php

namespace App\Http\Requests;

use App\Core\Enums\EventTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventHandleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type'        => ['required', 'string', Rule::in(EventTypeEnum::values())],
            'account_id'  => 'nullable|integer',
            'destination' => 'sometimes|required|string',
            'amount'      => 'required|numeric',
            'origin'      => 'sometimes|required|string',
        ];
    }
}

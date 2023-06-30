<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use League\Flysystem\Visibility;

class StoreProjectRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'short_description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
            'relase_date' => ['required', 'date'],
            'type_id' => ['required', 'int', 'exists:types,id'],
            'slug'=> ['string'],
            'visibility'=>['boolean'],
            'tags' => ['required', 'exists:tags,id'],
            'project_link' => ['required', 'string']
        ];
    }

    public function attributes(): array
   {
       return [
        'name' => 'il nome del progetto',
        'description' => 'la descrizione del progetto',
        'short_description' => 'la descrizione BREVE del progetto',
        'image' => 'la foto del progetto',
        'relase_date' => 'la data di creazione del progetto',
        'type_id' => 'i programmi usati per il progetto',
        'visbility' => 'la visibiltà del progetto',
        'tags' => 'i tags',
        'project_link' => 'il link del progetto'

       ];
   }
}

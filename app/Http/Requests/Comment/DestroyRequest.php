<?php

namespace App\Http\Requests\Comment;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->id === $this->comment->user_id;
    }
}

<?php

namespace App\Http\Requests\Comment;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (
            $this->user()->is_admin ||
            ($this->user()->id === $this->comment->user_id)
        );
    }
}

<?php

namespace App\Http\Requests\Post;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (
            $this->user()->is_admin ||
            ($this->user()->id === $this->post->user_id)
        );
    }
}

<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

class PostTest extends BaseModelTestCase
{
    
    protected function model(): Model
    {
        return new Post();
    }

    protected function fillable(): array
    {
        return [
            'name',
            'image',
            'description'
        ];
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeProjectController extends Controller
{
    public function __invoke(string $slug)
    {
        $type = Type::whereSlug($slug)->first();
        if(!$type) return response(null, 404);

        $type->load('projects.type');
        $projects = $type->projects;

        return response()->json(['projects' => $projects, 'label' => $type->label]);
    }
}

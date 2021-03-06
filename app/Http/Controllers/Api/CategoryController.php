<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\Res;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Res;
    public function index(Request $request) {
        $categories = Category::latest();
        if($request->name) {
            $categories->where('name', 'like', '%' . $request->name . '%');
        }
        $categories = $categories->paginate(10);
        return $this->sendRes('', true, $categories);
    }
}

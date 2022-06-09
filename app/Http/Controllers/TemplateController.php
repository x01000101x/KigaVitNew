<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{

    public function index()
    {
        $template = Template::paginate(50);
        $filter = null;
        return view('dashboard', ['template' => $template, 'filter' => $filter]);
    }

    public function category_filter(Request $request, $id)
    {
        $category = Template::where('category', $id)->get();
        return view('dashboard', ['template' => $category, 'filter' => $id]);
    }
}

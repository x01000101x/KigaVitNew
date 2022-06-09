<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // This template is where all categories are collected and ready to be clicked
    public function category(Request $request)
    {
        $category = category::all();

        $bg = ['bg-blue-400', 'bg-yellow-500', 'bg-purple-500', 'bg-indigo-400', 'bg-blue-400', 'bg-green-500', 'bg-red-500'];

        return view('category', ['category' => $category, 'bg' => $bg]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // add a bookmarks template for user
    public function bookmarks(Request $request)
    {
        $template = Bookmark::where('user_id', Auth::id())->get();
        return view('bookmarks', ['template' => $template]);
    }

    //post add bookmarks
    public function add_bookmarks(Request $request, $id)
    {
        Bookmark::create([
            'user_id' => Auth::id(),
            'template_id' => $id
        ]);
        return redirect()->back()->with(['message'=>'Horee added to your bookmakrs','status'=>'success']);
    }

    //delete bookmarks
    public function delete_bookmarks(Request $request, $id)
    {
        Bookmark::where('id', $id)->delete();
        return redirect()->back()->with(['message'=>'Yahh bookmakrs deleted','status'=>'success']);
    }
}

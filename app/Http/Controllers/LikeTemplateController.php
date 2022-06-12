<?php

namespace App\Http\Controllers;

use App\Models\Like_template;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeTemplateController extends Controller
{
    // like template
    public function like_template(Request $request, $id)
    {
        if ($like_temp = Like_template::where('user_id', Auth::id())->where('template_id', $id)->exists()) {
            Like_template::where('user_id', Auth::id())->where('template_id', $id)->delete();
            $tp = Template::where('id', $id)->first();
            $tp->rate -= 1;
            $tp->save();
            return redirect()->back()->with(['message'=> 'Loved has been deleted','status'=>'success']);
        } else {
            Like_template::create([
                'user_id' => Auth::id(),
                'template_id' => $id
            ]);
            $tp = Template::where('id', $id)->first();
            $tp->rate += 1;
            $tp->save();
            return redirect()->back()->with(['message'=> 'Loved !','status'=>'success']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Models\Client_template;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;


class RsvpController extends Controller
{
    // this page where you can see who has commented and ordered rsvp
    public function responden(Request $request)
    {
        $solve = [];
        $dat = [];
        $z = Client_template::where('user_id', Auth::id())->first();
        $data = rsvp::where('respon', $z->id)->get();
        foreach ($data as $key => $v) {
            if ($v->attend == 1) {
                $solve[] = $v->count;
            } else {
                $solve[] = 0 -  $v->count;
            }
            $dat[] = $v->date;
        }
        return view('responden', ['respon' => $data, 'data' => $solve, 'date' => $dat]);
    }

    // This is the part where someone responds to the template that has been created
    public function add_rsvp(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'count' => 'required',
            'respon' => 'required',
            'attend' => 'required'
        ]);

        rsvp::create([
            'name' => $request->name,
            'count' => $request->count,
            'message' => $request->desc,
            'type' => $request->type,
            'respon' => $request->respon,
            'attend' => $request->attend ? 1 : 0,
            'date' => Carbon::now()->format('Y-m-d')
        ]);

        return redirect()->back()->with(['message'=> 'Success RSVP has been added','status'=>'success']);
    }
}

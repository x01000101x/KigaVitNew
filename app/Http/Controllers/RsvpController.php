<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Models\Client_template;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}

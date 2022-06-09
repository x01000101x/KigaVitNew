<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client_template;
use App\Models\Css_data;
use App\Models\Js_data;
use App\Models\Sub_template_client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ClientTemplateController extends Controller
{
    // this is the view given to the user's template
    public function my_template(Request $request)
    {
        //given view template not found if template has been deleted or null
        if (is_null(client_template::where('user_id', Auth::id())->first())) {
            return view('template_not_found');
        } else {
            $css = [];
            $js = [];
            $sub_temp = Sub_template_client::where('user_id', Auth::id())->get();

            $sub = client_template::where('user_id', Auth::id())->first();

            if (!is_null($data_css = Css_data::where('template_id', $sub->template_id)->first())) {
                $css = explode(',', $data_css->file);
            }
            if (!is_null($data_js = Js_data::where('template_id', $sub->template_id)->first())) {
                $js = explode(',', $data_js->file);
            }
            $hashed = Hash::make(Auth::id(), [
                'rounds' => 12,
            ]);

            return view('edit_template', ['template' => $sub_temp, 'data_css' => $css, 'id' => $sub->template_id, 'data_js' => $js, 'hash' => $hashed, 'host' => $request->getSchemeAndHttpHost()]);
        }
    }
}

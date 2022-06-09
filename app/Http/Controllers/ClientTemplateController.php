<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client_template;
use App\Models\Css_data;
use App\Models\Js_data;
use App\Models\Sub_template;
use App\Models\Sub_template_client;
use Illuminate\Support\Facades\Mail;
use App\Mail\invitationMail;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ClientTemplateController extends Controller
{
    // this is the view given to the user's template
    public function my_template(Request $request)
    {
        //given view template not found if template has been deleted or null
        if (is_null(Client_template::where('user_id', Auth::id())->first())) {
            return view('template_not_found');
        } else {
            $css = [];
            $js = [];
            $sub_temp = Sub_template_client::where('user_id', Auth::id())->get();

            $sub = Client_template::where('user_id', Auth::id())->first();

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

    // when the user clicks select template, the system will look for which template he chose then make it a Client_template
    // but all resources are still the same as the main template, only the sub templates can be changed
    public function select_template(Request $request, $id)
    {
        $base = Sub_template::where('template_id', $id)->get();
        if (is_null(Client_template::where('user_id', Auth::id())->first())) {
            Client_template::create([
                'user_id' => Auth::id(),
                'template_id' => $id,
            ]);
        }

        if (is_null(Sub_template_client::where('user_id', Auth::id())->first())) {
            foreach ($base as $key => $item) {
                Sub_template_client::create([
                    'resource_id' => $id,
                    'user_id' => Auth::id(),
                    'section_code' => $item->section_code
                ]);
            }
        }

        return redirect('my_template')->with('success', 'template has been selected');
    }

    public function delete_template(Request $request)
    {
        Client_template::where('user_id', Auth::id())->delete();
        Sub_template_client::where('user_id', Auth::id())->delete();

        return redirect('/')->with('template_has been deleted');
    }

    public function in_music(Request $request)
    {
        $temp = Client_template::where('user_id', Auth::id())->first();
        $temp->music = $request->music;
        $temp->save();
        return response()->json(['success' => 'add music successfully']);
    }

    // add music to your template ?
    public function add_music($id)
    {
        return view('add_music', ['id' => $id]);
    }

    public function send_email(Request $request)
    {
        return view('send_mail');
    }

    public function send_bulk_email(Request $request)
    {

        // dd($request->mail);
        foreach ($request->mail as $key => $value) {
            Mail::to($value)->send(new invitationMail());
        }

        return redirect()->route('send_email')->with(['success' => 'email has been send !']);
    }
}

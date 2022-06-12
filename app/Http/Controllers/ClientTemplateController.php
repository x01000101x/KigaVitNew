<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\{
    Client_template,
    Css_data,
    Js_data,
    Sub_template,
    Sub_template_client
};


use App\Mail\invitationMail;
use Carbon\Carbon;



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
                'paid' => TRUE,
                'date' => Carbon::now()->toDateString('Y-m-d')
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

        return redirect()->route('my-template')->with(['message'=> 'Yeayyy template has been selected','status'=>'success']);
    }

    public function delete_template(Request $request)
    {
        Client_template::where('user_id', Auth::id())->delete();
        Sub_template_client::where('user_id', Auth::id())->delete();

        return redirect('/')->with(['message'=> 'Yahh Template has been deleted','status'=>'success']);
    }

    public function in_music(Request $request)
    {
        $temp = Client_template::where('user_id', Auth::id())->first();
        $temp->music = $request->music;
        $temp->save();
        return response()->json(['message'=> 'Yeayyy music has been selected','status'=>'success']);
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
        foreach ($request->mail as $key => $value) {
            Mail::to($value)->send(new invitationMail());
        }

        return redirect()->route('send_email')->with(['success' => 'email has been send !']);
    }

    // now this part is a little bit worrying either because my decoding method which loops then matches the number to make this as (rehasing)
    // or maybe if there is another method that is safer for rehashing this part, just replace it
    public function invitation(Request $request)
    {
        $x = 0;
        $w = true;
        while ($w) {
            if (Hash::check($x, $request->x)) {
                $id = $x;
                $w = false;
                break;
            }

            $x += 1;
        }

        if (is_null(client_template::where('user_id', $id)->first())) {
            return view('template_not_exists');
        } else {
            $css = [];
            $js = [];
            $data = client_template::where('user_id', $id)->first();

            $componen = sub_template_client::where('user_id', $id)->get();

            $js_url  = [];
            $css_url  = [];
            if (!is_null($data_css = css_data::where('template_id', $data->template_id)->where('type', 'url')->first())) {
                $css_url = explode(',', $data_css->file);
            }
            if (!is_null($data_js = js_data::where('template_id', $data->template_id)->where('type', 'url')->first())) {
                $js_url = explode(',', $data_js->file);
            }

            if (!is_null($data_css = css_data::where('template_id', $data->template_id)->first())) {
                $css = explode(',', $data_css->file);
            }
            if (!is_null($data_js = js_data::where('template_id', $data->template_id)->first())) {
                $js = explode(',', $data_js->file);
            }
            return view('invitation', ["template" => $componen, 'id_rsvp' => $data->id, 'data_css' => $css, 'data_js' => $js, 'data_url_css' => $css_url, 'data_url_js' => $js_url, 'id' => $data->template_id, 'host' => $request->getSchemeAndHttpHost()]);
        }
    }

    public function download_format(Request $request)
    {
        $file = public_path() . "/format.html";
        $headers = array('Content-Type: text/html',);

        return Response::download($file, 'format.html', $headers);
    }
}

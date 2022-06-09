<?php

namespace App\Http\Controllers;

use App\Models\Client_template;
use App\Models\Css_data;
use App\Models\Js_data;
use App\Models\Sub_template_client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubTemplateClientController extends Controller
{
    // this section to create a new sub_template
    public function new_layer(Request $request)
    {
        $resource = Client_template::where('user_id', Auth::id())->first();
        sub_template_client::create([
            'user_id' => Auth::id(),
            'resource_id' => $resource->template_id,
            'section_code' => $request->sc

        ]);
        return response()->json(['success' => 'New layer has been created']);
    }

    public function edit_sub_template(Request $request, $id)
    {
        $css = [];
        $js = [];
        $js_url  = [];
        $css_url  = [];
        $sub = sub_template_client::where('id', $id)->first();

        if ($sub->user_id == Auth::id()) {

            if (!is_null($data_css = Css_data::where('template_id', $sub->resource_id)->where('type', 'url')->first())) {
                $css_url = explode(',', $data_css->file);
            }
            if (!is_null($data_js = Js_data::where('template_id', $sub->resource_id)->where('type', 'url')->first())) {
                $js_url = explode(',', $data_js->file);
            }

            if (!is_null($data_css = Css_data::where('template_id', $sub->resource_id)->first())) {
                $css = explode(',', $data_css->file);
            }
            if (!is_null($data_js = Js_data::where('template_id', $sub->resource_id)->first())) {
                $js = explode(',', $data_js->file);
            }

            return view("edit_sub_template", ['sub' => $sub, 'css_data' => $css, 'data_url_css' => $css_url, 'data_url_js' => $js_url, 'js_data' => $js, 'host' => $request->getSchemeAndHttpHost()]);
        } else {
            return "edit not allowed";
        }
    }

    // when the user presses the save button, he will update the existing client sub template
    public function update_design(Request $request)
    {
        Sub_template_client::where('id', $request->id)->update(['section_code' => $request->sc]);
        return response()->json(['success' => 'Saved']);
    }
}

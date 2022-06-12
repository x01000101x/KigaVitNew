<?php

namespace App\Http\Controllers;

//Models
use App\Models\{
    Css_data,
    Js_data,
    Sub_template,
    Template
};


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

    // details of a template
    public function details(Request $request, $id)
    {
        // takes a specific template
        // takes all its resources such as css and js
        $base_template = Template::where('id', $id)->first();
        $template = Sub_template::where('template_id', $id)->get();

        $css = [];
        $js = [];
        $js_url  = [];
        $css_url  = [];
        if (!is_null($data_css = Css_data::where('template_id', $id)->where('type', 'url')->first())) {
            $css_url = explode(',', $data_css->file);
        }
        if (!is_null($data_js = Js_data::where('template_id', $id)->where('type', 'url')->first())) {
            $js_url = explode(',', $data_js->file);
        }

        if (!is_null($data_css = Css_data::where('template_id', $id)->where('type', 'file')->first())) {
            $css = explode(',', $data_css->file);
        }

        if (!is_null($data_js = Js_data::where('template_id', $id)->where('type', 'file')->first())) {
            $js = explode(',', $data_js->file);
        }


        return view('template_preview', ['base_template' => $base_template, 'template' => $template, 'data_css' => $css, 'data_js' => $js, 'data_url_js' => $js_url, 'data_url_css' => $css_url, 'id' => $id, 'host' => $request->getSchemeAndHttpHost()]);
    }
}

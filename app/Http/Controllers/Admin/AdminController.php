<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use App\Models\Template;
use App\Models\Sub_template;
use App\Models\Css_data;
use App\Models\Js_data;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    //this function is used to publish a new template (admin)
    // where the code section is passed as sub_template and other sections like author , title and everything about the template (metadata) are sent to template
    // other sections like css , js have their own db
    public function add_template(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'section' => 'required',
            'category' => 'required',
            'price' => 'required',
            'thumb' => 'file|mimes:jpg,jpeg,png',

        ]);

        if (!is_null($request->thumb)) {
            $thumb = $request->file('thumb');
            $thumbname = time() . "_" . $thumb->getClientOriginalName();


            $thumb->move(public_path() . '/thumb' . '/', $thumbname);
            $res = Template::create([
                'title' => $request->title,
                'price' => $request->price,
                'author' => $request->author,
                'description' => $request->description,
                'category' => $request->category,
                'premium' => $request->premium ? 1 : 0,
                'thumb' => $thumbname,

            ]);
        } else {
            $res = Template::create([
                'title' => $request->title,
                'price' => $request->price,
                'author' => $request->author,
                'description' => $request->description,
                'category' => $request->category,
                'premium' => $request->premium ? 1 : 0,

            ]);
        }


        $name_original_media = [];
        $name_media = [];
        if ($request->hasfile('media')) {
            foreach ($request->file('media') as $file) {
                $path = 'media';
                $name_original_media[] = $file->getClientOriginalName();
                $name = time() . "_" . $file->getClientOriginalName();
                $name_media[] = $name;
                $file->move($path, $name);
            }
        }



        foreach ($request->section as $key => $value) {
            foreach ($name_original_media as $num => $media) {
                $value = str_replace($media, $request->getSchemeAndHttpHost() . '/' . 'media/' . $name_media[$num], $value);
            }

            Sub_template::create([
                'template_id' => $res->id,
                'sort_section' => $key + 1,
                'section_code' => $value
            ]);
        }

        File::makeDirectory(public_path() . '/resource' . '/' . $res->id . '/css', 0777, true);
        File::makeDirectory(public_path() . '/resource' . '/' . $res->id . '/js', 0777, true);


        if ($request->hasfile('attachment')) {
            $path = 'resource' . '/' . $res->id . '/css';
            foreach ($request->file('attachment') as $file) {
                $name = $file->getClientOriginalName();


                $file->move($path, $name);

                $data[] = $name;
            }
            css_data::create([
                'template_id' => $res->id,
                'type' => 'file',
                'file' => join(",", $data)
            ]);
        }

        if ($request->hasfile('jsfile')) {
            $path2 = 'resource' . '/' . $res->id . '/js';
            foreach ($request->file('jsfile') as $file) {
                $name = $file->getClientOriginalName();


                $file->move($path2, $name);

                $data2[] = $name;
            }
            js_data::create([
                'template_id' => $res->id,
                'type' => 'file',
                'file' => join(",", $data2)
            ]);
        }

        if (!is_null($request->css_url)) {
            css_data::create([
                'template_id' => $res->id,
                'type' => 'url',
                'file' => $request->css_url
            ]);
        }


        if (!is_null($request->js_url)) {
            js_data::create([
                'template_id' => $res->id,
                'type' => 'url',
                'file' => $request->js_url
            ]);
        }
        return redirect()->back()->with('success', 'template has been created');
    }
}

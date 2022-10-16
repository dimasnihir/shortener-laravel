<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinksRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Link;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LinksController extends Controller
{
    public function show() {
        return view('links.show');
    }

    public function send(LinksRequest $request) {

        $url = $request->input('url');
        $urlPrefix = Str::random(6);

        $link = Link::create([
            'source_link' => $url,
            'link_key' => $urlPrefix
        ]);

        if($link) {
            back()->with('success', route('links.away', ['prefix' => $urlPrefix]));
        }

        return back()->with('errors', 'HelpMePlease');
    }

    public function away(string $prefix) {
        $link = Link::where(['link_key' => $prefix])->first();
        if ($link) {
            return redirect()->away($link->source_link);
        }
        throw new NotFoundHttpException('prefix не найден');
    }

}

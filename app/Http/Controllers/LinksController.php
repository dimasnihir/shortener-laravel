<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinksRequest;
use App\Models\NavHistory;
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

        $link = Link::where(['source_link' => $url])->first();
        if ($link) {
            $urlPrefix = $link->link_key;
            back()->with('success', route('links.away', ['prefix' => $urlPrefix]));
        } else {
            $urlPrefix = Str::random(6);

            $link = Link::create([
                'source_link' => $url,
                'link_key' => $urlPrefix
            ]);

            if($link) {
                back()->with('success', route('links.away', ['prefix' => $urlPrefix]));
            }
        }
        return back()->with('errors', 'HelpMePlease');
    }

    public function away(string $prefix) {
        $link = Link::where(['link_key' => $prefix])->first();
        if ($link) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            NavHistory::create([
                'link_key' => $prefix,
                'user_ip' => $ip,
                'user_agent' => $userAgent
            ]);
            return redirect()->away($link->source_link);
        }
        throw new NotFoundHttpException('prefix не найден');
    }

}

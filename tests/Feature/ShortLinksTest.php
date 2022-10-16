<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class ShortLinksTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_form()
    {
        $response = $this->get('/links');

        $response->assertStatus(200);
    }

    public function test_send_form()
    {
        $url = 'https://google.com';
        $response = $this->post('/links', ['url' => $url]);




        $response->assertStatus(Response::HTTP_CREATED);
    }

}

<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class ExternalApiController extends Controller
{

    public function index(){
        $client = new Client();

        $response = $client->get('https://jsonplaceholder.typicode.com/posts/1');

        return $response->getBody();

    }

}

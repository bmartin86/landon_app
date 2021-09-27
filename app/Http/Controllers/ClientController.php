<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title as Title;
use App\Models\Client as Client;

class ClientController extends Controller
{
    //
    public function __construct( Title $titles, Client $client)
    {
        $this->titles = $titles->all();
        $this->client = $client;
    }

    public function di()
    {
        dd($this->titles);
    }

    public function index()
    {
        $data = [];

        $data ['clients'] = $this->client->all();
        return view('client/index', $data);
        //return view('client/index');
    }

    public function newClient( Request $request, Client $client )
    {
        $data = [];

        $data ['title'] = $request->input('title');
        $data ['name'] = $request->input('name');
        $data ['last_name'] = $request->input('last_name');
        $data ['address'] = $request->input('address');
        $data ['zip_code'] = $request->input('zip_code');
        $data ['city'] = $request->input('title');
        $data ['state'] = $request->input('state');
        $data ['email'] = $request->input('email');

        if ( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    'name' => 'required|min:3',
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',
                ]

            );

            $client->insert($data);


            return redirect ('clients');
        }

        $data ['titles'] = $this->titles;
        $data ['modify'] = 0;
        return view('client/form', $data);
    }

    public function create()
    {
        return view('client/create');
    }

    public function show($client_id)
    {
        $data = [];
        $data ['titles'] = $this->titles;
        $data ['modify'] = 1;
        return view('client/form', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{


    public function store(Request $request)
    {   
        $query = "SELECT * FROM `table_contact` WHERE `id` = ?";
        $table_contact = \DB::selectOne($query, [$request->input('id')]);
        
        if ($request->input('id')) {
        
            $query = "
                INSERT
                INTO `table_contact`
                (`firstname`, `lastname`, `email`, `phone`, `message`)
                VALUES
                (?, ?, ?, ?, ?)
            ";

            $values = [
                $request->input('firstname'),
                $request->input('lastname'),
                $request->input('email'),
                $request->input('phone'),
                $request->input('message'),
            ];

            \DB::insert($query, $values);

            $id = \DB::getPdo()->lastInsertId();
        }


        session()->flash('success_message', 'Thank you for contact me');
 
        // redirect
        return redirect('/portfolio?id='.$id);
    }
    public function create()
    {   
      

        $table_contact = new \stdClass();
        $table_contact ->firstname = null;
        $table_contact ->lastname = null;
        $table_contact ->email = null;
        $table_contact ->phone = null;
        $table_contact ->message = null;

        return view('/portfolio');
    }
}

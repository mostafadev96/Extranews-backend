<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function createAuthor(Request $request){
        $curl = curl_init();

        $pvars   = array('image' => $request->photo);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID 16ece6b6a598502' ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
        $out = curl_exec($curl);
        curl_close ($curl);
        $pms = json_decode($out,true);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->photo=$pms['data']['link'];
        $user->save();
        return $user;

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getTableName($id){
        $tablename='';
        if($id==1){
            $tablename='style';
        }
        else if($id==2){
            $tablename='women';
        }
        else if($id==3){
            $tablename='culture';
        }
        else if($id==4){
            $tablename='grooming';
        }
        else if($id==5){
            $tablename='entertainment';
        }
        return $tablename;
    }
}

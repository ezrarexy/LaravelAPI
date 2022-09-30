<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;

class APIController extends Controller
{

    public function getAll(Request $req) {
        $res = Students::all();

        return json_encode($res);
    }

    public function getOne(Request $req) {
        $res = Students::find($req->id);

        return json_encode($res);
    }

    public function new(Request $req) {

        $query = $req->validate([
            'name' => ['required'],
            'gender' => ['required','in:M,F'],
            'dob' => ['required','date','date_format:Y-m-d']
        ]);

        $students = new Students;

        if ( is_null($req->avatar_url) ) {
            $students->avatar_url = null;
        } else {
            $students->avatar_url = $req->avatar_url;
        }

        $students->name = $req->name;
        $students->gender = $req->gender;
        $students->dob = $req->dob;

        $students->save();

        return response()->json(['message'=>'Data input success!']);
    }

    public function update(Request $req, $id) {
        $students = Students::find($id);

        if ($students) {
            $query = $req->validate([
                'gender' => ['in:M,F'],
                'dob' => ['date','date_format:Y-m-d']
            ]);

            if ( !is_null($req->avatar_url) ) { $students->avatar_url = $req->avatar_url; }
            if ( !is_null($req->name) ) { $students->name = $req->name; }
            if ( !is_null($req->gender) ) { $students->gender = $req->gender; }
            if ( !is_null($req->dob) ) { $students->dob = $req->dob; }

            $students->save();

            return response()->json(['message'=>'Data updated successfully!']);
        } else {
            return response()->json(['message'=>'No data updated!']);
        }
    }

    public function delete(Request $req, $id) {
        $students = Students::find($id);

        if ($students) {
            $students->delete();

            return response()->json(['message'=>'Data deletion success!']);
        } else {
            return response()->json(['message'=>'Data not found!']);
        }

        
    }

}

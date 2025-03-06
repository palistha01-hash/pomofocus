<?php

namespace App\Http\Controllers;

use App\Models\User;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('users.edit', ['user' => $row->id]);
                    $btn = '<a href=\"{$url}\" class="edit btn btn-primary  openFormModal btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.index');
    }
    public function create()
    {
        $html = view('users.create')->renderSections()['user-form'];
        return response([
            'html'=>$html,
            'title'=>'Add User'
        ]);
    }
    public function store()
    {
        // return view('users.create');
    }
    public function edit($id)
    {
        $users=User::find($id);
        return view('users.create',compact('$users'));
    }
    public function update()
    {
        // return view('users.create');
    }
}

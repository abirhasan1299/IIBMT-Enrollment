<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Home()
    {
        $model = new Admin();
        $data = $model::orderBy('id', 'desc')->get();
        return view('system',compact('data'));
    }

    public function DelAdmin($id)
    {

        $admin = Admin::find($id);

        $admin->delete();

        return redirect()->back();
    }


    public function logout(Request $request)
    {

            $request->session()->flush();
            $request->session()->regenerate();

            return redirect()->route('login');
    }

    public function LoginVerify(Request $req)
    {
            $req->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            $admin = Admin::where('email', $req->email)->where('password',$req->password)->first();


            if (!empty($admin->password)) {
                
                
                if($req->password==$admin->password)
                {
                    
                    $req->session()->put('email', $admin->email);
                    $req->session()->put('id', $admin->id);

                    return redirect()->route('add-enroll');
                }else{
                    
                     return back()->with('invalid', 'Invalid email or password');
                }
                    
            } else {
                
                    return back()->with('invalid', 'Invalid email or password');
            }
    }


    public function AddData(Request $req)
    {
        $validated = $req->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|string|min:6',
        ]);

        $model = new Admin();
        $model->insert($validated);

        return redirect()->back()->with('success', 'New Admin Created');
    }
}

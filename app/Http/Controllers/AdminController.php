<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller{ 

	/**
	*	Function connexion au backoffice seulement pour un admin.
	**/
	public function login(Request $request){

		if($request->isMethod('post')){
			$data = $request->input();
			if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password'], 'admin'=>'1'])){
				return redirect('/admin/dashboard');
			}else{
				return redirect('/admin')->with('flash_message_error', 'Mail ou mot de passe invalide.');
			}
		}

		return view('admin.admin_login');
	}


	/**
	*	Function qui renvoie sur la view Dashboard.
	**/
	public function dashboard(){
		return view('admin.dashboard');
	}


	/**
	*	Function qui renvoie sur la view Settings.
	**/
	public function settings(){
		return view('admin.settings');
	}


	/**
	*	Functio AJAX qui vérifie si l'ancien mot de passe de l'admin est correctement écrit.
	**/
	public function chkPassword(Request $request){
		$data = $request->all();
		$current_password = $data['current_pwd'];
		$check_password = User::where(['admin'=>'1'])->first();
		if(Hash::check($current_password, $check_password->password)){
			echo "true"; die;
		}else{
			echo "false"; die;
		}
	}


	/**
	*	Function qui permet la modificiation du mot de passe de l'admin.
	**/
	public function updatePassword(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			//echo '<pre>'; print_r($data); die;

			$check_password = User::where(['email'=>Auth::user()->email])->first();
			$current_password = $data['current_pwd'];
			if(Hash::check($current_password, $check_password->password)){
				$password = bcrypt($data['new_pwd']);
				User::where('id','1')->update(['password'=>$password]);
				return redirect('/admin/settings')->with('flash_message_success','Ancien mot de passe modifié.');
			}else{
				return redirect('/admin/settings')->with('flash_message_error', 'Ancien mot de passe incorrecte.');
			}
		}
	}


	/**
	*	Function qui permet la déconnexion de l'admin.
	**/
	public function logout(){
		Session::flush();

		return redirect('/admin')->with('flash_message_success', 'Vous êtes déconnecté.');
	}

}

<?php

namespace App\Starter\Users\Controllers;

use App\Starter\Users\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Starter\Users\Requests\UserLoginRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AuthController extends Controller
{
    public $model;
    public $module;

    public function __construct(User $model)
    {
        $this->middleware('guest');
        $this->module='auth';
        $this->model=$model;
        $this->rules=$model->rules;
    }

    public function getRegister()
    {
        $data['page_title']=trans('auth.Register');
        $data['module']=$this->module;
        return view($this->module.'.register', $data);
    }

    public function postRegister()
    {
        if (env('USER_CONFIRMATION')) {
            request()->request->add(['confirmed'=>1]);
        }
        $validator=Validator::make(request()->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(transformValidation($validator->errors()->messages()), 422);
        }
        if ($row=$this->model->create(request()->except(['password_confirmation']))) {
            return response()->json(['message'=>trans('api.Account has been created successfully, Please check your email')], 201);
        }
        flash()->error(trans('auth.Failed to login'));
        return back();
    }

    public function getLogin()
    {
        $data['page_title']=trans('auth.Login');
        $data['module']=$this->module;
        return view($this->module.'.login', $data);
    }

    public function postLogin(UserLoginRequest $request)
    {
        $row = $this->model->where('mobile_number', trim(request('mobile_number')))->first();
        if (!$row) {
            flash()->error(trans('auth.There is no account with this mobile number'));
            return back()->withInput();
        }
        if (!$row->confirmed) {
            flash()->error(trans('auth.This account is not confirmed'));
            return back()->withInput();
        }
        if (!$row->is_active) {
            flash()->error(trans('auth.This account is banned'));
            return back()->withInput();
        }
        if (!Hash::check(trim(request('password')), $row->password)) {
            flash()->error(trans('auth.Trying to login with invalid password'));
            return back()->withInput();
        }
        if (Auth::attempt(request()->only('mobile_number', 'password'), request('remember_me'))) {
            if (request()->has('to')) {
                return redirect(request('to'));
            }
            $row->last_ip=request()->ip();
            $row->last_logged_in_at=date('Y-m-d H:i:s');
            $row->save();

            LaravelLocalization::setLocale($row->language ?? config('app.locale'));
            flash()->success(trans('auth.Welcome to your dashboard'));
            return redirect()->intended('/');
        }
        flash()->error(trans('auth.Failed to login'));
        return back();
    }

    public function getForgotPassword()
    {
        $data['page_title']=trans('auth.Login');
        $data['module']=$this->module;
        return view($this->module.'.forgot', $data);
    }

    public function postForgotPassword()
    {
        $rules=[
            'email'=>'required|email',
        ];
        $this->validate(request(), $rules);
        $row=$this->model->where('email', trim(request('email')))->first();
        if (!$row) {
            flash()->error(trans('auth.There is no account with this email'));
            return back()->withInput();
        }
        if (!$row->confirmed) {
            flash()->error(trans('auth.This account is not confirmed'));
            return back()->withInput();
        }
        if (!$row->is_active) {
            flash()->error(trans('auth.This account is banned'));
            return back()->withInput();
        }
        $password=strtolower(str_random(8));
        if ($row->update(['password'=>$password])) {
            \App\Jobs\SendForgotEMail::dispatch($row, $password);
            flash()->success(trans('auth.Your new password has been sent to your email'));
            return back();
        }
        flash()->error(trans('auth.Failed to reset password'));
        return back();
    }

    public function getConfirm($token)
    {
        $row=$this->model->where('confirm_token', '=', $token)->first();
        if (!$row) {
            flash()->error(trans('auth.Invalid user link'));
            return redirect('/');
        }
        $row->confirmed=1;
        $row->save();
        flash()->success(trans('auth.User has been confirmed'));
        return redirect('/');
    }
}

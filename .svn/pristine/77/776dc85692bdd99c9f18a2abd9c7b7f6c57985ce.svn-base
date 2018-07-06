<?php

namespace App\Http\Controllers\Admin\Base;

use App\Extensions\AuthenticatesLogout;
use App\Http\Controllers\Base\BaseController;
use App\model\admin\base\sysConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * 登录注册、退出操作
 * @since 2018/2
 * @author hus lay
 * 
 */
class LoginController extends BaseController
{
     /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, AuthenticatesLogout {
        AuthenticatesLogout::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = './admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest.admin', ['except' => 'logout']);
    }

    /**
     * 显示后台登录模板
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * 使用 admin guard
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }

    /**
     * 重写验证时使用的用户名字段
     */
    public function username()
    {
        return 'name';
    }

    //登录
    public function login(Request $request){
        $user = ['name' => $request->name, 'password' => $request->password, 'type' => 1];
        if (Auth::guard('admin')->attempt($user, $request->remember)) {
            $this->authCacheInfo();
            $this->log(__CLASS__, __FUNCTION__, $request, "成功登录");
            return ['code' => 200, 'info' => '登陆成功！'];
        }else{
            $this->log(__CLASS__, __FUNCTION__, $request, "登录失败");
            return ['code' => 500, 'info' => '登陆失败！'];
        }
    }

    // 退出登录
    public function logout(Request $request){
        if(!Auth::guard('admin')->check()) {
            return view('admin.login');
        }
        $this->log(__CLASS__, __FUNCTION__, $request, "退出登录");

        Cache::flush();//清除缓存
        session()->forget('sys_info');
        session()->forget('sys_admin');
        Auth::guard('admin')->logout();
        return view('admin.login');
    }
}

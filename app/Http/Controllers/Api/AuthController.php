<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use Hash;
use Auth;
use App\Models\Product;
use App\Models\Branch;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_active' => config('status.user_status.active')
        ]);

        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);

        return response()->json([
            'success' => 200,
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        $token = JWTAuth::attempt($credentials);

        if(!$token){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'success' => 200,
            'message' => 'User login successfully',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function getAllProducts()
    {
        $products = Product::leftJoin('branches', 'branches.id', 'products.branch_id')
        ->select('products.id', 'name', 'price', 'qty', 'branches.branch_name','description')->get();

        return response()->json([
            'success' => 200,
            'data' => $products
        ]);
    }

    public function getProductDetail($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'success' => 200,
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $product->qty,
                'description' => $product->description,
                'branch_name' => $product->branch->branch_name,
            ]
        ]); 
    }

    public function getProductByBranch()
    {
        $branches = Branch::with('product')->select('branches.id','branches.branch_name')->get();

        return response()->json([
            'success' => 200,
            'data' => $branches
        ]);
    }

    public function getUserProfile()
    {
        // return response()->json([
        //     'success' => 200,
        //     'id' => auth()->user()->id,
        //     'name' => auth()->user()->name,
        //     'email' => auth()->user()->email,
        //     'role' => auth()->user()->role,
        // ]);

        return new UserResource(auth()->user()->id);
    }

    public function getUsers()
    {
        $users = User::all();

        // return response()->json([
        //     'success' => 200,
        //     'data' => $users
        // ]);
        return UserResource::collection($users);
    }
}

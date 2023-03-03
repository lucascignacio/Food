<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;

        $this->middleware(['can:users']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', compact( 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['tenant_id'] =  auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data); 

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUser $request, string $id)
    {
        if(!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $data = $request->only('name', 'email');

        if($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $users = $this->repository
        ->where(function($query) use ($request){
            if($request->filter) {
                $query->Where('name', 'LIKE', "%{$request->filter}%");
            }
        })
        ->latest()
        ->tenantUser()
        ->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }
}

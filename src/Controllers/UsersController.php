<?php namespace O2s\Users\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class UsersController extends BaseController {
	use DispatchesCommands, ValidatesRequests;

	public function __construct() {
		// Make sure this is added in production code
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$o2suser = new \O2s\Users\Users;
		return view('o2susers::admin.index')->with('users', $o2suser->listAll());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('o2susers::admin.form')->with('user', new \App\User);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(\O2s\Users\UserFormRequest $request)
	{
		$o2suser = new \O2s\Users\Users;
		$o2suser->save(\Input::all());

        return redirect('/admin/users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// showing and editing the user is considered the same action
		return view('o2susers::admin.form')->with('user', \App\User::find($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// showing and editing the user is considered the same action
		return view('o2susers::admin.form')->with('user', \App\User::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(\O2s\Users\UserFormRequest $request, $id)
	{
		$o2suser = new \O2s\Users\Users;
		$o2suser->save(\Input::all());
		return redirect('/admin/users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		 \App\User::find($id)->delete();

        return redirect('/admin/users');
	}

}

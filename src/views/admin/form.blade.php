@extends('app')

@section('content')
    <?php
        // Due to how Laravel handles the POST method for anything other 
        // than GET or POST, we can call the appropriate REST method by
        // resetting the method when appropriate.
        $formaction = '/admin/users';
        $formmethod = 'POST';
        if ($user->id > 0) { 
            $formaction = '/admin/users/'. $user->id;
            $formmethod = 'PUT'; 
        }
    ?>

    {{-- Display any errors the form submission may have gotten --}}
    @if ($errors->count())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error) 
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- display the user detail form --}}
    <form action="{{ $formaction }}" method="POST" class="form-horizontal" role="form">
            <input type="hidden" name="_method" id="input_method" class="form-control" value="{{ $formmethod }}">
            <input type="hidden" name="_token" id="input_token" class="form-control" value="{{ csrf_token() }}">
            <input type="hidden" name="id" id="inputId" class="form-control" value="{{ $user->id }}">

            <div class="form-group">
                <legend>User Detail</legend>
            </div>

            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="inputName" class="form-control" value="{{ $user->name }}" placeholder="Name of the user">

                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" id="inputEmail" class="form-control" value="{{ $user->email }}" placeholder="Users email">
                </div>
            </div>

            <div class="form-group">
                <legend>Password</legend>
                @if ($user->id > 0)
                    <p>Leaving the password fields blank will not reset the existing password.</p>
                @endif
            </div>

            <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" id="inputPassword" class="form-control" value="" placeholder="PASSWORD">
                </div>
            </div>
            <div class="form-group">
                <label for="inputConfirm" class="col-sm-2 control-label">Confirm</label>
                <div class="col-sm-10">                 
                    <input type="password" name="confirm" id="inputConfirm" class="form-control" value="" placeholder="CONFIRM PASSWORD">
                </div>
            </div>

            {{-- separate the action buttons from the password section a little --}}
            <div class="form-group">
                <legend></legend>
            </div>

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    @if($user->id)

                        <button id="btnRemove" type="submit" class="btn btn-danger pull-right">Remove</button>
                    @endif
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </form>
@stop

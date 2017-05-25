@extends('layout')


@section('content')


  <h2>Vertical (basic) form</h2>

  @if(Session::has('success'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success">
        {{Session::get('success')}}
      </div>
    </div>
  </div>
  @endif

  @if($errors->has('registered'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-error">
        {{$errors->first('registered')}}
      </div>
    </div>
  </div>
  @endif

  <?php var_dump($errors)?>

  <form action="adduser" method="post">
  <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="form-group">
      <label for="username">Username:</label>
      <input type="username" name="username" class="form-control" id="username" placeholder="Enter username">

      @if($errors->has('username')) <p>{{$errors->first('username')}}</p>@endif

    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">

      @if($errors->has('password')) <p>{{$errors->first('password')}}</p>@endif

    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">

      @if($errors->has('email')) <p>{{$errors->first('email')}}</p>@endif

    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>

@endsection
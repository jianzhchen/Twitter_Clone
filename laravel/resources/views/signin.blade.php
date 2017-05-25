@extends('layout')




@section('content')

  <h2>Vertical (basic) form</h2>
  <form action="login" method="post">


  <!-- <input type="hidden" name="_token" value="{{csrf_token()}}"> -->


    <div class="form-group">
    @if($errors->has('WPASS')) <p>{{$errors->first('WPASS')}}</p>@endif

      <label for="username">Username:</label>
      <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
            @if($errors->has('username')) <p>{{$errors->first('username')}}</p>@endif
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
            @if($errors->has('password')) <p>{{$errors->first('password')}}</p>@endif
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>

@endsection

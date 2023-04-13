@extends('layouts.account_login')

@section('contents')
  {{Form::open(['action' => 'App\Http\Controllers\AccountController@login', 'class' => 'login-form', 'enctype' => 'multipart/form-data'])}}
  <div class="card mb-0">
    <div class="card-body">
      <div class="text-center mb-3">
        <img src="{{ asset('img/site-logo.png') }}" style="width:100%;"/>
        <h5 class="mb-0">ログイン</h5>
      </div>
      @if ($error)
        <div class="card-body alert alert-danger mb-10">{{$error}}</div>
      @endif
      <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="text" class="form-control" name="username" placeholder="ログインID">
        <div class="form-control-feedback">
          <i class="icon-user text-muted"></i>
        </div>
      </div>

      <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="password" class="form-control" name="password" placeholder="パスワード">
        <div class="form-control-feedback">
          <i class="icon-lock2 text-muted"></i>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
      </div>
    </div>
  </div>
</form>
@endsection

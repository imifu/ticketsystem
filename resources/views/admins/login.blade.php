@extends('layouts.admin_login')

@section('contents')
  {{Form::open(['action' => 'App\Http\Controllers\admin\LoginController@login', 'class' => 'login-form', 'enctype' => 'multipart/form-data'])}}
  @csrf
  <div class="card mb-0">
    <div class="card-body">
      <div class="text-center mb-3">
        <img src="{{ asset('assets/images/logo.svg') }}" />
        <h5 class="mb-0">　</h5>
        <span class="d-block text-muted">マスター管理画面</span>
      </div>


      @error('email')
        <div class="card-body alert alert-danger mb-10">{{$message}}</div>
      @enderror

      @error('password')
        <div class="card-body alert alert-danger mb-10">{{$message}}</div>
      @enderror

      <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="text" class="form-control" name="email" placeholder="メールアドレス">
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

@extends('layouts.main')



@section('container')

<div class="form">
  <div class="row">
    <div class="col-md-4">

      @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      @if (session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
        

      <main class="form-signin">
        <img src="../icon/logo.png" alt="">
        <form action="/login" method="post">
          @csrf
      
          <div class="form-floating">
            <input type="sid" name="sid" class="form-control @error('sid')
              is-invalid
            @enderror" id="sid" placeholder="name@example.com" autofocus required value="{{ old ('sid') }}">
            <label for="sid">NO SID</label>

            @error('sid')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>

          <button class="w-100 btn btn-lg btn-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> Login</button>
        </form>


      </main>

    </div>
  </div>
</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="user m-2 d-flex justify-content-center align-items-center">
                @if (Auth::user()->avatar_name)
                    <img class='rounded ' src="{{asset('storage/avatar/')}}/{{Auth::user()->avatar_name}}" height='50'>
                @else
                    <img class='rounded' src="{{asset('storage/img/default_avatar.png')}}" height='50'>
                @endif
                <h1 class='m-0'>Benvenuto {{Auth::user()->name}}</h1>
            </div>
            {{-- upload img User --}}
            <div class="m-1 card">
                <div class="card-header">Inserisci il tuo Avatar</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <input name='iconUser' type="file" >

                    <input type="submit" value="Invia">
                </form>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a class="mt-3 btn btn-danger" href="{{route('delete-avatar')}}">
                    Reset Icon
                </a>
         </div>
            </div>
        </div>
    </div>
</div>
@endsection

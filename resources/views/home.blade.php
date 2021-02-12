@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>benvenuto {{Auth::user()->name}}</h1>
            {{-- upload img User --}}
            <div class="m-1 card">
                <div class="card-header">Inserisci il tuo Avatar</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form action="{{route('upload')}}" method="POST">
                    @csrf
                    @method('POST')

                    <input name='iconUser' type="file" enctype="multipart/form-data">

                    <input type="submit" value="Invia">
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

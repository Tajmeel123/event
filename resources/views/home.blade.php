@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('messages.Dashboard') }}</div>
                    <div class="card-header"><a href="{{route('comment')}}">Comment</a></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ul>
                            <li><a href="{{ route('switch-language', ['locale' => 'en']) }}">English</a></li>
                            <li><a href="{{ route('switch-language', ['locale' => 'hi']) }}">Hindi</a></li>
                        </ul>
                        {{ __('messages.You are logged in!') }}
                        
                        <h1>{{ __('messages.welcome') }}</h1>
                        <p>{{ __('messages.home') }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

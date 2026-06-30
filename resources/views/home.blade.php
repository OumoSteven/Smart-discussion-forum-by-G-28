@extends('layouts.app')

@section('content')
<div >
    <div>
        <div>
            <div>
                <div>{{ __('Dashboard') }}</div>

                <div>
                    @if (session('status'))
                        <div role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

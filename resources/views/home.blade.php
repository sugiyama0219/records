@extends('auth.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('登録完了') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('ユーザ登録が完了しました') }}
                </div>
            </div>
            <div class="mt-3">
                <a href={{ route('record.show_current') }} class="btn btn-primary">トップ画面へ</a>
            </div>
        </div>
    </div>
</div>
@endsection
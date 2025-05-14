@extends('admin.auth.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('管理者ユーザ登録完了') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('管理者ユーザの登録が完了しました') }}
                </div>
            </div>
            <div class="mt-3">
                <a href={{ route('admin.dashboard') }} class="btn btn-primary">ダッシュボード画面へ</a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin.layout')

@section('content')
<div class="d-flex flex-column gap-4 align-items-center">
    <a href="{{ route('admin.users.register') }}" class="btn btn-primary custom-btn">利用者情報登録</a>
    <!-- <button type="button" class="btn btn-primary custom-btn">利用者情報登録</button> -->
    <button type="button" class="btn btn-primary custom-btn">利用者情報編集</button>
    <button type="button" class="btn btn-primary custom-btn">開所日設定</button>
    <button type="button" class="btn btn-primary custom-btn">利用者の記録表管理</button>
    <button type="button" class="btn btn-primary custom-btn">利用者のパスワード再設定</button>
</div>
@endsection
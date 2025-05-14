@extends('admin.layout')

@section('content')

<h1>利用者情報登録</h1>
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <div id="user-forms">
        <div id = "field1" class="card user-form mb-3 mt-5">
            <div class="card-header">{{ __('1人目') }}</div>
            <div class="card-body">
                <div class="row mb-3">
                    <label for="user_id_0" class="col-md-2 col-form-label text-md-end">{{ __('ID') }}</label>
        
                    <div class="col-md-4">
                        <input id="user_id_0"
                               type="text"
                               class="form-control @error('users.0.user_id') is-invalid @enderror"
                               name="users[0][user_id]"
                               value="{{ old('users.0.user_id') }}"
                               pattern="^[A-Z0-9]{7}$"
                               maxlength="7"
                               required
                               autofocus>
        
                        @error('users.0.user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-form-label">
                        大文字アルファベット、数字合わせて7桁（例:06R0100）
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label for="name_0" class="col-md-2 col-form-label text-md-end">{{ __('名前') }}</label>
        
                    <div class="col-md-4">
                        <input id="name_0"
                               type="text"
                               class="form-control @error('users.0.name') is-invalid @enderror"
                               name="users[0][name]"
                               value="{{ old('users.0.name') }}"
                               maxlength="20"
                               required>
        
                        @error('users.0.name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-form-label">
                        最大20文字
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="recipients_0" class="col-md-2 col-form-label text-md-end">{{ __('受給者証番号') }}</label>
        
                    <div class="col-md-4">
                        <input id="recipients_0"
                               type="text"
                               class="form-control @error('users.0.recipients') is-invalid @enderror"
                               name="users[0][recipients]"
                               value="{{ old('users.0.recipients') }}"
                               pattern="^\d{10}$"
                               maxlength="10"
                               inputmode="numeric" required>
        
                        @error('users.0.recipients')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-form-label">
                        数字10桁
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label for="password_0" class="col-md-2 col-form-label text-md-end">{{ __('初期パスワード') }}</label>
        
                    <div class="col-md-4">
                        <input id="password_0"
                               type="password"
                               class="form-control @error('users.0.password') is-invalid @enderror"
                               name="users[0][password]"
                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$"
                               minlength="8"
                               required>
        
                        @error('users.0.password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                        
                    <div class="col-md-6">
                        <button class="btn btn-outline-secondary" type="button" onclick="generatePassword(0)">
                            自動生成
                        </button>
                        
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(0, this)">
                            👁 表示
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-success" onclick="addField()">＋ 記入欄追加</button>
        <button type="button" class="btn btn-secondary ms-3" onclick="deleteField()">ー 記入欄削除</button>
    </div>
    <button type="submit" class="btn btn-primary">登録</button>
</form>

<script>
    let userCount = 2;
    let field_string = 'field';
    
    function addField() {
        var id_string = field_string + userCount;
        const container = document.getElementById('user-forms');
        const newForm = document.createElement('div');
        newForm.id = id_string;
        newForm.classList.add('card', 'user-form', 'mb-3');
        newForm.innerHTML = `
            <div class="card-header">{{ __('${userCount}人目') }}</div>
            <div class="card-body">
                <div class="row mb-3">
                    <label for="user_id_${userCount-1}" class="col-md-2 col-form-label text-md-end">{{ __('ID') }}</label>
        
                    <div class="col-md-4">
                        <input id="user_id_${userCount-1}"
                               type="text"
                               class="form-control @error('users.${userCount-1}.user_id') is-invalid @enderror"
                               name="users[${userCount-1}][user_id]"
                               value="{{ old('users.${userCount-1}.user_id') }}"
                               pattern="^[A-Z0-9]{7}$"
                               maxlength="7"
                               required
                               autofocus>
        
                        @error('users[${userCount-1}][user_id]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-form-label">
                        大文字アルファベット、数字合わせて7桁（例:06R0100）
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label for="name_${userCount-1}" class="col-md-2 col-form-label text-md-end">{{ __('名前') }}</label>
        
                    <div class="col-md-4">
                        <input id="name_${userCount-1}"
                               type="text"
                               class="form-control @error('users.${userCount-1}.name') is-invalid @enderror"
                               name="users[${userCount-1}][name]"
                               value="{{ old('users.${userCount-1}.name') }}"
                               required>
        
                        @error('users.${userCount-1}.name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-form-label">
                        
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="recipients_${userCount-1}" class="col-md-2 col-form-label text-md-end">{{ __('受給者証番号') }}</label>
        
                    <div class="col-md-4">
                        <input id="recipients_${userCount-1}"
                               type="text"
                               class="form-control @error('users.${userCount-1}.recipients') is-invalid @enderror"
                               name="users[${userCount-1}][recipients]"
                               value="{{ old('users.${userCount-1}.recipients') }}"
                               pattern="^\\d{10}$"
                               maxlength="10"
                               inputmode="numeric"
                               required>
        
                        @error('users.${userCount-1}.recipients')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-form-label">
                        数字10桁
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label for="password_${userCount-1}" class="col-md-2 col-form-label text-md-end">{{ __('初期パスワード') }}</label>
        
                    <div class="col-md-4">
                        <input id="password_${userCount-1}"
                               type="password"
                               class="form-control @error('users.${userCount-1}.password') is-invalid @enderror"
                               name="users[${userCount-1}][password]"
                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[A-Za-z\\d]{8,}$"
                               minlength="12"
                               required>
        
                        @error('users.${userCount-1}.password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <button class="btn btn-outline-secondary" type="button" onclick="generatePassword(${userCount-1})">
                            自動生成
                        </button>
                        
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(${userCount-1}, this)">
                            👁 表示
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(newForm);
        userCount++;
    }
    
    function deleteField() {
        userCount--;
        var id_string = field_string + userCount;
        const target = document.getElementById(id_string);
        
        if (target) {
            target.remove();
        }
    }
    
    function togglePassword(index, btn) {
        const input = document.getElementById(`password_${index}`);
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;
        btn.textContent = (type === 'password') ? '👁 表示' : '🙈 非表示';
    }

    function generatePassword(index) {
        const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let password = '';
        for (let i = 0; i < 12; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById(`password_${index}`).value = password;
        document.getElementById(`password_${index}`).type = 'password';
        document.getElementById(`password_${index}`).textContent = '👁 表示'; // ボタンもリセット
    }
    
</script>


@endsection
@extends('records.layout')

@section('content')
    <?php
    /*
        // 指定年月の1日をセット
        $datetime = new DateTime("$year-$month-01");
        
        // 前月に変更
        $datetime->modify('first day of last month');
        
        // 前月の年と月を取得
        $prev_year = $datetime->format('Y'); // 年 (4桁)
        $prev_month = $datetime->format('m'); // 月 (2桁)
        
        // 指定年月の1日をセット
        $datetime = new DateTime("$year-$month-01");
        
        // 次月に変更
        $datetime->modify('first day of next month');
        
        // 次月の年と月を取得
        $next_year = $datetime->format('Y'); // 年 (4桁)
        $next_month = $datetime->format('m'); // 月 (2桁)
    */
    
        //コントローラーから渡されたmonthを0埋めでない数値に変換
        $month_int = intval($month);
    
    ?>
    <div class="container mt-5">
        <h1>就労移行支援提供実績記録表</h1>
        <div class="fs-5"><span class="fw-bold">{{$year}}年<?= intval($month); ?>月分</span></div>
        <div class="d-flex mt-1 mb-3">
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                表示する月を変更
              </button>
              <ul class="dropdown-menu">
                  <?php
                      $current_year = intval(date("Y"));
                      $current_month = intval(date("m"));
                      $target_year = $current_year;
                      $target_month = $current_month;
                      for($i=0; $i<12; $i++){
                          //for文の探索対象の年月と表示されている年月が一致している場合
                          if($target_year == intval($year) && $target_month == intval($month)){
                              //ドロップダウンリストには表示しない
                          //それ以外の場合      
                          }else{
                              //for文の探索対象の年月が現在の年月である場合
                              //リンクは/records
                              if($target_year == $current_year && $target_month == $current_month){
                                  echo  '<li><a class="dropdown-item" href="'. (route('record.show_current') ). '">'.$current_year.'年'.$current_month.'月</a></li>';
                              }else{
                              //0埋めの文字列に変換
                              $target_month_str = sprintf("%02d", $target_month); 
                              //ドロップダウンリストに表示する
                              //リンクは/records/{year_month}
                                  echo '<li><a class="dropdown-item" href="'. (route('record.show_other', ['year_month' => $target_year.$target_month_str]) ). '">'.strval($target_year).'年'.strval($target_month).'月</a></li>';
                              }
                          }
                          //for文の探索対象の月が1月の場合
                          if($target_month == 1){
                              //前年の12月に戻る
                              $target_year -= 1;
                              $target_month = 12;
                          //それ以外の場合
                          }else{
                              //前の月に移る
                              $target_month -= 1;
                          }
                      }
                  ?>
              </ul>
            </div>
        </div>
        
        <form action="{{ route('record.update', ['year_month' => $year_month]) }}" method="POST">
            @csrf        
        
            <div class="d-flex mb-2">
                <div>閲覧</div>
                    <div class="form-check form-switch">
            		    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            	    </div>
                <div>編集</div>
                <button class="btn btn-primary ms-2 invisible" id="saveButton" onclick="saveData()">保存</button>
            </div>
        
        
            <!-- 閲覧モードの場合のテーブル -->
            <table class="table table-hover table-bordered" id="table1">
                <thead class="table-warning">
                    <tr class="custom-bg">
                        <th colspan="2"></th>
                        <th colspan="7">サービス提供実績</th>
                        <th colspan="2">電車・バス</th>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <th>日付</th><th>曜日</th><th>開始時間<br>(時:分)</th><th>終了時間<br>(時:分)</th><th>欠席加算</th><th>施設外支援</th>
                        <th>食事提供</th><th>体調</th><th>検温(℃)</th><th>行き</th><th>帰り</th><th>在宅</th><th>備考</th>
                    </tr>
                </thead>
                @foreach ($records as $record)
                    <tr class="table-primary">
                        <!-- 日付 -->
                        <td>{{ $record->day }}</td>
                        <!-- 曜日 -->
                        <td>{{ $record->day_of_week }}</td>
                        <!-- 開始時間 -->
                        <td>
                            <?php
                                if( $record->start_time == NULL){
                                    echo "";
                                }else{
                                    echo substr($record->start_time,0,5);
                                }
                            ?>
                        </td>
                        <!-- 終了時間 -->
                        <td>
                            <?php
                                if( $record->end_time == NULL ){
                                    echo "";
                                }else{
                                    echo substr($record->end_time,0,5);
                                }
                            ?>
                        </td>
                        <!-- 欠席加算 -->
                        <td>
                            <?php
                                if( $record->absense == 0 ){
                                    echo "";
                                }else{
                                    echo "〇";
                                }
                            ?>
                        </td>
                        <!-- 施設外支援 -->
                        <td>
                            <?php
                                if( $record->out_of_fs == 0 ){
                                    echo "";
                                }else{
                                    echo "〇";
                                }
                            ?>
                        </td>
                        <!-- 食事提供 -->
                        <td>
                            <?php
                                if( $record->meal == 0 ){
                                    echo "";
                                }else{
                                    echo "〇";
                                }
                            ?>
                        </td>
                        <!-- 体調 -->
                        <td>
                            <?php
                                if( $record->physical_condition == 0 ){
                                    echo "";
                                }elseif( $record->physical_condition == 1 ){
                                    echo "とても悪い";
                                }elseif( $record->physical_condition == 2 ){
                                    echo "悪い";
                                }elseif( $record->physical_condition == 3 ){
                                    echo "普通";
                                }elseif( $record->physical_condition == 4 ){
                                    echo "良い";
                                }else{
                                    echo "とても良い";
                                }
                            ?>
                        </td>
                        <!-- 検温 -->
                        <td>
                            <?php
                                if( $record->body_temperature == NULL ){
                                    echo "";
                                }else{
                                    echo $record->body_temperature;
                                }
                            ?>
                        </td>
                        <!-- 行き -->
                        <td>
                            <?php
                                if( $record->going == 0 ){
                                    echo "";
                                }else{
                                    echo "〇";
                                }
                            ?>
                        </td>
                        <!-- 帰り -->
                        <td>
                            <?php
                                if( $record->coming == 0 ){
                                    echo "";
                                }else{
                                    echo "〇";
                                }
                            ?>
                        </td>
                        <!-- 在宅 -->
                        <td>
                            <?php
                                if( $record->home == 0 ){
                                    echo "";
                                }else{
                                    echo "〇";
                                }
                            ?>
                        </td>
                        <!-- 備考 -->
                        <td>
                            <?php
                                if( $record->note == NULL ){
                                    echo "";
                                }else{
                                    echo $record->note;
                                }
                            ?>
                        </td>
                    </tr>
                @endforeach
            </table>

            <!-- 編集モードの場合のテーブル -->
            <table class="table table-hover table-bordered d-none" id="table2">
                <thead class="table-warning">
                <tr>
                    <th colspan="2"></th>
                    <th colspan="7">サービス提供実績</th>
                    <th colspan="2">電車・バス</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th>日付</th><th>曜日</th><th>開始時間<br>(時:分)</th><th>終了時間<br>(時:分)</th><th>欠席加算</th><th>施設外支援</th>
                    <th>食事提供</th><th>体調</th><th>検温(℃)</th><th>行き</th><th>帰り</th><th>在宅</th><th>備考</th>
                </tr>
                </thead>
                @foreach ($records as $record)
                    <input type="hidden" name="record_ids[]" value="{{ $record->id }}">
                    <tr class="table-primary">
                        <!-- 日付 -->
                        <td>{{ $record->day }}</td>
                        <!-- 曜日 -->
                        <td>{{ $record->day_of_week }}</td>
                        <!-- 開始時間 -->
                        <td>
                            <input type="time" name="start_times[]" min="09:30" max="15:15" value={{ $record->start_time }}>
                        </td>
                        <!-- 終了時間 -->
                        <td>
                            <input type="time" name="end_times[]" min="09:30" max="15:15" value={{ $record->end_time }}>
                        </td>
                        <!-- 欠席加算 -->
                        <td>
                            <!--
                            <select name="absenses[]" class="form-select" value={{ $record->absense }}>
                                <option value="0" {{ $record->absense == 0 ? 'selected' : '' }}></option>
                                <option value="1" {{ $record->absense == 1 ? 'selected' : '' }}>〇</option>
                            </select>
                            -->
                            
                            <?php
                                if( $record->absense == 0 ){
                                    echo "";
                                }else{
                                    echo "〇";
                                }
                            ?>
                        </td>
                        <!-- 施設外支援 -->
                        <td>
                            <!--
                            <select name="out_of_fses[]" class="form-select" value={{ $record->out_of_fs }}>
                                <option value="0" {{ $record->out_of_fs == 0 ? 'selected' : '' }}></option>
                                <option value="1" {{ $record->out_of_fs == 1 ? 'selected' : '' }}>〇</option>
                            </select>
                            -->
                            
                            <?php
                                if( $record->out_of_fs == 0 ){
                                    echo "";
                                }else{
                                    echo "〇";
                                }
                            ?>
                        </td>
                        <!-- 食事提供 -->
                        <td>
                            <select name="meals[]" class="form-select" value={{ $record->meal }}>
                                <option value="0" {{ $record->meal == 0 ? 'selected' : '' }}></option>
                                <option value="1" {{ $record->meal == 1 ? 'selected' : '' }}>〇</option>
                            </select>
                        </td>
                        <!-- 体調 -->
                        <td>
                            <select name="physical_conditions[]" class="form-select" value={{ $record->physical_condition }}>
                                <option value="0" {{ $record->physical_condition == 0 ? 'selected' : '' }}></option>
                                <option value="1" {{ $record->physical_condition == 1 ? 'selected' : '' }}>とても悪い</option>
                                <option value="2" {{ $record->physical_condition == 2 ? 'selected' : '' }}>悪い</option>
                                <option value="3" {{ $record->physical_condition == 3 ? 'selected' : '' }}>普通</option>
                                <option value="4" {{ $record->physical_condition == 4 ? 'selected' : '' }}>良い</option>
                                <option value="5" {{ $record->physical_condition == 5 ? 'selected' : '' }}>とても良い</option>
                            </select>
                        </td>
                        <!-- 検温 -->
                        <td>
                            <input 
                              type="number" 
                              class="form-control" 
                              id="numberInput" 
                              name="body_temperatures[]"
                              step="0.1" 
                              min="0" 
                              max="99.9" 
                              pattern="^(\d{1,2})(\.\d)?$"
                              value="{{ $record->body_temperature }}"
                              placeholder="例: 36.5"
                            >
                        </td>
                        <!-- 行き -->
                        <td>
                            <select name="goings[]" class="form-select" value={{ $record->going }}>
                                <option value="0" {{ $record->going == 0 ? 'selected' : '' }}></option>
                                <option value="1" {{ $record->going == 1 ? 'selected' : '' }}>〇</option>
                            </select>
                        </td>
                        <!-- 帰り -->
                        <td>
                            <select name="comings[]" class="form-select" value={{ $record->coming }}>
                                <option value="0" {{ $record->coming == 0 ? 'selected' : '' }}></option>
                                <option value="1" {{ $record->coming == 1 ? 'selected' : '' }}>〇</option>
                            </select>
                        </td>
                        <!-- 在宅 -->
                        <td>
                            <!--
                            <select name="homes[]" class="form-select" value={{ $record->home }}>
                                <option value="0" {{ $record->home == 0 ? 'selected' : '' }}></option>
                                <option value="1" {{ $record->home == 1 ? 'selected' : '' }}>〇</option>
                            </select>
                            -->
                            
                            <?php
                                if( $record->home == 0 ){
                                    echo "";
                                }else{
                                    echo "〇";
                                }
                            ?>
                        </td>
                        <!-- 備考 -->
                        <td>
                            <input type="text" class="form-control" name="notes[]" maxlength="30" value="{{ $record->note }}" placeholder="30文字まで入力可能">
                        </td>
                    </tr>
                @endforeach
            </table>
        </form>
    </div>
    
    <script>
        const switchElement = document.getElementById('flexSwitchCheckDefault');
        const table1 = document.getElementById('table1');
        const table2 = document.getElementById('table2');
    
        switchElement.addEventListener('change', () => {
          if (switchElement.checked) {
            table1.classList.add('d-none');
            table2.classList.remove('d-none');
            saveButton.classList.remove('invisible');
          } else {
            table1.classList.remove('d-none');
            table2.classList.add('d-none');
            saveButton.classList.add('invisible');
          }
        });
    </script>
@endsection
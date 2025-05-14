<?php

namespace App\Http\Controllers;

use App\Models\Records;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_current_month()
    {
        $user = \Auth::user();
        //現在の年と月を取得
        $year = date("Y");
        $month = date("m");
        $year_month = $year.$month;
        
        $records = $this->show($year_month, $user);
        
        return view('records.show', ['records' => $records, 'year_month' => $year_month, 'year' => $year, 'month' => $month]);
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_other_month($year_month)
    {
        $user = \Auth::user();
        
        $records = $this->show($year_month, $user);
        
        $year = substr($year_month, 0, 4);
        $month = substr($year_month, 4, 2);
        
        return view('records.show', ['records' => $records, 'year_month' => $year_month, 'year' => $year, 'month' => $month]);

    }
    
    public function show($year_month, $user)
    {
        //$year_month = $year.$month;
        
        //当月分のデータを取得
        $records = Records::where('user_id', $user->user_id)
        ->where('year_m', $year_month)->get();
        
        //当月分のデータがない場合
        if($records->isEmpty()) {
            $new_records = $this->store($year_month, $user);
            return $new_records;
        //当月分のデータがある場合
        }else{
            return $records;
        }
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($year_month, $user)
    {
        //年月(例:202504)
        //$year_month = $year.$month;
        //引数で渡ってきた月の日数を取得
        $year = substr($year_month, 0, 4);
        $month = substr($year_month, 4, 2);
        
        $day_count = date('t', mktime(0,0,0,intval($month),1,intval($year)));
        //配列を使用し、要素順に(日:0〜土:6)を設定する
        $week = [
          '日', //0
          '月', //1
          '火', //2
          '水', //3
          '木', //4
          '金', //5
          '土', //6
        ];
                
        for($count=1; $count<$day_count+1; $count++){
            //曜日を取得
            $timestamp = mktime(0, 0, 0, intval($month), $count, intval($year));
            $day_of_week = $week[date('w', $timestamp)];
            
            $record = new Records;
            //各カラムにデフォルト値を設定
            $record->user_id = $user->user_id;
            $record->year_m = $year_month;
            $record->day = $count;
            $record->day_of_week = $day_of_week;
            $record->start_time = NULL;
            $record->end_time = NULL;
            $record->absense = 0;
            $record->meal = 0;
            $record->physical_condition = 0;
            $record->body_temperature = NULL;
            $record->going = 0;
            $record->coming = 0;
            $record->home = 0;
            $record->note = NULL;
            //DBに保存
            $record->save();
        }
        
        $records = Records::where('user_id', $user->user_id)
        ->where('year_m', $year_month)->get();
        
        return $records;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function edit(Records $records, $id)
    {

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $year_month)
    {

        foreach ($request->input('record_ids') as $index => $id){
            $start_time = $request->input('start_times')[$index];
            $end_time = $request->input('end_times')[$index];
            //$absense = $request->input('absenses')[$index];
           // $out_of_fs = $request->input('out_of_fses')[$index];
            $meal = $request->input('meals')[$index];
            $physical_condition = $request->input('physical_conditions')[$index];
            $body_temperature = $request->input('body_temperatures')[$index];
            $going = $request->input('goings')[$index];
            $coming = $request->input('comings')[$index];
            //$home = $request->input('homes')[$index];
            $note = $request->input('notes')[$index];
            
            Records::where('id', $id)->update(['start_time' => $start_time]);
            Records::where('id', $id)->update(['end_time' => $end_time]);
            //Records::where('id', $id)->update(['absense' => $absense]);
            //Records::where('id', $id)->update(['out_of_fs' => $out_of_fs]);
            Records::where('id', $id)->update(['meal' => $meal]);
            Records::where('id', $id)->update(['physical_condition' => $physical_condition]);
            Records::where('id', $id)->update(['body_temperature' => $body_temperature]);
            Records::where('id', $id)->update(['going' => $going]);
            Records::where('id', $id)->update(['coming' => $coming]);
            //Records::where('id', $id)->update(['home' => $home]);
            Records::where('id', $id)->update(['note' => $note]);
        }
        
        
        $current_year_month = date("Ym");

        //引数から渡ってきた年月が現在の年月と一致している場合
        if($year_month == $current_year_month){
            return redirect()->route('record.show_current');
        //引数から渡ってきた年月が現在の年月と一致していない場合
        }else{
            return redirect()->route('record.show_other', ['year_month' => $year_month]);
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Records  $records
     * @return \Illuminate\Http\Response
     */
    public function destroy(Records $records)
    {
        //
    }
}

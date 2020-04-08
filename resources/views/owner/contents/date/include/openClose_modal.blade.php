    <div class="col-sm-12 border_bottom">
    <h4 class="text-info f14">基本営業時間</h4>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="non-off" value="1" @if( old('non-off', $company_calendar->non_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">年中無休</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="open-24" value="1" @if( old('open-24', $company_calendar->open_24) ) checked @endif  >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">２４時間営業</span>
        </label>
    </div>
    <div class="form-group col-6">
        <label for="start"> 営業開始時間 <br /> <small>(各曜日の開始時間に反映)</small></label>
        <input type="time" name="start" class="form-control f24 center" id="start" value="{!! old('start') !!}" />
    </div>
    <div class="form-group col-6">
        <label for="end"> 営業終了時間 <br /> <small>(各曜日の終了時間に反映)</small></label>
        <input type="time" name="end" class="form-control f24 center" id="end" value="{!! old('end') !!}" required />
    </div>

    <div class="form-group col-6">
        <label for="start-junbi"> 準備開始時間 <br /> <small>(各曜日の準備開始時間に反映)</small></label>
        <input type="time" name="start-junbi" class="form-control f24 center" id="start-junbi" value="{!! old('start-junbi') !!}" />
    </div>
    <div class="form-group col-6">
        <label for="end-junbi"> 準備終了時間 <br /> <small>(各曜日の準備終了時間に反映)</small></label>
        <input type="time" name="end-junbi" class="form-control f24 center" id="end-junbi" value="{!! old('end-junbi') !!}" required />
    </div>



    <div class="col-sm-12">
    <h4 class="text-info f14">各曜日・祝日ごとの営業時間</h4>
    </div>
    
    <div class="col-sm-12 border_both">
    <h5 class="text-info f14">月曜日</h5>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="mon-off" value="1" @if( old('mon-off', $company_calendar->mon_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">お休み</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input mycheckbox" name="mon-end-nextday" value="1" @if( old('mon-end-nextday', $company_calendar->mon_end_nextday) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span title="営業終了時間が翌日になる場合はチェックを入れてください。" class="custom-control-description">翌日フラグ</span>
        </label>
        @if ($errors->has('mon-off'))
        <span class="help-block has-error"><strong>{{ $errors->first('mon-off') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="mon-start"> 営業開始時間</label>
        <input type="time" name="mon-start" class="form-control f24 center" id="mon-start"  value="{!! old('mon-start',$company_calendar->mon_start) !!}" />
        @if ($errors->has('mon-start'))
        <span class="help-block has-error"><strong>{{ $errors->first('mon-start') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="mon-end"> 営業終了時間</label>
        <input type="time" name="mon-end" class="form-control f24 center" id="mon-end" value="{!! old('mon-end',$company_calendar->mon_end) !!}" />
        @if ($errors->has('mon-end'))
        <span class="help-block has-error"><strong>{{ $errors->first('mon-end') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="mon-start-junbi"> 準備開始時間</label>
        <input type="time" name="mon-start-junbi" class="form-control f24 center" id="mon-start-junbi" value="{!! old('mon-start-junbi',$company_calendar->mon_start_junbi) !!}" />
    </div>
    <div class="form-group col-6">
        <label for="mon-end-junbi"> 準備終了時間</label>
        <input type="time" name="mon-end-junbi" class="form-control f24 center" id="mon-end-junbi" value="{!! old('mon-end-junbi',$company_calendar->mon_end_junbi) !!}" />
    </div>

    
    <div class="col-sm-12 border_both">
    <h5 class="text-info f14">火曜日</h5>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="tue-off" value="1" @if( old('tue-off', $company_calendar->tue_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">お休み</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="tue-end-nextday" value="1" @if( old('tue-end-nextday', $company_calendar->tue_end_nextday) ) checked @endif />
            <span class="custom-control-indicator"></span>
            <span title="営業終了時間が翌日になる場合はチェックを入れてください。" class="custom-control-description">翌日フラグ</span>
        </label>
        @if ($errors->has('tue-off'))
        <span class="help-block has-error"><strong>{{ $errors->first('tue-off') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="tue-start"> 営業開始時間</label>
        <input type="time" name="tue-start" class="form-control f24 center" id="tue-start" value="{!! old('tue-start',$company_calendar->tue_start) !!}" />
        @if ($errors->has('tue-start'))
        <span class="help-block has-error"><strong>{{ $errors->first('tue-start') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="tue-end"> 営業終了時間</label>
        <input type="time" name="tue-end" class="form-control f24 center" id="tue-end" value="{!! old('tue-end',$company_calendar->tue_end) !!}" />
        @if ($errors->has('tue-end'))
        <span class="help-block has-error"><strong>{{ $errors->first('tue-end') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="tue-start-junbi"> 準備開始時間</label>
        <input type="time" name="tue-start-junbi" class="form-control f24 center" id="tue-start-junbi" value="{!! old('tue-start-junbi',$company_calendar->tue_start_junbi) !!}" />
    </div>
    <div class="form-group col-6">
        <label for="tue-end-junbi"> 準備終了時間</label>
        <input type="time" name="tue-end-junbi" class="form-control f24 center" id="tue-end-junbi" value="{!! old('tue-end-junbi',$company_calendar->tue_end_junbi) !!}" />
    </div>




    
    <div class="col-sm-12 border_both">
    <h5 class="text-info f14">水曜日</h5>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="wed-off" value="1" @if( old('wed-off', $company_calendar->wed_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">お休み</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="wed-end-nextday" value="1" @if( old('wed-end-nextday', $company_calendar->wed_end_nextday) ) checked @endif />
            <span class="custom-control-indicator"></span>
            <span title="営業終了時間が翌日になる場合はチェックを入れてください。" class="custom-control-description">翌日フラグ</span>
        </label>
        @if ($errors->has('wed-off'))
        <span class="help-block has-error"><strong>{{ $errors->first('wed-off') }}</strong></span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="wed-start"> 営業開始時間</label>
        <input type="time" name="wed-start" class="form-control f24 center" id="wed-start" value="{!! old('wed-start',$company_calendar->wed_start) !!}" />
        @if ($errors->has('wed-start'))
        <span class="help-block has-error"><strong>{{ $errors->first('wed-start') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="wed-end"> 営業終了時間</label>
        <input type="time" name="wed-end" class="form-control f24 center" id="wed-end" value="{!! old('wed-end',$company_calendar->wed_end) !!}" />
        @if ($errors->has('wed-end'))
        <span class="help-block has-error"><strong>{{ $errors->first('wed-end') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="wed-start-junbi"> 準備開始時間</label>
        <input type="time" name="wed-start-junbi" class="form-control f24 center" id="wed-start-junbi" value="{!! old('wed-start-junbi',$company_calendar->wed_start_junbi) !!}" />
    </div>
    <div class="form-group col-6">
        <label for="wed-end-junbi"> 準備終了時間</label>
        <input type="time" name="wed-end-junbi" class="form-control f24 center" id="wed-end-junbi" value="{!! old('wed-end-junbi',$company_calendar->wed_end_junbi) !!}" />
    </div>




    
    <div class="col-sm-12 border_both">
    <h5 class="text-info f14">木曜日</h5>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="thu-off" value="1" @if( old('thu-off', $company_calendar->thu_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">お休み</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="thu-end-nextday" value="1" @if( old('thu-end-nextday', $company_calendar->thu_end_nextday) ) checked @endif />
            <span class="custom-control-indicator"></span>
            <span title="営業終了時間が翌日になる場合はチェックを入れてください。" class="custom-control-description">翌日フラグ</span>
        </label>
        @if ($errors->has('thu-off'))
        <span class="help-block has-error"><strong>{{ $errors->first('thu-off') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="thu-start"> 営業開始時間</label>
        <input type="time" name="thu-start" class="form-control f24 center" id="thu-start" value="{!! old('thu-start',$company_calendar->thu_start) !!}" />
        @if ($errors->has('thu-start'))
        <span class="help-block has-error"><strong>{{ $errors->first('thu-start') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="thu-end"> 営業終了時間</label>
        <input type="time" name="thu-end" class="form-control f24 center" id="thu-end" value="{!! old('thu-start',$company_calendar->thu_end) !!}" />
        @if ($errors->has('thu-end'))
        <span class="help-block has-error"><strong>{{ $errors->first('thu-end') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="thu-start-junbi"> 準備開始時間</label>
        <input type="time" name="thu-start-junbi" class="form-control f24 center" id="thu-start-junbi" value="{!! old('thu-start-junbi',$company_calendar->thu_start_junbi) !!}" />
    </div>
    <div class="form-group col-6">
        <label for="thu-end-junbi"> 準備終了時間</label>
        <input type="time" name="thu-end-junbi" class="form-control f24 center" id="thu-end-junbi" value="{!! old('thu-end-junbi',$company_calendar->thu_end_junbi) !!}" />
    </div>



    
    <div class="col-sm-12 border_both">
    <h5 class="text-info f14">金曜日</h5>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="fri-off" value="1" @if( old('fri-off', $company_calendar->fri_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">お休み</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="fri-end-nextday" value="1" @if( old('fri-end-nextday', $company_calendar->fri_end_nextday) ) checked @endif />
            <span class="custom-control-indicator"></span>
            <span title="営業終了時間が翌日になる場合はチェックを入れてください。" class="custom-control-description">翌日フラグ</span>
        </label>
        @if ($errors->has('fri-off'))
        <span class="help-block has-error"><strong>{{ $errors->first('fri-off') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="fri-start"> 営業開始時間</label>
        <input type="time" name="fri-start" class="form-control f24 center" id="fri-start" value="{!! old('fri-start',$company_calendar->fri_start) !!}" />
        @if ($errors->has('fri-start'))
        <span class="help-block has-error"><strong>{{ $errors->first('fri-start') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="fri-end"> 営業終了時間</label>
        <input type="time" name="fri-end" class="form-control f24 center" id="fri-end" value="{!! old('fri-end',$company_calendar->fri_end) !!}" />
        @if ($errors->has('fri-end'))
        <span class="help-block has-error"><strong>{{ $errors->first('fri-end') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="fri-start-junbi"> 準備開始時間</label>
        <input type="time" name="fri-start-junbi" class="form-control f24 center" id="fri-start-junbi" value="{!! old('fri-start-junbi',$company_calendar->fri_start_junbi) !!}" />
    </div>
    <div class="form-group col-6">
        <label for="fri-end-junbi"> 準備終了時間</label>
        <input type="time" name="fri-end-junbi" class="form-control f24 center" id="fri-end-junbi" value="{!! old('fri-end-junbi',$company_calendar->fri_end_junbi) !!}" />
    </div>




    <div class="col-sm-12 border_both">
    <h5 class="text-info f14">土曜日</h5>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="sat-off" value="1" @if( old('sat-off', $company_calendar->sat_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">お休み</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="sat-end-nextday" value="1" @if( old('sat-end-nextday', $company_calendar->sat_end_nextday) ) checked @endif />
            <span class="custom-control-indicator"></span>
            <span title="営業終了時間が翌日になる場合はチェックを入れてください。" class="custom-control-description">翌日フラグ</span>
        </label>
        @if ($errors->has('sat-off'))
        <span class="help-block has-error"><strong>{{ $errors->first('sat-off') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="sat-start"> 営業開始時間</label>
        <input type="time" name="sat-start" class="form-control f24 center" id="sat-start" value="{!! old('sat-start',$company_calendar->sat_start) !!}" />
        @if ($errors->has('sat-start'))
        <span class="help-block has-error"><strong>{{ $errors->first('sat-start') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="sat-end"> 営業終了時間</label>
        <input type="time" name="sat-end" class="form-control f24 center" id="sat-end" value="{!! old('sat-end',$company_calendar->sat_end) !!}" />
        @if ($errors->has('sat-end'))
        <span class="help-block has-error"><strong>{{ $errors->first('sat-end') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="sat-start-junbi"> 準備開始時間</label>
        <input type="time" name="sat-start-junbi" class="form-control f24 center" id="sat-start-junbi" value="{!! old('sat-start-junbi',$company_calendar->sat_start_junbi) !!}" />
    </div>
    <div class="form-group col-6">
        <label for="sat-end-junbi"> 準備終了時間</label>
        <input type="time" name="sat-end-junbi" class="form-control f24 center" id="sat-end-junbi" value="{!! old('sat-end-junbi',$company_calendar->sat_end_junbi) !!}" />
    </div>





    <div class="col-sm-12 border_both">
    <h5 class="text-info f14">日曜日</h5>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="sun-off" value="1" @if( old('sun-off', $company_calendar->sun_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">お休み</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="sun-end-nextday" value="1" @if( old('sun-end-nextday', $company_calendar->sun_end_nextday) ) checked @endif />
            <span class="custom-control-indicator"></span>
            <span title="営業終了時間が翌日になる場合はチェックを入れてください。" class="custom-control-description">翌日フラグ</span>
        </label>
        @if ($errors->has('sun-off'))
        <span class="help-block has-error"><strong>{{ $errors->first('sun-off') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="sun-start"> 営業開始時間</label>
        <input type="time" name="sun-start" class="form-control f24 center" id="sun-start" value="{!! old('sun-start',$company_calendar->sun_start) !!}" />
        @if ($errors->has('sun-start'))
        <span class="help-block has-error"><strong>{{ $errors->first('sun-start') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="sun-end"> 営業終了時間</label>
        <input type="time" name="sun-end" class="form-control f24 center" id="sun-end" value="{!! old('sun-end',$company_calendar->sun_end) !!}" />
        @if ($errors->has('sun-end'))
        <span class="help-block has-error"><strong>{{ $errors->first('sun-end') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="sun-start-junbi"> 準備開始時間</label>
        <input type="time" name="sun-start-junbi" class="form-control f24 center" id="sun-start-junbi" value="{!! old('sun-start-junbi',$company_calendar->sun_start_junbi) !!}" />
    </div>
    <div class="form-group col-6">
        <label for="sun-end-junbi"> 準備終了時間</label>
        <input type="time" name="sun-end-junbi" class="form-control f24 center" id="sun-end-junbi" value="{!! old('sun-end-junbi',$company_calendar->sun_end_junbi) !!}" />
    </div>





    <div class="col-sm-12 border_both">
    <h5 class="text-info f14">祝日</h5>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="public-holiday-off" value="1" @if( old('public-holiday-off', $company_calendar->public_holiday_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">お休み</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="public-holiday-end-nextday" value="1" @if( old('public-holiday-end-nextday', $company_calendar->public_holiday_end_nextday) ) checked @endif />
            <span class="custom-control-indicator"></span>
            <span title="営業終了時間が翌日になる場合はチェックを入れてください。" class="custom-control-description">翌日フラグ</span>
        </label>
        @if ($errors->has('public-holiday-off'))
        <span class="help-block has-error"><strong>{{ $errors->first('public-holiday-off') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="public-holiday-start"> 営業開始時間</label>
        <input type="time" name="public-holiday-start" class="form-control f24 center" id="public-holiday-start" value="{!! old('public-holiday-start',$company_calendar->public_holiday_start) !!}" />
        @if ($errors->has('public-holiday-start'))
        <span class="help-block has-error"><strong>{{ $errors->first('public-holiday-start') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="public-holiday-end"> 営業終了時間</label>
        <input type="time" name="public-holiday-end" class="form-control f24 center" id="public-holiday-end" value="{!! old('public-holiday-end',$company_calendar->public_holiday_end) !!}" />
        @if ($errors->has('public-holiday-end'))
        <span class="help-block has-error"><strong>{{ $errors->first('public-holiday-end') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="public-holiday-start-junbi"> 準備開始時間</label>
        <input type="time" name="public-holiday-start-junbi" class="form-control f24 center" id="public-holiday-start-junbi" value="{!! old('public-holiday-start-junbi',$company_calendar->public_holiday_start_junbi) !!}" />
    </div>
    <div class="form-group col-6">
        <label for="public-holiday-end-junbi"> 準備終了時間</label>
        <input type="time" name="public-holiday-end-junbi" class="form-control f24 center" id="public-holiday-end-junbi" value="{!! old('public-holiday-end-junbi',$company_calendar->public_holiday_end_junbi) !!}" />
    </div>






    <div class="col-sm-12 border_both">
    <h5 class="text-info f14">年末年始（12/30 ~ 1/3）</h5>
    </div>
    <div class="form-group col-12">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="New-Year-Holiday-off" value="1" @if( old('New-Year-Holiday-off', $company_calendar->New_Year_Holiday_off) ) checked @endif >
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">お休み</span>
        </label>
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="New-Year-Holiday-end-nextday" value="1" @if( old('New-Year-Holiday-end-nextday', $company_calendar->New_Year_Holiday_end_nextday) ) checked @endif />
            <span class="custom-control-indicator"></span>
            <span title="営業終了時間が翌日になる場合はチェックを入れてください。" class="custom-control-description">翌日フラグ</span>
        </label>
        @if ($errors->has('New-Year-Holiday-off'))
        <span class="help-block has-error"><strong>{{ $errors->first('New-Year-Holiday-off') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="New-Year-Holiday-start"> 営業開始時間</label>
        <input type="time" name="New-Year-Holiday-start" class="form-control f24 center" id="New-Year-Holiday-start" value="{!! old('New-Year-Holiday-start',$company_calendar->New_Year_Holiday_start) !!}" />
        @if ($errors->has('New-Year-Holiday-start'))
        <span class="help-block has-error"><strong>{{ $errors->first('New-Year-Holiday-start') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="New-Year-Holiday-end"> 営業終了時間</label>
        <input type="time" name="New-Year-Holiday-end" class="form-control f24 center" id="New-Year-Holiday-end" value="{!! old('New-Year-Holiday-end',$company_calendar->New_Year_Holiday_end) !!}" />
        @if ($errors->has('New-Year-Holiday-end'))
        <span class="help-block has-error"><strong>{{ $errors->first('New-Year-Holiday-end') }}</strong></span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="New-Year-Holiday-start-junbi"> 準備開始時間</label>
        <input type="time" name="New-Year-Holiday-start-junbi" class="form-control f24 center" id="New-Year-Holiday-start-junbi" value="{!! old('New-Year-Holiday-start-junbi',$company_calendar->New_Year_Holiday_start_junbi) !!}" />
    </div>
    <div class="form-group col-6">
        <label for="New-Year-Holiday-end-junbi"> 準備終了時間</label>
        <input type="time" name="New-Year-Holiday-end-junbi" class="form-control f24 center" id="New-Year-Holiday-end-junbi" value="{!! old('New-Year-Holiday-end-junbi',$company_calendar->New_Year_Holiday_end_junbi) !!}" />
    </div>
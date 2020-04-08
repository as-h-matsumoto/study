
<div class="p-2" id="calendar-tab">

<div class="card">
<div class="card-body">

<div class="mb-6">
    <h4 class="center text-info border-bottom pb-6 pt-2">エントリーフォーム</h4>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Auth::check())
{!! Form::open(array('url' => '/account/yoyaku/contents/'.$content->id.'/recruit/entry', 'name' => 'action', 'method' => 'post', 'class' => ' row', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => '/register', 'name' => 'action', 'method' => 'post', 'class' => ' row', 'files'=> true)) !!}
@endif

    @if(!Auth::check())
    <div class="form-group col-sm-6">
      <label><i class="icon icon-star text-red-700"></i> 苗字 (例：佐藤)</label>
      @if($errors->has('name_first'))<span class="help-block has-error">{{ $errors->first('name_first') }}</span>@endif
      <input class="form-control form-control-lg" name="name_first" type="text" autofocus value="{!! old('name_first',$user_recruit->name_first) !!}" >
    </div>
    <div class="form-group col-sm-6">
      <label><i class="icon icon-star text-red-700"></i> 名前 (例：ひろみ)</label>
      @if($errors->has('name_second'))<span class="help-block has-error">{{ $errors->first('name_second') }}</span>@endif
      <input class="form-control form-control-lg" name="name_second" type="text" autofocus value="{!! old('name_second',$user_recruit->name_second) !!}" >
    </div>
    <div class="form-group col-sm-12">
      <label><i class="icon icon-star text-red-700"></i> Eメール</label>
      @if($errors->has('email'))<span class="help-block has-error">{{ $errors->first('email') }}</span>@endif
      <input class="form-control form-control-lg center" name="email" type="text" value="{!! old('email') !!}" required/>
    </div>
    <div class="form-group col-sm-6">
      <label><i class="icon icon-star text-red-700"></i> パスワード(6文字以上)</label>
      @if($errors->has('password'))<span class="help-block has-error">{{ $errors->first('password') }}</span>@endif
      <input class="form-control form-control-lg center" name="password" type="text" value="{!! old('password') !!}" required/>
    </div>
    <div class="form-group col-sm-6">
        <label><i class="icon icon-star text-red-700"></i> パスワード (確認)</label>
        @if($errors->has('password_confirmation'))<span class="help-block has-error">{{ $errors->first('password_confirmation') }}</span>@endif
        <input type="password" name="password_confirmation" class="form-control form-control-lg center" name="password_confirmation" required/>
    </div>
    <input type="hidden" name="content_id" value="{!!$content->id!!}">
    <div class="form-group col-sm-6">
      <label><i class="icon icon-star text-red-700"></i> 所在地</label>
      <div class="row">
        <div class="col-1">
          <label class="h4">〒</label>
        </div>
        <div class="col-10">
          <input class="form-control form-control-lg" name="postal_code" type="text" value="{!! old('postal_code',$user_recruit->postal_code) !!}" >
        </div>
      </div>
      @if($errors->has('country-area'))<span class="help-block has-error">{{ $errors->first('country-area') }}</span>@endif
      <select onChange="countryAreaChangeFunc()" id="country-area" name="country-area" class="form-control form-control-lg"></select>
      @if($errors->has('country-area-address-one'))<span class="help-block has-error">{{ $errors->first('country-area-address-one') }}</span>@endif
      <select onChange="countryAreaAddressOneChangeFunc()" id="country-area-address-one" name="country-area-address-one" class="form-control form-control-lg" style="width:100%;"></select>
      @if($errors->has('country-area-address-two'))<span class="help-block has-error">{{ $errors->first('country-area-address-two') }}</span>@endif
      <select id="country-area-address-two" name="country-area-address-two" class="form-control form-control-lg" style="width:100%;"></select>
      
      @if($errors->has('country-area-address-other'))<span class="help-block has-error">{{ $errors->first('country-area-address-other') }}</span>@endif
      <input class="form-control form-control-lg" name="country-area-address-other" type="text" value="{!! old('country-area-address-other',$user_recruit->country_area_address_other) !!}" style="width:100%;" >
      <span class="help-block">以外の住所</span>
    </div>

    <div class="form-group col-sm-6">
          <label><i class="icon icon-star text-red-700"></i> 学歴</label>
          @if($errors->has('career'))<span class="help-block has-error">{{ $errors->first('career') }}</span>@endif
          <textarea class="form-control form-control-lg" name="career" style="min-height:200px;" >{!! old('career',$user_recruit->career) !!}</textarea>
    </div>
    <div class="form-group col-sm-6">
      <label><i class="icon icon-star text-red-700"></i> 生年月日</label>
      @if($errors->has('dob'))<span class="help-block has-error">{{ $errors->first('dob') }}</span>@endif
      <input class="form-control form-control-lg" type="date" name="dob" value="{!! date("Y-m-d", strtotime(old('dob',$user_recruit->dob))) !!}">
    </div>

    <div class="form-group col-sm-6">
          <label><i class="icon icon-star text-red-700"></i> Tell(例：090-1234-5679) </label>
          @if($errors->has('tell'))<span class="help-block has-error">{{ $errors->first('tell') }}</span>@endif
          <input class="form-control form-control-lg" type="text" name="tell" value="{!! old('tell',$user_recruit->tell) !!}">
    </div>
    
    <div class="form-group col-sm-6">
          <label>ご自身のSNS</label>
          @if($errors->has('sns'))<span class="help-block has-error">{{ $errors->first('sns') }}</span>@endif
          <input class="form-control form-control-lg" type="url" name="sns" value="{!! old('sns',$user_recruit->sns) !!}">
    </div>
    <div class="form-group col-sm-6">
      <label for="personality" class="form-control-label">性別</label>
      <select class="custom-select mt-5" name="personality" id="personality" style="width:100%">
          <option value='1' @if( old('personality',$user_recruit->personality) ) checked @endif >男性</option>
          <option value='2' @if( old('personality',$user_recruit->personality) ) checked @endif >女性</option>
      </select>
    </div>
    <div class="form-group col-sm-6">
      <label for="privite_status" class="form-control-label">ステータス</label>
      <select class="custom-select mt-5" name="privite_status" id="privite_status" style="width:100%">
          <option value='1' @if( old('privite_status',$user_recruit->privite_status) ) checked @endif >未婚</option>
          <option value='2' @if( old('privite_status',$user_recruit->privite_status) ) checked @endif >既婚</option>
      </select>
    </div>
    <div class="form-group col-sm-6 center">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label for="mainPic" class="btn form-control-label f14 text-blue-700"><strong>顔写真アップ</strong></label>
            <input accept="image/*" type="file" class="" id="mainPic" name="mainPic" />
            <br /><span class="pt-4 mt-4" id="main_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
          </div>
          <div id="mainpreview" class="col-sm-6">
            <img src="@if($user_recruit->pic){!!Util::getPic('user', null, $user_recruit->pic, $user_recruit->id, 250, null)!!}@endif" style="width:120px;" />
          </div>
        </div>
    </div>
    @else
    <div class="col-sm-6"><p><span class="text-blue-grey-500">お名前: </span><span>{!!$user_recruit->name_first!!} {!!$user_recruit->name_second!!}</span><p></div>
    <div class="col-sm-6"><p><span class="text-blue-grey-500">Eメール: </span><span>{!!Auth::user()->email!!}</span><p></div>
    <div class="col-sm-6">
        <p><span class="text-blue-grey-500">住所: </span>
        <span>〒{!!Util::getCountryAreaName($user_recruit->postal_code)!!} 
                {!!Util::getCountryAreaName($user_recruit->country_area)!!} 
                {!!Util::getCountryAreaOneName($user_recruit->country_area_address_one)!!} 
                {!!Util::getCountryAreaTwoName($user_recruit->country_area_address_two)!!} 
                {!!$user_recruit->country_area_address_other!!}
        </span>
        <p>
    </div>
    <div class="col-sm-6"><p><span class="text-blue-grey-500">生年月日: </span><span>{!!date('Y年m月d日',strtotime($user_recruit->dob))!!}</span><p></div>
    <div class="col-sm-6"><p><span class="text-blue-grey-500">TELL: </span><span>{!!$user_recruit->tell!!}</span><p></div>
    <div class="col-sm-6"><p><span class="text-blue-grey-500">ご自身のSNS: </span><a class="text-blue-400" href="{!!$user_recruit->sns!!}">{!!$user_recruit->sns!!}</a><p></div>
    <?php $personality = ($user_recruit->personality===1) ? '男性' : '女性' ; ?>
    <div class="col-sm-6"><p><span class="text-blue-grey-500">性別: </span><span>{!!$personality!!}</span><p></div>
    <?php $privite_status = ($user_recruit->privite_status===1) ? '未婚' : '既婚' ; ?>
    <div class="col-sm-6"><p><span class="text-blue-grey-500">ステータス: </span><span>{!!$user_recruit->privite_status!!}</span><p></div>
    <div class="col-sm-6"><p><span class="text-blue-grey-500">学歴: </span><span>{!!nl2br($user_recruit->career)!!}</span><p></div>
    <div class="col-sm-6"><p><span class="text-blue-grey-500">顔写真: </span>@if($user_recruit->pic)<span><img src="{!!Util::getPic('user', null, $user_recruit->pic, Auth::user()->id, 250, null)!!}" style="width:120px;" /></span>@endif<p></div>
    <div class="col-sm-12 border-top border-bottom"><p class=" p-6 center"><i class="icon icon-information-outline text-danger s-4"></i> 上記を変更する場合は<a class="text-blue-400 px-2" href="/account/profile/recruit/edit">こちら</a>から変更してください。<p></div>
    @endif

    <div class="form-group col-sm-6">
      <label for="saiyoType" class="form-control-label"><i class="icon icon-star text-red-700"></i> 希望採用形態</label>
      <select class="custom-select mt-5" name="saiyoType" id="saiyoType" style="width:100%">
      @if($content_menu_recruit->recruit_type_1)<option value='1' @if(is_array(old('saiyoType')) && in_array(1, old('saiyoType'))) checked @endif >正社員</option>@endif
      @if($content_menu_recruit->recruit_type_2)<option value='2' @if(is_array(old('saiyoType')) && in_array(2, old('saiyoType'))) checked @endif >派遣</option>@endif
      @if($content_menu_recruit->recruit_type_3)<option value='3' @if(is_array(old('saiyoType')) && in_array(3, old('saiyoType'))) checked @endif >バイト</option>@endif
      </select>
    </div>
    
    <div class="form-group col-sm-6">
          <label><i class="icon icon-star text-red-700"></i> 希望職種 </label>
          <select class="custom-select mt-5" name="job" style="width:100%">
              @if($content_recruit_types)
              @foreach(Util::getRecruitType('summary', null, null) as $summary_key=>$summary_name)
                <?php $count = true; ?>
                @foreach(Util::getRecruitType('desc', $summary_key, null) as $desc_key=>$desc_name)
                  <?php $column = 'type' . $desc_key; ?>
                  @if($content_recruit_types->$column)
                    @if($count)
                    <?php $count = false; ?>
                    @endif
                    <option value="{!!$desc_key!!}">{!!$desc_name!!}</option>
                  @endif
                @endforeach
                @if(!$count)
                @endif
              @endforeach
              @endif
          </select>
    </div>

    <div class="form-group col-sm-6">
          <label>職歴</label>
          @if($errors->has('experience'))<span class="help-block has-error">{{ $errors->first('experience') }}</span>@endif
          <textarea class="form-control form-control-lg" name="experience" style="min-height:200px;" >{!! nl2br(old('experience',$user_recruit->experience)) !!}</textarea>
    </div>

    <div class="form-group col-sm-6">
          <label> 貢献できると考える能力</label>
          @if($errors->has('description'))<span class="help-block has-error">{{ $errors->first('description') }}</span>@endif
          <textarea class="form-control form-control-lg" name="description" style="min-height:200px;" >{!! nl2br(old('description',$user_recruit->description)) !!}</textarea>
    </div>

    <div class="col-sm-12 center">
          <label> 個人情報について</label>
          <p class="text-warning">この個人情報は、採用決定の判断のみで利用いたします。それ以外の利用はいたしません。採用合否の決定が済み次第、速やかにデータを破棄いたします。</p>
    </div>

    @if(!Auth::check())
    <div class="form-group col-sm-12">
        <div class="recaptcha">
            <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_API_KRY')}}" data-callback="recaptchaCallback"></div>
        </div>
    </div>
    @endif

    <div class="col-sm-12 center">
            <button type="submit" class="btn btn-info">
                <strong>この内容でエントリー</strong>
            </button>
    </div>


</form>

</div>
</div>



</div>


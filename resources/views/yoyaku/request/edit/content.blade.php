@extends('yoyaku/layouts/default')

{{-- Page title --}}
@section('title') {!!$content->name!!} 編集リクエスト @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="{!!$content->name!!} 編集リクエストページです。">
<meta name="keywords" content="Coordiy予約,飲食,予約管理">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="{!!$content->name!!} 編集リクエスト">
<meta property="og:description" content="{!!$content->name!!} 編集リクエストページです。">
<meta property="og:image" content="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content->id, 1600)}}">
<meta property="og:url" content="{!!$_SERVER['HTTP_HOST']!!}">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
@stop

{{-- page level styles --}}
@section('header_styles')
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop

{{-- content --}}
@section('content')
<div class="page-layout simple full-width">
<div class="page-content-wrapper">

    <div id="page-header-custom" class="sm-page-header-lg page-header p-6 row"
        style="background-image: url('{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content->id, 1600)}}')" >
    
        <div class="user-info col-md-8 col-sm-12 pt-4 center-sm">
            <span>
                <img title="{!!$content->name!!}" class="profile-image avatar huge page-header-img-m" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}">
                <br class="hidden-sm-over" />
                <span>
                    <span class="name f24">
                      <a href="/yoyaku?yoyaku_type_id={!!$content->id!!}" title="タイプ" alt="タイプ">{!!UtilYoyaku::getNewContentTagIcon($content->service, $key, null)!!}</a> {!!Util::truncateHeaderName($content->name,'page')!!}
                    </span>
                    @if( !($content->service===62 or $content->service===69 or $content->service===101) )
                    <br />
                    <span class="name mt-1">
                      <i class="icon icon-map-marker-radius s-4 text-red-A700" title="エリア" alt="エリア"></i> <a class="text-white-500" href="/yoyaku?country_area_id={!!$content->country_area_id!!}" title="都道府県" alt="都道府県">{!!Util::getCountryAreaName($content->country_area_id)!!}</a> >> <a class="text-white-500" href="/yoyaku?country_area_id={!!$content->country_area_id!!}&country_area_address_one_custom_id={!!$content->country_area_address_one!!}" title="市区" alt="市区">{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}</a> >> <a class="text-white-500" href="/yoyaku?country_area_id={!!$content->country_area_id!!}&country_area_address_one_custom_id={!!$content->country_area_address_one!!}&country_area_address_two_custom_id={!!$content->country_area_address_two!!}" title="町村" alt="町村">{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}</a>
                    </span>
                    @endif
                </span>
            </span>
        </div>
    </div>

    <div class="page-content row">
            
        <div class="card col-12 div-introduce border-bottom mb-2">
            <div class="card-body py-8 row">
                <div class="col-12 pb-8">
                    <p class="h2 center"><strong>
                        <span class="introduce-title-kagi-kakko">編集のご依頼、ありがとうございます！</span>
                    </strong></p>

                    <br /><br /><br />

                    <p class="h4 center"><strong>
                        編集リンクを送りますので、該当することにチェックを入れて「編集」を選択してください。
                    </strong></p>
                </div>
                <div class="col-12 py-2 px-6">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($message = Session::get('info'))
                    <div class="alert alert-info">
                        <ul>
                            <li>承りました。編集リンクを送りますので少々お待ちください。</li>
                        </ul>
                    </div>
                    
                    @endif

                    {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}

                    <div class="form-group col-sm-6">
                        <div class="recaptcha">
                            <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_API_KRY')}}" data-callback="recaptchaCallback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 pt-6">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="owner" class="form-check-input"/>
                                <span class="checkbox-icon"></span>
                                <span>オーナーですか？</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="iknow" class="form-check-input"/>
                                <span class="checkbox-icon"></span>
                                <span>良く知るお店ですか？</span>
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="content_id" value="{!!$content->id!!}" />

                    <div class="form-group col-sm-12 center pt-6">   
                        <button type="submit" id="submit" class="btn btn-info" disabled>編集</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
        
    @include('SenMonTen/include/footer')
    @include('include/footer')

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')
<script> function recaptchaCallback(param) { if(param) { document.getElementById('submit').disabled = ""; } } </script>
@stop

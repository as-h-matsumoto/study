@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 求人管理 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- content --}}
@section('content')

<div id="profile" class="page-layout simple right-sidebar">

    <div class="page-content-wrapper">

    @include('owner/contents/include/header')

    <!-- CONTENT -->
    <div class="page-content row py-2 px-6">

@if(empty($content_date_users))
<div class="col-12 p-10">
    <p class="text-info h3 center">エントリーはありません。</p>
</div>
@endif

@foreach($content_date_users as $content_date_user)
<?php $user_recruit = json_decode($content_date_user->user_recruit) ; ?>
<div id="content_date_user{{$content_date_user->id}}" class="col-12 mb-2">
    <div class="card row" >
        <div class="card-block-me p-0">
            <div class="row">
                <div class="col-sm-6 mb-2">
                    <div class="row">
                        <div class="col-6">
                            @if($user_recruit->pic)
                            <img class="" src="{!!Util::getPic('user', null, $user_recruit->pic, $user_recruit->user_id, 400, null)!!}" width="100%" />
                            @else
                            <img class="" src="/storage/assets/img/noimage.png" width="100%" />
                            @endif
                        </div>
        
                        <div class="col-6 pl-0 pt-2">
                            <table class="table-hover">
                            <tbody>
                            <tr>
                                <th class="text-info" title="お名前" alt="お名前">お名前</th>
                                <td>{!!$user_recruit->name_first!!} {!!$user_recruit->name_second!!}</td>
                            </tr>

                            @if($user_recruit->dob)
                            <tr>
                                <th class="text-info" title="年齢" alt="年齢">年齢</th>
                                <!-- <span>生:{!!date('Y年m月d日', strtotime($user_recruit->dob))!!}</span><br /> -->
                                <td>{!!Util::birthday($user_recruit->dob)!!}才</td>
                            </tr>
                            @endif

                            <tr>
                                <th class="text-info" title="性別" alt="性別">性別</th>
                                <?php $personality = ($user_recruit->personality===1) ? '男性' : '女性' ; ?>
                                <td>{!!$personality!!}</td>
                            </tr>

                            <tr>
                                <th class="text-info" title="年齢" alt="年齢">ステータス</th>
                                <?php $privite_status = ($user_recruit->privite_status===1) ? '未婚' : '既婚' ; ?>
                                <td>{!!$privite_status!!}</td>
                            </tr>

                            <tr>
                                <th class="text-info" title="SNS" alt="SNS">SNS</th>
                                <td><a class="text-blue-500" href="{!!$user_recruit->sns!!}">リンク</a></span></td>
                            </tr>

                            <tr>
                                <th class="text-info" title="電話番号" alt="電話番号">TEL</th>
                                <td>{!!$user_recruit->tell!!}</td>
                            </tr>

                            <tr>
                                <th class="text-info" title="年齢" alt="年齢">年齢</th>
                                <td>〒{!!Util::getCountryAreaName($user_recruit->postal_code)!!} 
                                    {!!Util::getCountryAreaName($user_recruit->country_area)!!} 
                                    {!!Util::getCountryAreaOneName($user_recruit->country_area_address_one)!!} 
                                    {!!Util::getCountryAreaTwoName($user_recruit->country_area_address_two)!!} 
                                    {!!$user_recruit->country_area_address_other!!}
                                </td>
                            </tr>

                            <tr>
                                <th class="text-info" title="希望職種" alt="希望職種">希望<br />職種</th>
                                <?php $summary_key = substr($content_date_user->recruit_entry_job, 0, 3); $summary_key = $summary_key.'00'; ?>
                                <td>{!!Util::getRecruitType('desc', (int)$summary_key, $content_date_user->recruit_entry_job)!!}</td>
                            </tr>

                            <tr>
                                <th class="text-info" title="希望採用形態" alt="希望採用形態">希望<br />形態</th>
                                <?php
                                switch ($content_date_user->recruit_saiyo_type){
                                    case 1: $recruit_saiyo_type = '正社員'; break;
                                    case 2: $recruit_saiyo_type = '派遣';   break;
                                    case 3: $recruit_saiyo_type = 'バイト'; break;
                                }
                                ?>
                                <td>{!!$recruit_saiyo_type!!}</td>
                            </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        
                <div class="col-sm-6 mb-2 pt-2">
                    <h5 class="center text-info">学歴</h5>
                    <p class="center">{!!nl2br($user_recruit->career)!!}</p>
                </div>
        
                <div class="col-sm-6 mb-2 pt-2">
                    <h5 class="center text-info">職歴</h5>
                    <p class="center">{!!nl2br($user_recruit->experience)!!}</p>
                </div>
        
                <div class="col-sm-6 mb-2 pt-2">
                    <h5 class="center text-info">貢献できると思う能力</h5>
                    <p class="center">{!!nl2br($user_recruit->description)!!}</p>
                </div>
            </div>
        </div>
        <div class="card-actions">
            <button id="status{!!$content_date_user->id!!}" class="action-btn action-btn-footer px-4 text-success h6" ><strong>ステータス：{!!Util::contentRecruitEntry($content_date_user->recruit_status_id,'name',null,null)!!}</strong></button>
            @if($content_date_user->recruit_status_id<=8)
            <a id="changeStatusFunc" class="float-right border-left" href="javascript:void(0)" onClick="upModal({!!$content_date_user->id!!});" ><button class="action-btn action-btn-footer text-blue-500 px-4 h6" ><strong>ステータス変更</strong></button></a>
            @endif
        </div>
    </div>
</div>
@endforeach



    </div>

    <div class="page-content-footer">
        <p class="right">
        </p>
    </div>
    @include('owner/include/footer')
    @include('include/footer')

</div>


<div class="modal fade" id="modalChengeRecruitEntryStatus" tabindex="-1" role="dialog" aria-labelledby="modalChengeRecruitEntryStatusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalChengeRecruitEntryStatusLabel">採用過程ステータス変更</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modalChengeRecruitEntryStatusform', 'name' => 'modalChengeRecruitEntryStatusform', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}

                <div class="col-sm-12">
                    <p class="h6">変更するステータスを選んでください。</p>
                </div>
                <div class="form-group col-sm-12">
                    <label for="type" class="form-control-label mb-6">ステータス</label>
                    <select class="custom-select" name="status" id="status" style="width:100%">
                    </select>
                </div>
                <input type="hidden" class="form-control" name="content_date_user_id" id="content_date_user_id" value="" >

                <div class="col-sm-12">
                    <p class=" text-warning">変更するとステージごとに登録したメール内容がエントリー者へ送信されます。</p>
                    <p class=" text-warning">お間違いないことを改めてご確認ください。</p>
                </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postChengeRecruitEntryStatus();" ><strong>ステータス変更</strong></button>
            </div>
        </div>
    </div>
</div>

@stop



{{-- footer scripts --}}
@section('footer_scripts')


<script>

function upModal(content_date_user_id) {

    axios.get('/owner/contents/{!!$content->id!!}/recruit/changeStatus', {
      params: {
        content_date_user_id: content_date_user_id
      }
    })
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        $('#status').html(result);
        $('#content_date_user_id').val(content_date_user_id);
        $('#modalChengeRecruitEntryStatus').modal('show');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}


function postChengeRecruitEntryStatus() {

    var form = document.getElementById("modalChengeRecruitEntryStatusform");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/recruit/changeStatus', form_data)
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        $('#status'+response.data.content_date_user_id).html(response.data.status_name);
        if(response.data.status_id>=9) $('#changeStatusFunc').html('');
        $('#modalChengeRecruitEntryStatus').modal('hide');
        $('#loading').hide();
        var message = '';
        if(response.data.status_id<=8){
            message += response.data.status_name + '依頼を行いました。<br />';
            message += 'エントリー者が都合の良い日時で面接予約を行います。<br />';
            message += 'それまで少々おまちください。';
        }else if(response.data.status_id===9){
            message += response.data.status_name + '連絡を行いました。<br />';
            message += '採用誠におめでとうございます。<br />';
            message += '新しいお仲間の活躍を願っております。';
        }else if(response.data.status_id===10){
            message += response.data.status_name + '連絡を行いました。<br />';
            message += '今回は誠に残念な結果となってしまいました。<br />';
            message += 'また、新しいが出会いがあることを願っております。';
        }else{
            warningNotify('エラー');
            return;
        }

        longNotify(message);
        
    })
    .catch(function (error) {
        $('#menuModal').modal('hide');
        ajaxCheckError(error); return;
    });

}









</script>

@stop


<div id="page-header" class="page-header row"
    style="background-image: url('{{Util::getPic('user', true, Auth::user()->back_pic, Auth::user()->id, 1600, false)}}')" >
    <div class="user-info col-12 center bg-mask p-6">
        <span>
            <span class="name pt-10">
                <span class="f24">
                    {!!$license_question_try_master->license_year.'年度'!!} {!!$license_question_try_master->schedule_name!!} &nbsp;&nbsp; {!!$license_question_try_master->subject_name!!}
                </span>
                <br />
                <br />
                <span class="f20">
                    @if( $license_question_try_master->master_type===1 ) 
                    練習問題を開始します。
                    @else
                    模擬試験を開始します。
                    @endif
                </span>
            </span>
        </span>
    </div>
</div>


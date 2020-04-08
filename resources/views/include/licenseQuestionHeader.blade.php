
<div id="page-header" class="sm-page-header-lg page-header p-6 row {{Util::monthClassNameReturn()}}" >
    <div class="user-info col-12 center">
        <span>
            <span><i class="icon icon-book-open-page-variant s-20"></i></span>
            <br class="hidden-sm-over" />
            <span class="name pl-4">
                <span class="f30">
                {!!Util::truncateHeaderName($license_question->license_name,'page')!!}
                </span>
                <br />
                <span class="f30">
                {!!Util::truncateHeaderName($license_question->license_year.'年度','page')!!} &nbsp; {!!Util::truncateHeaderName($license_question->license_phase.'次試験','page')!!}　
                </span>
                <br />
                @if(strpos($_SERVER["REQUEST_URI"], '/show')!==false)
                <span class="f30">
                    <a href="javascript:void(0)" class="mb-1 p-1 mr-1" onClick="loading(); niceBad('license_question', {!!$license_question->id!!}, 'good', 'Content')" title="いいね">
                      <small class="f14" id="niceContentgood{!!$license_question->id!!}">{!!$license_question->good_number!!}</small><i class="icon-thumb-up text-green-700 s-4"></i>
                    </a>
                    <a href="javascript:void(0)" class="mb-1 p-1 mr-1" onClick="loading(); niceBad('license_question', {!!$license_question->id!!}, 'bad', 'Content')" title="う～ん">
                      <small class="f14" id="niceContentbad{!!$license_question->id!!}">{!!$license_question->bad_number!!}</small><i class="icon-thumb-down text-primary-200 s-4"></i>
                    </a>
                    <a href="javascript:void(0)" class="mb-1 p-1 mr-1" title="リコメンド">
                      <i class="icon-comment-text text-accent-700 s-4"></i><small class="f14">{!!$license_question->recommend_number!!}件</small>
                    </a>
                    <a href="javascript:void(0)" class="mb-1 p-1 mr-1" id="favorite-license_question-{!!$license_question->id!!}">
                    @if($license_question->favo)
                      <span onClick="loading(); favorite('license_question', {!!$license_question->id!!}, 'delete')">
                        <i class="icon icon-star s-6 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i>
                      </span>
                    @else
                      <span onClick="loading(); favorite('license_question', {!!$license_question->id!!}, 'add')">
                        <i class="icon icon-star s-6 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i>
                      </span>
                    @endif
                    </a>
                </span>
                <br />
                @endif
                <span class="f30">
                {!!Util::truncateHeaderName($license_question->subject_name,'page')!!} &nbsp;{!!Util::truncateHeaderName('第'.$license_question->number.'問','page')!!}
                </span>
            </span>
        </span>
    </div>

</div>

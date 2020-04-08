<div class="row py-2 px-6" id="recruits-tab" style="display:none" >
    @if( !empty($contents) )
    @include('SenMonTen/include/search_contents_index')
    @else
    <div id="" class="page-layout simple full-width mb-2 col-12 p-0">
        <div class="card p-0 m-0">
            <div class="card-body p-0" style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
                <div class="bg-mask-hard p-10">
                    <p class="h5 pb-2 center">
                        <span class=""><strong>現在、求人は募集していません。</strong></span>
                    </p>
                    
                    <p class="center pt-6">
                      <span class="pr-2">オーナー様は<a href="/owner" class="text-info">こちら</a></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
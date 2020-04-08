
<div class="card col-12 border-bottom mt-2"
    style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
    <div class="card-body row bg-mask-hard pt-8">
        <div class="col-xl-12 mb-2 pt-8 px-0" data-aos="fade-up" data-aos-duration="3000">
            <p class="h2 center"><strong>
                <span class="introduce-title">メディア制作</span>
            </strong></p>
            <br />
            <br />
            <p class="h4 center"><span>納得の店舗サイトにするならご依頼ください。</span></p>
            <br /><br />

            <div class="table-responsive h5">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-info center"><strong>制作メディア<br />紹介文制作<br />イメージ制作</strong></th>
                            <th class="text-info center"><strong>料金<br />1件</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Util::ownerSupportTypeSpot(null,'key') as $key=>$spot)
                        <tr>
                            <td scope="row" class="center">{!!$spot['name']!!}</td>
                            <td class="center"><span>@if($spot['price']){!!'&yen;' .number_format($spot['price'])!!}@else{!!'無料'!!}@endif</span></td>
                        </tr>
                        @endforeach
                        @if($GLOBALS['urls'][1]==='owner')
                        <tr>
                            <td class="center" colspan="3"><button onClick="loading(); postSupportBuy(11)" class="btn btn-outline-info f20" ><strong>お問合せ</strong></button></td>
                        </tr>
                        @else
                        <tr>
                            <td class="center" colspan="3"><p class="text-success"><strong>問合せ：03-3527-9249</strong></p></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="card col-12 border-bottom mt-2"
    style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
    <div class="card-body bg-mask-hard row pt-8 ">
        <div class="col-12 mb-2 pt-8" data-aos="fade-up" data-aos-duration="3000">
            <p class="h2 center"><strong>
                <span class="introduce-title">運用サポート</span>
            </strong></p>
            <br />
            <br />
            <p class="h4 center"><span>日々の予約管理をサポートします。</span></p>
            <br /><br />

            <div class="table-responsive h5">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="center" style="min-width:100px !important;"><strong>サポート</strong></th>
                            <th class="center"><strong>ブロンズ</strong><br /><strong>無料</strong></th>
                            <th class="center"><strong>シルバー</strong><br /><strong>&yen;1,280</strong></th>
                            <th class="center"><strong>ゴールド</strong><br /><strong>&yen;4,980</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Util::ownerSupportTypePublic(null,'desc') as $key=>$desc)
                        <tr>
                            <th scope="row" class="center">
                                <a tabindex="0" class="" role="button"
                                    data-toggle="popover"
                                    data-placement="top"
                                    data-trigger="focus"
                                    data-content="{!!$desc['desc']!!}">
                                    {!!$desc['name']!!}
                                </a>
                            </th>
                            <td class="center">{!!$desc[1]!!}</td>
                            <td class="center">{!!$desc[2]!!}</td>
                            <td class="center">{!!$desc[3]!!}</td>
                        </tr>
                        @endforeach
                        @if($GLOBALS['urls'][1]==='owner')
                        <tr>
                            <td class="center" colspan="4"><button onClick="loading(); postSupportBuy(1)" class="btn btn-outline-info f20" ><strong>お問合せ</strong></button></td>
                        </tr>
                        @else
                        <tr>
                            <td class="center" colspan="4"><p class="text-success"><strong>問合せ：03-3527-9249</strong></p></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




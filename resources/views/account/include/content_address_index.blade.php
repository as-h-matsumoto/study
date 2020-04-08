
<?php $pic_src = Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400); ?>
<div class="col-sm">
    <div class="card clcard row" >
      <!-- pc -->
      <div class="hidden-xs">
        <div class="card-block-me p-0">
            <a>
              <img src="{!!$pic_src!!}" width="100%">
            </a>
            <div class="center">
              <h5 class="border-bottom">
                <span class="f14 text-blue-grey-800"><strong>@if($content->service===91){!!'面接会場'!!}@else{!!'店舗所在地'!!}@endif</strong></span>
              </h5>
            </div>
            <div class="center">
              <p>
                <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!$content->address!!}
                <br />
                <a class="text-blue-500" href="https://maps.google.com/maps?q={!!$content->address!!}" target="_blank" >マップ</a>
              </p>
              <p>
                <a href="tel:{!!$content->tell!!}" class="text-blue-800">TEL:{!!$content->tell!!}</a>
              </p>
            </div>
        </div>
      </div>

      <!-- smartphone -->
      <div class="hidden-xs-other">
        <div class="card-block-me p-0 m-0 row">
            <div class="col-4 p-0">
            <img src="{!!$pic_src!!}" width="100%" style="max-width:120px;">
            </div>
            <div class="col-8 pl-0 pb-1">
              <div class="center">
                <h5 class="border-bottom">
                  <span class="f14 text-blue-grey-800"><strong>面接会場</strong></span>
                </h5>
              </div>
              <div class="center">
                <p>
                  <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!$content->address!!}
                  <br />
                  <a class="text-blue-500" href="https://maps.google.com/maps?q={!!$content->address!!}" target="_blank" >マップ</a>
                </p>
                <p>
                  <a href="tel:{!!$content->tell!!}" class="text-blue-800">TEL:{!!$content->tell!!}</a>
                </p>
              </div>
            </div>
        </div>
      </div>

    </div>
</div>

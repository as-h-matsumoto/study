<div class="p-2 row" id="desc-tab">
    
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body p-0">
            <div id="page-header-custom-yoyaku" class="page-header p-4 row"
                style="background-image: url('{{Util::getPicMenu(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $menu->pic, $content->id, 1600, $menu->id)}}')" >
                <div class="user-info col-md-8 col-sm-12 center-sm">
                    <div class="pt-4 hidden-xs"></div>
                    <span class="pt-10">
                        <span class="name">
                            <span class="f24">
                                {!!$menu->name!!}
                            </span>
                        </span>
                    </span>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 mb-2">
        <div class="card" style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
            <div class="card-body row bg-mask-hard">
                <div class="col-xl-12 pb-8 mb-2" data-aos="fade-up" data-aos-duration="3000">
	                <p class="h2 center"><strong>
                        <span class="introduce-title-circle">{!!$menu->name!!}</span>
                    </strong></p>
                    @if($menu->description)
                    <br /><br />
                    <p class="h4 center"><strong>
                        {!!nl2br($menu->description)!!}
                    </strong></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($menu['steps'])
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body row">
                <?php $rightLeft = true; ?>
                @foreach($menu['steps'] as $step)
                @if($step->pic)
                    @if($rightLeft)
                    <?php $rightLeft = false; ?>
                    <div class="col-xl-6 pb-8 mb-2" data-aos="fade-right" data-aos-duration="3000">
                        <img src="/storage/uploads/contents/{!!$content->id!!}/menu/{!!$menu->id!!}/step/{!!$step->id!!}/{!!Util::addFilename($step->pic,'1600')!!}" width="100%" style="max-width:1600px;" />
                    </div>
                    <div class="col-xl-6 pb-8 mb-2 pt-8">
		                <p class="h2 center"><strong>
                          <span class="introduce-title-modan">{!!$step->title!!}</span>
                        </strong></p>
        
                        <br /><br /><br />
        
                        <p class="h4 center"><strong>
                          <span>{!!nl2br($step->description)!!}</span>
                        </strong></p>
                    </div>
                    @else
                    <?php $rightLeft = true; ?>
                    <div class="col-xl-6 pb-8 mb-2 pt-8">
		                <p class="h2 center"><strong>
                          <span class="introduce-title-kagi-kakko">{!!$step->title!!}</span>
                        </strong></p>
        
                        <br /><br /><br />
        
                        <p class="h4 center"><strong>
                          <span>{!!nl2br($step->description)!!}</span>
                        </strong></p>
                    </div>
                    <div class="col-xl-6 pb-8 mb-2" data-aos="fade-left" data-aos-duration="3000">
                        <img src="/storage/uploads/contents/{!!$content->id!!}/menu/{!!$menu->id!!}/step/{!!$step->id!!}/{!!Util::addFilename($step->pic,'1600')!!}" width="100%" style="max-width:1600px;" />
                    </div>
                    @endif
                @else
                    <div class="col-xl-12 pb-8 mb-2" data-aos="fade-up" data-aos-duration="3000">
		                <p class="h2 center"><strong>
                          <span class="introduce-title-modan">{!!$step->title!!}</span>
                        </strong></p>
        
                        <br /><br /><br />
        
                        <p class="h4 center"><strong>
                          <span>{!!nl2br($step->description)!!}</span>
                        </strong></p>
                    </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif


</div>


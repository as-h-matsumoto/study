@extends('account/layouts/default')

{{-- Page title --}}
@section('title') コメンディ売上げ @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')

<div id="project-dashboard" class="page-layout simple">

    <div class="page-content-wrapper">

        <!-- HEADER -->
        @include('account/include/header')
        <!-- / HEADER -->

        <!-- CONTENT -->
        <div class="page-content center">

        <div class="card my-2 "
        style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
        <div class="card-body p-0 bg-mask-hard">
        <p class="center p-4">1000円以上になったら引き出すことができます。</p>

<table class="table table-hover">
    <thead class="">
        <tr>
            <th class="text-info"><strong>期間</strong></th>
            <th class="text-info"><strong>コメンディ</strong></th>
            <th class="text-info"><strong>Good</strong></th>
            <th class="text-info"><strong>Bad</strong></th>
            <th class="text-info"><strong>収益</strong></th>
        </tr>
    </thead>
    <tbody>
        @forelse($rss_messages_user_month as $commendiy)
        <tr>
            <th scope="row" class="text-info">{!!$commendiy->date!!}</th>
            <td class="">{!!$commendiy->message_number!!}</td>
            <td class="">{!!$commendiy->good!!}</td>
            <td class="">{!!$commendiy->bad!!}</td>
            <td class="">{!!$commendiy->sale!!}</td>
        </tr>
        @empty
        <tr>
            <th colspan="5" class="center" >まだ、コメンディはありません。</th>
        </tr>
        @endforelse
    </tbody>
</table>
            </div>
            </div>
        </div>
        <!-- / CONTENT -->
    
        <div class="page-content-footer">

        </div>

        @include('account/include/footer')
        @include('include/footer')

    </div>

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')


@stop

@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $owner->name !!} 様</strong>
<br />
<strong>Coordiy予約の松本でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:16px;line-height:1.5em;">
先日、佐藤からお電話させていただいてからお時間がかかってしまい申し訳ございません。<br />
先ほど、Coordiy予約で紹介がスタートしましたのでご連絡となります。<br />
掲載の詳細については、<a href="https://www.coordiy.com/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc">こちら</a>からご確認いただけます。<br />
<br />
これからも{!!$address[0]!!}{!!$address[1]!!}の発展に全力で取り組んでまいります。<br />
是非、これからもよろしくお願い申し上げます。
</p>


<br />
<br />
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>予約管理について</strong>
</p>
<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:16px;line-height:1.5em;">
Coordiy予約では、予約受付・予約管理・求人などの機能が無料でご利用いただけますので、もしご興味がございましたらご自由にご利用ください。<br />
詳細は<a href="https://www.coordiy.com/yoyaku/introduce/owner/{!!$service!!}">こちら</a>のページで紹介しております。<br />
※注意ですが予約受付にてネット決済を利用する場合は決済手数料がかかりますので、十分検討のうえご利用いただければと思います。ご予約のみであればすべて無料でご利用いただけます。<br />
※求人を行う場合は「オーナー > コンテンツ > 作成」から「求人面接」の作成が必要となります。
</p>


<br />
<br />
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>今回の掲載内容について</strong>
</p>
<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:16px;line-height:1.5em;">
今回の掲載内容について、オーナー様でもとても間単に変更や追加が可能です。<br />
１、こちらから以下の情報を入力しログインします。<br />
　　>>Email アドレス: {!!$owner->email!!}<br />
　　>>パスワード : {!!$owner->csv_password!!}<br />
２、ログイン後画面右上にあるアカウントメニューの「オーナー」を開きます。<br />
３、画面上にあるグランドメニューから追加、変更したい項目を選択して内容を反映します。<br />
※お店やサービスの追加、変更は「コンテンツ」メニューからお進みください。
</p>


<br />
<br />
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>お問合せ</strong>
</p>
<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:16px;line-height:1.5em;">
今回の掲載に関することはもちろん、簡単なご質問やお問合せなどいつでも受け付けております。<br />
所在地：　〒135-0016 東京都江東区東陽3-23-26 東陽町コーポラス3F<br />
電話：　03-3527-9249<br />
Email:　info@coordiy.co.jp<br />
近所でございますのでお気軽にお声がけいただければ大変うれしくおもいます。<br />
<br />
<br />
それでは何卒よろしくお願いお願い申し上げます。
</p>
@stop




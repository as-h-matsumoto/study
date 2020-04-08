<script type="text/javascript">
$(document).ready(function () {
@if($message = Session::get('success'))
  successNotify('{{$message}}');
@elseif($message = Session::get('warning'))
  warningNotify('{{$message}}');
@elseif($message = Session::get('info'))
  infoNotify('{{$message}}');
@elseif($message = Session::get('longMessage'))
  $('#modalErrorMessageLabel').html('{!!mb_strimwidth($message, 0, 34, "..")!!}');
  $('#modalErrorMessageMessage').html('{!!$message!!}');
  $('#modalErrorMessage').modal('show');
@endif
@if( $errors->any() ) 
  warningNotify('以下の赤字を確認してください。');
@endif
});
</script>

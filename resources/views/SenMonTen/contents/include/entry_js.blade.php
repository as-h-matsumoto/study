<script>
function MainhandleFileSelect(evt) {
  // Reset progress indicator on new file selection.
  progress.style.width = '0%';
  progress.textContent = '0%';
  reader = new FileReader();
  reader.onerror = errorHandler;
  reader.onprogress = updateProgress;
  reader.onabort = function(e) {
    alert('File read cancelled');
  };
  reader.onloadstart = function(e) {
    document.getElementById('main_progress_bar').className = 'loading';
  };
  var file = evt.target.files[0];
  reader.onload = (function(theFile) {
      return function(e) {
          progress.style.width = '100%';
          progress.textContent = '100%';
          setTimeout("document.getElementById('main_progress_bar').className='';", 2000);
          // Render thumbnail.
          $('#mainpreview img').attr('src',e.target.result);
      };
  })(file);
  reader.readAsDataURL(file);
}
document.getElementById('mainPic').addEventListener('change', MainhandleFileSelect, false);
</script>
@include('include/user_recruit_country_js')
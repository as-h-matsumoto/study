

<div class="modal fade" id="stepModal" tabindex="-1" role="dialog" aria-labelledby="stepModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stepModalLabel">ＷＩＫＩと連携</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => '/owner/learning/register', 'id' => 'stepForm', 'name' => 'stepForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}
                    <input type="hidden" class="form-control" name="license_question_id" value="@if(isset($license_question)){{$license_question->id}}@endif" >
                    <input type="hidden" class="form-control" id="descPartId" name="descPartId" value="" >
                    <div class="form-group col-sm-12">
                        <label><span class="pr-2">ＷＩＫＩと連携</span>
                        <a href="javascript:void(0)" class="btn btn-outline-info float-right" id="findLearning" >検索</a></label>
                        <input class="form-control form-control-lg" type="search" name="learningSearch" id="learningSearch" placeholder="総需要、ＧＤＰなど" aria-label="総需要など" />
                    </div>
                </form>
                <div><p id="searchTotalNumber"></p></div>
                <div id="searchAnsArea" class="col-sm-12"></div>
            </div>

        </div>
    </div>
</div>
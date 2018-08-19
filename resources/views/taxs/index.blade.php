
<div class="col-sm-12 col-md-12 col-lg-12">
    <div class="pull-right" >
        <form action="{{route('taxs.create')}}" method="get" id="modal_fade1" >
            <input type="submit" class="btn btn-primary" value="Add Tax">
        </form>
    </div>
</div>
<div id="ajaxContent1">
    @include('taxs.datatable')
</div>


<div class="col-md-12">
    <div class="pull-right">
        @if($contact->random_unique_number != '')
        <a class="btn icon-btn btn-primary" href="{{route('users.edit', $contact->id)}}"><span class=" glyphicon btn-glyphicon glyphicon-edit img-circle "></span>Edit Profile</a>
        @else
        @endif
    </div>
</div>
<div class="col-md-12"style="margin-bottom: 5%;">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="profilepic">
            @if($contact->image_path != "")
                <img class="profilepicsize img-responsive img-circle" src="{{asset('/images/avatar/'.$contact->image_path)}}"/>
            @else
                <img src="{{asset('images/maxresdefault.jpg')}}" />
            @endif
        </div>
    </div>
    <div class="col-md-3">

    </div>
</div>

<div class="col-lg-12" >
    <div class="col-lg-6">
        <dl>
            <dt class="">
                <label for="name" class="">Name</label></dt>

            <dd class="">
                <p><span class="" aria-hidden="true"></span>
                    {{ $contact->name }}  </p>
            </dd>

            <dt class="">
                <label for="Mobile" class="">Mobile</label> </dt>
            <!--MAIL-->
            <dd class="valcreate1">
                <p><span class="" aria-hidden="true"></span>
                    <a  style="color:black!important" href="tel:{{ $contact->personal_number }}">{{ $contact->personal_number }}</a></p>
            </dd>

            <dt class="">
                <label for="Email" class="">Email</label></dt>
            <!--MAIL-->
            <dd class="">
                <p><span class="" aria-hidden="true"> </span>
                    <a style="color:black!important" href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
            </dd>
            <dt class="">
                <label for="Comapny" class="">Company Name</label></dt>
            <!--MAIL-->
            <dd class="">
                <p><span class="" aria-hidden="true"> </span>
                    <a style="color:black!important">{{ $contact->company_name }}</a></p>
            </dd>
        </dl>
    </div>

    <div class="col-lg-6">
        <dl>
            <!--Address-->
            <dt class="">
                <label for="Address" class="">Address</label></dt>
            <dd class="" style="width: 55%">
                <p><span class="" aria-hidden="true"></span>
                    {{ $contact->address }}  </p>
            </dd>

            <!--work-number-->
            <dt class="">
                <label for="Work_number" class="">Work_number</label></dt>
            <dd class="">
                <p><span class="" aria-hidden="true"></span>
                    <a  style="color:black!important" href="tel:{{ $contact->work_number }}">{{ $contact->work_number }}</a></p>
            </dd>


            <!--work-number-->
            <dt class="">
                <label for="Assign_role" class="">Assign Role</label></dt>
            @foreach($role as $r)
                @if($r->id == $contact->id)
            <dd class="">
                <p><span class="" aria-hidden="true"></span>{{$r->display_name}}</p>
            </dd>
                @endif
            @endforeach
        </dl>
    </div>
</div>
<div id="modal_window">

</div>
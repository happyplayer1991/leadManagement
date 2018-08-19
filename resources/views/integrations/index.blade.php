


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-content">
                    <?php

                    $company_id = \Auth::user()->company_id;
                    $user_unique_number = \Auth::user()->random_unique_number;

                    ?>
                        {{--<button id="cpint">Copy</button>--}}
                     <pre disabled class="col-md-12" id="integrationCode">&lt;script type="text/javascript" id="integrate" data-company-id="{{$company_id}}"  data-user-id="{{$user_unique_number}}" src='{{Request::root()}}/js/integrate.js'&gt;
&lt;/script&gt;</pre>

    </div>
            </div>
        </div>
    </div>

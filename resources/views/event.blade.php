@extends('inc.master')
@section('content')
<section class="content">
    <div class="container-fluid">

        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- Start Top col -->
                <div class="flash-message" id="success-alert">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                    <h3>
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close"
                                data-dismiss="alert" aria-label="close">&times;</a></p>
                    </h3>
                    @endif
                    @endforeach
                </div> <!-- end .flash-message -->
                <div class="card bg-info text-white">
                        <h2 name="event name">Event Name</h2>
                        <div class="card-header"><h2 name="event date">Date</h2></div>
                        <div class="card-body">PostedBy:<span name="postedby"></span></div>
                        <div class="card-body">CreatedBy:<span name="createdby"></span></div>
                        <div class="card-body">UpdatedBy:<span name="updatedby"></span></div>
                      </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
</section>


@endsection
@section('script')

<script>
    $(document).ready(function () {
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
            $("#success-alert").slideUp(500);
        });
s


    });

</script>
@endsection

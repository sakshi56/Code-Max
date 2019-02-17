@extends('inc.master')
@section('content')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
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
                <div class="card">
                    <div class="header">
                        <h2>
                          New Visitor
                      
                        </h2>
                       
                    </div>
                    <div class="body">
                            <form action="new_visitor/submit" method="POST">
                                {{ csrf_field() }}
                                <div class="row clearfix">
                                        <!-- Start Row Clearfix-->
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                            <!--Col1 Start-->
                                            <label for="name">Visitor Name</label>
                                            <div class="form-group">
                                                <!--Form-group Start-->
                                                <div class="form-line">
                                                    <!--Form-line Start-->
                                                    <input type="text" maxlength="30" name="visitor_name" id="visitor_name" class="form-control" placeholder="Visitor" required>
                                                </div>
                                                <!--Form-line End-->
                                            </div>
                                            <!--Form-group End-->
                                            
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                            <!--Col1 Start-->
                                            <label for="purpose">Purpose</label>
                                            <div class="form-group">
                                                <!--Form-group Start-->
                                                <div class="form-line">
                                                    <!--Form-line Start-->
                                                    <input type="text" maxlength="20" name="purpose" id="purpose" class="form-control" placeholder="Purpose of visit" required>
                                                </div>
                                                <!--Form-line End-->
                                            </div>
                                            <!--Form-group End-->
                                            
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                            <!--Col1 Start-->
                                            <label for="visit_cmpny">Visit Company</label>
                                            <div class="form-group">
                                                <!--Form-group Start-->
                                                <div class="form-line">
                                                    <!--Form-line Start-->
                                                    <input type="text" maxlength="20" name="visit_cmpny" id="visit_cmpny" class="form-control" placeholder="Visit to company" required>
                                                </div>
                                                <!--Form-line End-->
                                            </div>
                                            <!--Form-group End-->
                                            
                                        </div>
                                       
                                </div>
                                <div class="row clearfix">
                                        <!-- Start Row Clearfix-->
                                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                            <!--Col1 Start-->
                                            <label for="name">Visitor Contact</label>
                                            <div class="form-group">
                                                <!--Form-group Start-->
                                                <div class="form-line">
                                                    <!--Form-line Start-->
                                                    <input type="text" maxlength="11" name="contact" id="contact" class="form-control" placeholder="Visitor Contact" required>
                                                </div>
                                                <!--Form-line End-->
                                            </div>
                                            <!--Form-group End-->
                                            
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
                                            <!--Col1 Start-->
                                            <label for="visitor_address">Visitor Address</label>
                                            <div class="form-group">
                                                <!--Form-group Start-->
                                                <div class="form-line">
                                                    <!--Form-line Start-->
                                                    <input type="text" maxlength="100" name="visitor_address" id="visitor_address" class="form-control" placeholder="Purpose of visit" required>
                                                </div>
                                                <!--Form-line End-->
                                            </div>
                                            <!--Form-group End-->
                                            
                                        </div>
                                        
                                       
                                </div>
                    
                                

                            <br>
                            <br>
                           
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
       
    </div>
</section>


@endsection
@section('script')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>

        $(document).ready(function () {
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
            $("#success-alert").slideUp(500);
        });
            $('#table_id').DataTable();
        });

</script>
@endsection
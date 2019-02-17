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
                          Create Task
                      
                        </h2>
                       
                    </div>
                    <div class="body">
                            <form action="new_task/submit" method="POST">
                                {{ csrf_field() }}
                                <div class="row clearfix">
                                        <!-- Start Row Clearfix-->
                                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                            <!--Col1 Start-->
                                            <label for="title">Title</label>
                                            <div class="form-group">
                                                <!--Form-group Start-->
                                                <div class="form-line">
                                                    <!--Form-line Start-->
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="Task Title" required>
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
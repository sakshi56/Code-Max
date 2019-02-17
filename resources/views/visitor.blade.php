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
                          Visitors
                         <a href="new_visitor"> <button class="btn btn-primary waves-effect" style="float:right">Add New Visitor</button></a>
                        </h2>
                       
                    </div>
                    <div class="body">
                            <form action="open_task/submit" method="POST">
                                {{ csrf_field() }}
                                <table id="table_id" class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Purpose</th>
                                        <th>Visiting Company</th>
                                        <th>Data of Visit</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                            <th>#</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Purpose</th>
                                        <th>Visiting Company</th>
                                        <th>Data of Visit</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($data as $item)
                                    <tr>
                                    <td> {{$i++}}</td>
                                        <td>{{$item->visitor_name}}</td>
                                        <td>{{$item->visitor_contact}}</td>
                                        <td>{{$item->visitor_address}}</td>
                                        <td>{{$item->purpose}}</td>
                                        <td>{{$item->visit_cmpny}}</td>
                                        <td>{{$item->created_at}}</td>

                                           
                                    </tr>
                                    @endforeach
                                   
                                    
                                </tbody>
                            </table>
                           
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
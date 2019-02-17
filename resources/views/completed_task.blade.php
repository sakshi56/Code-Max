@extends('inc.master')
@section('content')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<section class="content">
    <div class="container-fluid">
        
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
                         Completed Task
                          <button class="btn btn-primary waves-effect" style="float:right">Add New Task </button>
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
                                                    <th>Description</th>
                                                    <th>Progress Status</th>
                                                    <th>Start date</th>
                                                    <th>Last Update</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Progress Status</th>
                                                        <th>Start date</th>
                                                        <th>Last Update</th>
                                                </tr>
                                            </tfoot>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($data as $item)
                                    <tr>
                                    <td><input name='tk_id[]' value='{{$item->id}}' hidden> {{$i++}}</td>
                                        <td>{{$item->task_name}}</td>
                                        <td>{{$item->descp}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->updated_at}}</td>
                                       
                                           
                                    </tr>
                                    @endforeach
                                   
                                    
                                </tbody>
                            </table>
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
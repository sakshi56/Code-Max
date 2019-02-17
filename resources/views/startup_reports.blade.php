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

                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active"><a href="#home" data-toggle="tab">Startup</a></li>
                            <li role="presentation"><a href="#profile" data-toggle="tab">Pending Requests</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                <div class="row clearfix">
                                    @foreach ($data1 as $item1)
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2 name="title">{{$item1->name}}</h2>

                                            </div>
                                            <div class="body">
                                                <div class="row">
                                                    <div class='form-inline'>
                                                        <div class="col-md-3">
                                                            <label>Contact</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            : {{$item1->ph_no}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        : {{$item1->email}}
                                                    </div>
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="body" style="text-align:center"><button type="submit" class="btn btn-primary waves-effect">View
                                                    Detail Report</button></div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                <form action="accpet_app" method="POST">
                                    {{ csrf_field() }}
                                    <table id="table_id" class="table table-bordered table-striped ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Email</th>
                                                <th>Requested Date</th>
                                                <th>Document</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Email</th>
                                                <th>Requested Date</th>
                                                <th>Document</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach ($data2 as $item)
                                            <tr>
                                                <td><input name='strt_id[]' value='{{$item->id}}' hidden> {{$i++}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->ph_no}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td style="text-align:center"><a herf="{{$item->documents}}"><button
                                                           type="button" style="font-size: medium;
                                                    font-weight: bold;"
                                                            class="btn btn-primary">View</button></a></td>
                                                <td style="text-align:center">
                                                    <select class="btn btn-primary" style="font-size: medium;
                                                       font-weight: bold;"
                                                        name="status[]">
                                                        <option value="ACCEPTED">ACCEPT</option>
                                                    </select>
                                                </td>

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

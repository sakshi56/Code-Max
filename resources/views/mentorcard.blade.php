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
                <div class="card">
                    <div class="header">
                        <div class='row'>
                            <div class="col-sm-6">
                                <h2>
                                    Mentors
                                </h2>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-inline" style="    text-align: right;">
                                    <label>Select Category</label>

                                    &nbsp;
                                    <select class="form-control show-tick" name="set_cat" id="set_cat">
                                        <option>Select Categroy</option>
                                        @foreach ($data as $item)
                                        <option value="{{$item->id}}">{{$item->mem_cat_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="body">
                        <form action="req_mentor" method="post">
                            {{ csrf_field() }}
                            <div id='crd1' class="row clearfix">


                            </div>
                        </form>
                    </div>
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

        $('#set_cat').on('change', function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="mycsrf-token"]').attr('content')
                }
            });
            var id = $(this).children("option:selected").val();
            console.log(id);
            $.ajax({
                type: "post",
                url: "get_mem_by_cat",
                data: {
                    id: id
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    console.log(data);
                    var res = '';
                    for (var i = 0; i < data.length; i++) {
                        var j = i + 1;
                        str3 = '<input type="text" name=mem_id[] hidden value="' + data[i].id +
                            '" ><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="card"><div class="header"><h2>' +
                            data[i].name + '<small>' + data[i].designation +
                            '</small></h2></div><div class="body"><div class="row"><div class="col-md-6"><label>Company</label><br>' +
                            data[i].company +
                            '</div><div class="col-md-6" style="text-align:right"><label>Contact</label><br>' +
                            data[i].ph_no + '<br>' + data[i].email +
                            '</div></div><div class="row"><div class="col-md-12"><label>Description</label><br><textarea readonly style="resize:none; min-height: 100px; width:100%">' +
                            data[i].descp +
                            '</textarea></div></div><div class="row"><div class="col-md-8"><button name=btn1[] class="btn btn-primary form-control">Request to connect</button></div></div></div> </div></div>';

                        str2 = '<tr><td>' + j + '</td> <td>' + data[i].visitor_name +
                            '</td><td>' + data[i].date + '</td><td>' + data[i].time +
                            '</td><td>' + data[i].work_description + '</td><td>' +
                            data[i].comments +
                            '</td><td style=\'text-align: center;\' ><button  class="btn btn-primary"><a style=\'color: #fff;\' href=\'' +
                            data[i].jobsheet +
                            '\' target="_blank">View</a></button></td></tr>';
                        res = res.concat(str3);
                    }

                    $('#crd1').html(res);


                },
                error: function (response) {
                    // var data=JSON.parse(response);
                    // alert(response);
                    console.log(response);
                }
            });
        });



    });

</script>
@endsection

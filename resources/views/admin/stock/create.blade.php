@extends('admin.layouts.master')
@section("content")
    <div class="main-content">
        <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="{{url('/dashboard')}}">Dashboard</a>
                    </li>

                    <li>
                        <a href="{{url('/users')}}">Users</a>
                    </li>
                    <li class="active"> Create </li>
                </ul><!-- /.breadcrumb -->

        </div>

            <div class="page-content">
                
                <form  action="{{route('stock-store')}}" method="POST" class="form-horizontal" role="form" onsubmit="return validate()">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Item Name</th>
                        <th scope="col">Batch Number</th>
                        <th scope="col">MRP</th>
                        <th scope="col">Stock In</th>
                        <th scope="col">Total Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $itemMaster as $val )
                        <tr>
                            <td>{{$val->name}} <input type="hidden" name="id[]" value="{{$val->id}}" /> </td>
                            <td><input type="text" name="batch_num[]" placeholder="Batch No." /></td>
                            <td> 
                                <select name="mrp[]"> 
                                    @if($val->item_price->count() > 1)
                                    <option value="0">Please Select</option>
                                    @endif
                                    @foreach( $val->item_price as $price )
                                    <option value="{{$price->id}}">{{$price->mrp}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="Number" name="stock[]" placeholder="Stock No." /></td>
                            <td>
                                {{$val->totalStock}}   
                                @if($val->totalStock)                            
                                <button class="btn-primary" onclick="return openStockDetailModal({{$val->id}})" >Stock Detail</button> 
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5"> <button type="submit" style="float:right" class="btn btn-primary" >Update</button></td>
                        </tr>
                       
                    </tbody>
                </table>

                </form>

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    <!-- modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Stock Detail <span id="item_name"> </span> </h4>
            </div>
            <div class="modal-body">
                <table class="table table-border">
                    <thead>
                        <tr>
                            <th>Batch Number</th>
                            <th>MRP</th>
                            <th>STOCK IN QTY</th>
                            <th>WASTAGE QTY</th>
                            <th>OUTWARD QTY</th>
                        </tr>
                    </thead>
                    <tbody id="stock-detail-row">
                       
                    </tbody>
                    
                </table>
            </div>
            </div>

        </div>
    </div>
    <!-- end modal -->
@endsection
@section("post_script")
<script type="text/javascript">
        $(document).ready(function () {
            if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
            }
        });

        function validate()
        { 
            return true;
        }

        function openStockDetailModal(item_id)
        {
            $.ajax({
                url: '{{route("mrp-wise-detail")}}',
                type: 'post',
                data: {item_id:item_id,_token: "{{ csrf_token() }}",},
                success: function(response){
                    if( response.status === 200 )
                    {
                        $('#item_name').text('('+response.result[0].item_name+')');
                        var tableRow = '';
                        response.result.forEach(function(item) {
                            tableRow += `<tr> 
                                <td>${item.batch_number}</td>
                                <td>${item.mrp}</td>
                                <td>${item.stock_in_quantity}</td>
                                <td>${item.wastage_quantity}</td>
                                <td>${item.outward_quantity}</td>
                            </tr>`;
                        });
                        $('#stock-detail-row').html(tableRow);

                        // 
                    }
                }   
            });
            $('#myModal').modal('show'); return false;
        }
    </script>
@endsection
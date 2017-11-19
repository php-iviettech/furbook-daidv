@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Chi tiết tài khoản
                </div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-3 col-sm-4 control-label">Nhập giá tiền:</label>
                            <div class="col-md-3 col-sm-5">
                                <input type="text" id="price" class="form-control money" name="price"
                                       value="123456"
                                       placeholder="Nhập số tiền" maxlength="12">
                            </div>
                            <div class="col-md-2 col-sm-1 text-left">
                                <label class="control-label"> VND</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
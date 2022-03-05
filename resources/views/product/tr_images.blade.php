@php if(isset($saved) && isset($saved[$index]))
        $row = $saved[$index];
    else $row=['id'=>'','alt'=> '' ,'image'=>''];
@endphp
<tr id="image{{ $index }}" >
    <td >
        <input type="number" name="id[]" class="form-control hidden" value="{{ old('id.' . $index,$row['id']) }}" />
        <a href="" class="btn-remove tim-icons icon-simple-remove" id="{{$index}}"></a>
    </td>
    <td >
        <input type="text" name="alt[]" class="form-control" value="{{ old('alt.' . $index,$row['alt'] ) }}" />
        @include('alerts.feedback', ['field' => 'alt'.$index])
    </td>
    <td>
        <input type="hidden" id="imageInput" name="image[]" value="{{ old('image.' . $index,$row['image']) }}" />
        <div class="col-xs-10">
            <div id="progressOuter" class="progress progress-striped active" style="display:none;">
                <div id="progressBar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                </div>
            </div>
        </div>
        <div class="col-xs-10">
            <div id="picbox" class="clear" style="padding-top:0px;padding-bottom:10px;">
                <img  alt="product" style= "max-width:10%;max-height: 50%;" src="{{(!empty(old('image.' . $index,$row['image'])) ? asset('product_images/'.old('image.' . $index,$row['image'])) : '')}}">
                @include('alerts.feedback', ['field' => 'image.'.$index])
            </div>
            <div id="msgBox"></div>
            <button type="button" id="uploadBtn" class="btn btn-large btn-primary" style="{{!empty(old('image.' . $index,$row['image'])) ? 'display: none;'  : '' }}" >Choose File</button>
            <button type="button" id="removeBtn" class="btn btn-large btn-primary " style="{{empty(old('image.' . $index,$row['image'])) ? 'display: none;'  : '' }}" >Remove</button>
        </div>
    </td>
</tr>

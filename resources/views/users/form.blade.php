<div class="form-group">
    <label for="name">Name</label>
  
    {!! Form::text('name',null,['class'=>"form-control ", 'placeholder'=>'','autofocus'=>'autofocus','value'=>"{{ old('name')}}"]) !!}
</div>
<div class="form-group">
    <label for="description">Description</label>
     {!! Form::text('email',null,['class'=>"form-control ", 'placeholder'=>'','autofocus'=>'autofocus','value'=>"{{ old('email')}}"]) !!}
</div>
<button type="submit" class="btn btn-primary">Submit</button>

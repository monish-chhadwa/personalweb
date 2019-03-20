{{--
Automatically created by "Form"
<input type="hidden" name="_token" value="{{ csrf_token() }}">
--}}

<div class="form-group">
    {!! Form::label('cName','Name:') !!}
    {!! Form::text('cName',null,['class'=>'form-control']) !!}
    {{--<label for="cName">Name:</label>--}}
    {{--<input type="text" class="form-control" id="cName" name="cName" placeholder="">--}}
</div>
<div class="form-group">
    {!! Form::label('company','Company:') !!}
    {!! Form::text('company',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('contact','Mobile:') !!}
    {!! Form::text('contact',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('email','Email:') !!}
    {!! Form::email('email',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password','Password:') !!}
    {!! Form::input('password','password',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password_confirmation','Confirm Password:') !!}
    {!! Form::input('password','password_confirmation',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="type">Type:</label>
    <select class="form-control" id="type" name="type">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
    </select>
</div>
<div class="form-group">
    {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
</div>

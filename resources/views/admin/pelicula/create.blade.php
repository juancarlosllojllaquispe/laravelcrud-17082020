@extends('layouts.main')

@section('title','NUEVA PELICULA')

@section('content')
	@include('layouts.error')
	{!! Form::open(['route'=>'pelicula.store', 'files'=>true]) !!}
		<div class="form-group">
			{!! Form::label('titulo', 'Titulo de la Pelicula:') !!}
			{!! Form::text('titulo', null, ['class' => 'form-control',
										  'placeholder' => 'Titulo de la pelicula',
										  'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('genero_id', 'Genero:') !!}
			{!! Form::select('genero_id',$generos, null, ['class' => 'form-control',
										  'placeholder' => 'Seleccione una opcion',
										  'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('costo', 'Costo de la Pelicula:') !!}
			{!! Form::number('costo', null, ['class' => 'form-control',
										  'placeholder' => 'Costo de la pelicula',
										  'required']) !!}
		</div>


		<div class="form-group">
			{!! Form::label('estreno', 'Fecha de Estreno:') !!}
			{!! Form::date('estreno',\Carbon\Carbon::now(), ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('resumen', 'Resumen:') !!}
			{!! Form::textarea('resumen', null, ['class' => 'form-control',
										  'placeholder' => 'Resumen de la pelicula',
										  'required']) !!}
		</div>


		<div class="form-group">
			{!! Form::label('directores', 'Directore:') !!}
			{!! Form::select('directores[]',$directores, null, ['class' => 'form-control', 
										  'required','multiple']) !!}
		</div>


		<div class="form-group">
			{!! Form::label('imagen', 'Imagen:') !!}
			{!! Form::file('imagen' ) !!}
		</div>



		
		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('pedido_#') }}
            {{ Form::select('pedido_id', $pedidos, $detallespedido->pedido_id, ['class' => 'form-control' . ($errors->has('pedido_id') ? ' is-invalid' : ''), 'placeholder' => 'Pedido #']) }}
            {!! $errors->first('pedido_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('producto') }}
            {{ Form::select('producto_id', $productos, $detallespedido->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''), 'placeholder' => 'Producto']) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $detallespedido->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('subtotal') }}
            {{ Form::text('subtotal', $detallespedido->subtotal, ['class' => 'form-control' . ($errors->has('subtotal') ? ' is-invalid' : ''), 'placeholder' => 'Subtotal']) }}
            {!! $errors->first('subtotal', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>
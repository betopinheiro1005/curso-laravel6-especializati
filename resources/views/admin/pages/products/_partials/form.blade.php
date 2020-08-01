@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <input class="form-control" type="text" name="name" placeholder="Nome:" value={{ $product->name ?? old('name') }}>
</div>
<div class="form-group">
    <input class="form-control" type="text" name="price" placeholder="Preço:" value={{ $product->price ?? old('price') }}>
</div>
<div class="form-group">
    <textarea class="form-control" type="text" name="description" rows="5" placeholder="Descrição:" >{{ $product->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <input class="form-control" type="file" name="image">    
</div>
<div class="form-group">
    <button class="btn btn-success" type="submit">Enviar</button>
</div>

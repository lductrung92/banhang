<base href="{{ asset('/') }}"/>

@foreach($images as $image)
    <a href="uploads/products/{{ $image->name }}" data-fancybox="group-{{ $image->proid }}" data-caption="{{ $image->name }}">
        <img src="uploads/products/{{ $image->name }}" alt="" />
    </a>
@endforeach
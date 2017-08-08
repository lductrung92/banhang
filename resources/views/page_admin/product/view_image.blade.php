<a href="javascript:;" onclick='viewImages({{ $id }})'> Xem ảnh</a>
@foreach($images as $image)
    <a style="display:none" href="uploads/products/{{ $image->name }}" data-fancybox="group-{{ $image->proid }}" data-caption="{{ $image->name }}">
        <img src="uploads/products/{{ $image->name }}" alt="" />
    </a>
@endforeach


@extends('page_home.base.base')

@section('title', 'Ecommerce - Home Page')

@section('content')
<div class="chir_main">
    <section id="chir_seller">
        <div class="container">
            <div class="main">
                <div class="title_chir">
                    <h2>
                        Danh mục nổi bật
                    </h2>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 product">
                        <div class="home_product_list bg_w">
                            <ul class="owl_design owl_product_list">
                                @foreach($highlights as $product)
                                <li class="item_product">
                                    <div class="chir_loop loop_item insScroll">
                                        <div class="chir-img">
                                            <div class="sale">
                                                Giảm 27%
                                            </div>
                                            <a href="/ban-phim-choi-game-led-gia-co-r8-1818" title="">
                                                <picture>
                                                    <img srcset="uploads/products/{{ $product->img }}" alt="">
                                                </picture>
                                            </a>
                                            <div class="chi-action">
                                                <a href="javascript:void(0)" class="quick_views btn-quickview-1" data-alias="/ban-phim-choi-game-led-gia-co-r8-1818" ><img src="css/images/shirt.png" alt="Xem nhanh" title="Xem nhanh" /></a>
                                                <a href="/ban-phim-choi-game-led-gia-co-r8-1818"  class="view_product"><img src="css/images/eye_w.png" alt="Xem chi tiết" title="Xem chi tiết" /></a>
                                                <a href="javascript:void(0)" class="add-cart design_cart Addcart" data-variantid="11091464"><img src="css/images/cart_w.png" alt="Thêm vào giỏ" title="Thêm vào giỏ" /></a>
                                            </div>
                                        </div>
                                        <div class="product-detail clearfix">
                                            <h3 class="pro-name"><a href="{{ $product->slug }}.html" title="{{ $product->title }}">{{ $product->name }}</a></h3>
                                            <p class="pro-price">
                                                {{ number_format($product->price) }} ₫
                                                <del class="compare-price">300.000₫</del>
                                            </p>
                                            <div class="product_view_list">
                                                <ul>
                                                    <li>Mã sản phẩm: <span>chưa rõ</span></li>
                                                    <li>Thương hiệu: <span>Xiaomi</span></li>
                                                    <li>Mô tả ngắn:
                                                    <span class="short-des">
                                                    Giới thiệu sản phẩm Bàn phím chơi game led giả cơ R8 1818 
                                                    Đặc Điểm Nổi Bật: 
                                                    Bàn phím cao cấp của R8 mang tên KB-1818 với thiết kế cho cảm giác tương tự như bàn phím cơ . Với phiên bản này thì R8 mô phỏng lực nhấn và âm thanh giống như Blue Swtich của hãng Cherry . 
                                                    R8-1818 tích hợp 3 màu đèn led cực đẹp . Phím chuyển đổi nhanh 3 màu : Xanh Dương , Đỏ , Tím . Đèn led có thể tùy chỉnh sáng tối ở các mức : 30% , 70% , 100% và không sử dụng led . 
                                                    ...
                                                    </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @foreach($home_blocks as $item)
    <section id="home_block_3" class="home_block">
        <div class="container">
            <div class="main">
                <div class="title_chir">
                    <h2>
                    {{ $item[0] }}
                    </h2>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12 banner_brand hidden-sm hidden-xs">
                        <div class="brands text-center bg_w">
                            <ul class="list clearfix">
                                @foreach($item[1] as $value)
                                <li>
                                    <div class="effect_item insScroll">
                                    <a href="/">
                                        <img class="insImageload" alt="" src="icon/{{ empty($value->icon) ? '' : explode('/', $value->icon)[2] }}" />
                                        <p>
                                            {{ $value->name }}
                                        </p>
                                    </a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="imgage_hover hidden-sm insScroll">
                            <a href="/"><img class="insImageload" src="//bizweb.dktcdn.net/100/172/651/themes/226402/assets/banner_block_home_3.jpg?1502292270754" /></a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12 product_in_block">
                        <div class="block_product_list bg_w">
                            <div class="product_tabs">
                                <div class="visible-xs open_tabs">
                                    <a href="javascript:void(0);"><img src="//bizweb.dktcdn.net/100/172/651/themes/226402/assets/bars_right.png?1502292270754" alt="Open tabs"></a>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs text-right" role="tablist">
                                    <li role="presentation" class="active" data-url = "/me-va-be-moi"><a href="#chir-3-tab-1" aria-controls="chir-tab-1" role="tab" data-toggle="tab">Sản phẩm mới</a></li>
                                    <li role="presentation"  data-url = "/me-va-be-ban-chay"><a href="#chir-3-tab-2" aria-controls="chir-tab-2" role="tab" data-toggle="tab">Bán chạy</a></li>
                                    <li role="presentation"  data-url = "/me-va-be-noi-bat"><a href="#chir-3-tab-3" aria-controls="chir-tab-3" role="tab" data-toggle="tab">Nổi bật</a></li>
                                    <li role="presentation"  data-url = "/me-va-be-khuyen-mai"><a href="#chir-3-tab-4" aria-controls="chir-tab-4" role="tab" data-toggle="tab">Khuyến mãi</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade  in active" id="chir-3-tab-1">
                                    <div class="product_tabs_slide owl_design clearfix product_tabs_slide_first" >
                                        @foreach($item[2] as $key => $value)

                                            @if($key === 0 && count($item[2]) > 0)
                                            <ul class="item">
                                            @endif

                                            <li class="item_product tab_item">
                                                <div class="chir_loop loop_item insScroll">
                                                <div class="chir-img">
                                                    <a href="/ban-phim-choi-game-led-gia-co-r8-1818" title="">
                                                        <picture>
                                                            <img srcset="uploads/products/{{ $value->img }}" alt="">
                                                        </picture>
                                                    </a>
                                                   <div class="chi-action">
                                                        <a href="javascript:void(0)" class="quick_views btn-quickview-1" data-alias="/ban-phim-choi-game-led-gia-co-r8-1818" ><img src="css/images/shirt.png" alt="Xem nhanh" title="Xem nhanh" /></a>
                                                        <a href="/ban-phim-choi-game-led-gia-co-r8-1818"  class="view_product"><img src="css/images/eye_w.png" alt="Xem chi tiết" title="Xem chi tiết" /></a>
                                                        <a href="javascript:void(0)" class="add-cart design_cart Addcart" data-variantid="11091464"><img src="css/images/cart_w.png" alt="Thêm vào giỏ" title="Thêm vào giỏ" /></a>
                                                    </div>
                                                </div>
                                                <div class="product-detail clearfix">
                                                    <h3 class="pro-name"><a href="{{ $value->slug }}.html" title="{{ $value->title }}">{{ $value->name }}</a></h3>
                                                    <p class="pro-price">
                                                        {{ number_format($value->price) }} ₫
                                                        <del class="compare-price">300.000₫</del>
                                                    </p>
                                                    <div class="product_view_list">
                                                        <ul>
                                                            <li><strong>Mã sản phẩm: </strong><span></span></li>
                                                            <li><strong>Thương hiệu: </strong><span>Laluna (Việt Nam)</span></li>
                                                            <li><strong>Mô tả ngắn: </strong>
                                                            <span class="short-des">
                                                            THÔNG TIN SẢN PHẨM  
                                                            Tên sản phẩm:   Đầm vải bé gái Laluna G066009 
                                                            Thương hiệu:   Laluna (Việt Nam) 
                                                            Sản xuất tại:   Việt Nam 
                                                            Chất liệu:   100% cotton 
                                                            Màu sắc:   Hồng 
                                                            BẢO QUẢN SẢN PHẨM  
                                                            Không giặt với nước nóng. 
                                                            Không dùng thuốc tẩy, hóa chất. 
                                                            Ủi ở nhiệt độ thấp 70˚C - 90˚C. 
                                                            Không giặt chung với quần áo sẫm màu. 
                                                            ĐẶC ĐIỂM NỔI BẬT  
                                                            Chất liệu cotton mềm mại  
                                                            Sản phẩm được may từ vải cotton mềm mại cho phép bé thoải mái chơi đùa, vận động mà không cảm thấy khó chịu. Bên cạnh đó, chất liệu cotton không gây kích ứng da và có khả...
                                                            </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                </div>
                                            </li>

                                            @if(($key % 2) !== 0 && empty($item[2][$key+1]))
                                            </ul>
                                            @endif

                                            @if(($key % 2) !== 0 && !empty($item[2][$key+1]))
                                            </ul>
                                            <ul class="item">
                                            @endif
                                           
                                        @endforeach
                                    </div>
                                    <div class="tabViewMore"><a href="/me-va-be-moi">Xem thêm</a></div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade " id="chir-3-tab-2">
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade " id="chir-3-tab-3">
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade " id="chir-3-tab-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach

    <section id="home_block_blog" class="home_block">
        <div class="container">
            <div class="main">
                <div class="title_chir">
                    <h2>
                    Tin tức nổi bật
                    </h2>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-xs-12 product_in_block">
                    <div class="block_deal_list">
                        <ul class="blogs_home_slide owl_design" >
                            <li class="article_item">
                                <div class="single_blog_post_box">
                                <div class="blog_post_photo imgage_hover insScroll">
                                    <a href="/cach-phoi-hoa-tiet-ke-mua-he-an-tuong-nhu-sao-ngoai" title="Cách phối họa tiết kẻ mùa hè ấn tượng như sao ngoại">
                                    <img class="insImageload" src="//bizweb.dktcdn.net/thumb/large/100/172/651/articles/blog1-c22673e0c0334f00b45e6aa180dfe42f-large.jpg?v=1488597875477" alt="Cách phối họa tiết kẻ mùa hè ấn tượng như sao ngoại">
                                    </a>
                                </div>
                                <div class="blog_post_txt">
                                    <div class="blog_post_heading">
                                        <h3><a href="/cach-phoi-hoa-tiet-ke-mua-he-an-tuong-nhu-sao-ngoai" title="Cách phối họa tiết kẻ mùa hè ấn tượng như sao ngoại">Cách phối họa tiết kẻ mùa hè ấn tượng như sao ngoại</a></h3>
                                        <p>Đăng bởi: Nguyễn Thanh Tùng</p>
                                    </div>
                                    <div class="blog_post_content">
                                        <p> Những thiết kế họa tiết kẻ năng động, trẻ trung luôn được lòng các mỹ nhân Hollywood khi phối...</p>
                                        <ul>
                                            <li><i class="fa fa-comments-o" aria-hidden="true"></i> 2 Bình luận</li>
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i> 04/03/2017</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="article_item">
                                <div class="single_blog_post_box">
                                <div class="blog_post_photo imgage_hover insScroll">
                                    <a href="/thoi-trang-tuong-dong-cua-gigi-hadid-va-kendall-jenner" title="Thời trang tương đồng của Gigi Hadid và Kendall Jenner">
                                    <img class="insImageload" src="//bizweb.dktcdn.net/thumb/large/100/172/651/articles/blog2-3f69220f25d34aa68b894d2c5a942801-large.jpg?v=1488597860737" alt="Thời trang tương đồng của Gigi Hadid và Kendall Jenner">
                                    </a>
                                </div>
                                <div class="blog_post_txt">
                                    <div class="blog_post_heading">
                                        <h3><a href="/thoi-trang-tuong-dong-cua-gigi-hadid-va-kendall-jenner" title="Thời trang tương đồng của Gigi Hadid và Kendall Jenner">Thời trang tương đồng của Gigi Hadid và Kendall Jenner</a></h3>
                                        <p>Đăng bởi: Nguyễn Thanh Tùng</p>
                                    </div>
                                    <div class="blog_post_content">
                                        <p> Gigi Hadid và Kendall Jenner là đôi bạn thân người mẫu nổi tiếng nhất thế giới. Phong cách thời...</p>
                                        <ul>
                                            <li><i class="fa fa-comments-o" aria-hidden="true"></i> 3 Bình luận</li>
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i> 04/03/2017</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="article_item">
                                <div class="single_blog_post_box">
                                <div class="blog_post_photo imgage_hover insScroll">
                                    <a href="/8-cong-thuc-phoi-do-mua-he-cua-karlie-kloss" title="8 công thức phối đồ mùa hè của Karlie Kloss">
                                    <img class="insImageload" src="//bizweb.dktcdn.net/thumb/large/100/172/651/articles/blog3-b0b2d402ec1a4997bb2f1f1014aa1616-large.jpg?v=1488597846787" alt="8 công thức phối đồ mùa hè của Karlie Kloss">
                                    </a>
                                </div>
                                <div class="blog_post_txt">
                                    <div class="blog_post_heading">
                                        <h3><a href="/8-cong-thuc-phoi-do-mua-he-cua-karlie-kloss" title="8 công thức phối đồ mùa hè của Karlie Kloss">8 công thức phối đồ mùa hè của Karlie Kloss</a></h3>
                                        <p>Đăng bởi: Nguyễn Thanh Tùng</p>
                                    </div>
                                    <div class="blog_post_content">
                                        <p> Một số bí quyết nhỏ giúp chân dài nổi tiếng luôn trẻ trung, tươi tắn và cá tính ngày...</p>
                                        <ul>
                                            <li><i class="fa fa-comments-o" aria-hidden="true"></i> 0 Bình luận</li>
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i> 04/03/2017</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="article_item">
                                <div class="single_blog_post_box">
                                <div class="blog_post_photo imgage_hover insScroll">
                                    <a href="/chon-do-mua-he-che-khuyet-diem-canh-tay" title="Chọn đồ mùa hè che khuyết điểm cánh tay">
                                    <img class="insImageload" src="//bizweb.dktcdn.net/thumb/large/100/172/651/articles/blog4-large.jpg?v=1488597831250" alt="Chọn đồ mùa hè che khuyết điểm cánh tay">
                                    </a>
                                </div>
                                <div class="blog_post_txt">
                                    <div class="blog_post_heading">
                                        <h3><a href="/chon-do-mua-he-che-khuyet-diem-canh-tay" title="Chọn đồ mùa hè che khuyết điểm cánh tay">Chọn đồ mùa hè che khuyết điểm cánh tay</a></h3>
                                        <p>Đăng bởi: Nguyễn Thanh Tùng</p>
                                    </div>
                                    <div class="blog_post_content">
                                        <p> Dưới đây là bí quyết giúp bạn thoải mái diện những thiết kế không tay, 2 dây mát mẻ...</p>
                                        <ul>
                                            <li><i class="fa fa-comments-o" aria-hidden="true"></i> 0 Bình luận</li>
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i> 04/03/2017</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="article_item">
                                <div class="single_blog_post_box">
                                <div class="blog_post_photo imgage_hover insScroll">
                                    <a href="/dien-vay-xe-cao-quyen-ru-nhu-miranda-kerr" title="Diện váy xẻ cao quyến rũ như Miranda Kerr">
                                    <img class="insImageload" src="//bizweb.dktcdn.net/thumb/large/100/172/651/articles/blog1-large.jpg?v=1488597779900" alt="Diện váy xẻ cao quyến rũ như Miranda Kerr">
                                    </a>
                                </div>
                                <div class="blog_post_txt">
                                    <div class="blog_post_heading">
                                        <h3><a href="/dien-vay-xe-cao-quyen-ru-nhu-miranda-kerr" title="Diện váy xẻ cao quyến rũ như Miranda Kerr">Diện váy xẻ cao quyến rũ như Miranda Kerr</a></h3>
                                        <p>Đăng bởi: Nguyễn Thanh Tùng</p>
                                    </div>
                                    <div class="blog_post_content">
                                        <p> Với lợi thế đôi chân thon dài kết hợp cùng thân hình chuẩn của một siêu mẫu, Miranda Kerr...</p>
                                        <ul>
                                            <li><i class="fa fa-comments-o" aria-hidden="true"></i> 0 Bình luận</li>
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i> 04/03/2017</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="article_item">
                                <div class="single_blog_post_box">
                                <div class="blog_post_photo imgage_hover insScroll">
                                    <a href="/phoi-quan-jeans-cap-cao-theo-phong-cach-thap-nien-1970" title="Phối quần jeans cạp cao theo phong cách thập niên 1970">
                                    <img class="insImageload" src="//bizweb.dktcdn.net/thumb/large/100/172/651/articles/blog2-large.jpg?v=1488597758157" alt="Phối quần jeans cạp cao theo phong cách thập niên 1970">
                                    </a>
                                </div>
                                <div class="blog_post_txt">
                                    <div class="blog_post_heading">
                                        <h3><a href="/phoi-quan-jeans-cap-cao-theo-phong-cach-thap-nien-1970" title="Phối quần jeans cạp cao theo phong cách thập niên 1970">Phối quần jeans cạp cao theo phong cách thập niên 1970</a></h3>
                                        <p>Đăng bởi: Nguyễn Thanh Tùng</p>
                                    </div>
                                    <div class="blog_post_content">
                                        <p> Quần jeans cạp cao xuất hiện từ những năm 1970 đã quay trở lại, được nhiều tín đồ thời...</p>
                                        <ul>
                                            <li><i class="fa fa-comments-o" aria-hidden="true"></i> 3 Bình luận</li>
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i> 04/03/2017</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="article_item">
                                <div class="single_blog_post_box">
                                <div class="blog_post_photo imgage_hover insScroll">
                                    <a href="/bai-viet-mau" title="Những chiếc vòng cổ tạo đẳng cấp cho sao ngoại trên thảm đỏ">
                                    <img class="insImageload" src="//bizweb.dktcdn.net/thumb/large/100/172/651/articles/blog3-large.jpg?v=1488597404793" alt="Những chiếc vòng cổ tạo đẳng cấp cho sao ngoại trên thảm đỏ">
                                    </a>
                                </div>
                                <div class="blog_post_txt">
                                    <div class="blog_post_heading">
                                        <h3><a href="/bai-viet-mau" title="Những chiếc vòng cổ tạo đẳng cấp cho sao ngoại trên thảm đỏ">Những chiếc vòng cổ tạo đẳng cấp cho sao ngoại trên thảm đỏ</a></h3>
                                        <p>Đăng bởi: Nguyễn Thanh Tùng</p>
                                    </div>
                                    <div class="blog_post_content">
                                        <p> Những chiếc vòng cổ được thiết kế cầu kỳ, lấp lánh, tuy nhỏ nhưng lại là điểm nhấn cho...</p>
                                        <ul>
                                            <li><i class="fa fa-comments-o" aria-hidden="true"></i> 0 Bình luận</li>
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i> 29/05/2015</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
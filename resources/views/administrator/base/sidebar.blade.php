<div id="left">
    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
        <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif">
                <!-- <span class="label label-danger user-label">16</span> -->
            </a>
    
            <div class="media-body">
                <h5 class="media-heading">TrungLe</h5>
                <ul class="list-unstyled user-info">
                    <li><a href="">Quản trị viên</a></li>
                    <li>Truy cập lần cuối: <br>
                        <small><i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #menu -->
    <ul id="menu" class="bg-blue dker">
        <li class="nav-header">Menu</li>
        <li class="nav-divider"></li>
        <li class="">
            <a href="{{ route('pageIndexAdmin') }}">
                <i class="{{ trans('manage.dashboard.icon') }}"></i><span class="link-title">&nbsp;&nbsp;{{ trans('manage.dashboard.title') }}</span>
            </a>
        </li>

        <li>
            <a href="{{ route('pageCateIndex') }}">
                <i class="{{ trans('manage.category.icon') }}"></i><span class="link-title">&nbsp;&nbsp;{{ trans('manage.category.title') }}</span>
            </a>
        </li>

        <li class="">
            <a href="javascript:;">
                <i class="{{ trans('manage.product.icon') }}"></i>
                <span class="link-title">&nbsp;&nbsp;{{ trans('manage.product.title') }}</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="collapse">
                <li>
                    <a href="{{ route('pageProductIndex') }}">
                        <i class="{{ trans('manage.product.childs.list.icon') }}"></i>&nbsp;&nbsp;{{ trans('manage.product.childs.list.title') }}
                    </a>
                </li>
                <li>
                    <a href="boxed.html">
                        <i class="{{ trans('manage.product.childs.sale.icon') }}"></i>&nbsp;&nbsp;{{ trans('manage.product.childs.sale.title') }}     
                    </a>
                </li>
                <li>
                    <a href="boxed.html">
                        <i class="{{ trans('manage.product.childs.warehouse.icon') }}"></i>&nbsp;&nbsp;{{ trans('manage.product.childs.warehouse.title') }}
                    </a>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="javascript:;">
                <i class="fa fa-building "></i>
                <span class="link-title">Khuyễn mãi</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="collapse">
                <li>
                    <a href="boxed.html">
                        <i class="fa fa-angle-right"></i>&nbsp; Mã giảm giá     
                    </a>
                </li>
                <li>
                    <a href="boxed.html">
                        <i class="fa fa-angle-right"></i>&nbsp; VAT     
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-header"></li>
        
        <li>
            <a href="{{ route('pageCateIndex') }}">
                <i class="fa fa-magic"></i>
                <span class="link-title">Thành viên</span>
            </a>
        </li>
        <li>
            <a href="{{ route('pageCateIndex') }}">
                <i class="fa fa-magic"></i>
                <span class="link-title">Khách hàng</span>
            </a>
        </li>

        <li class="nav-header">Cài đặt</li>
        
        <li>
            <a href="{{ route('pageCateIndex') }}">
                <i class="fa fa-magic"></i>
                <span class="link-title">Thành viên</span>
            </a>
        </li>
        <li>
            <a href="{{ route('pageCateIndex') }}">
                <i class="fa fa-magic"></i>
                <span class="link-title">Khách hàng</span>
            </a>
        </li>
        
        <li class="nav-divider"></li>
        <li>
            <a href="login.html">
                <i class="fa fa-sign-in"></i>
                <span class="link-title">
                    Thoát
                </span>
            </a>
        </li>

    </ul>
    <!-- /#menu -->
</div>
<!-- /#left -->
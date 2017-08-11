<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left"><img src="assets/plugin/assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">Victoria Baker</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
                        </div>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="#"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>

                    <li><a href="{{ route('pageIndexAdmin') }}"><i class="{{ trans('manage.dashboard.icon') }}"></i> {{ trans('manage.dashboard.title') }} </a></li>
                    <li><a href="{{ route('pageCateIndex') }}"><i class="{{ trans('manage.category.icon') }}"></i> {{ trans('manage.category.title') }} </a></li>
                    <li class="">
                        <a href="#" class="has-ul"><i class="{{ trans('manage.product.icon') }}"></i> <span>{{ trans('manage.product.title') }}</span></a>
                        <ul class="hidden-ul" style="display: none;">
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
                        </ul>
                    </li>
                    <li><a><i class="fa fa-shopping-cart"></i> Đơn hàng </a></li>
                    <li><a><i class="fa fa-users"></i> Khách hàng </a></li>
                    <li><a><i class="fa fa-truck"></i> Nhập kho </a></li>
                    <li><a><i class="fa fa-list-alt"></i> Tồn kho </a></li>
                    <li><a><i class="fa fa-signal"></i> Doanh số </a></li>
                    <li><a><i class="fa fa-file-text-o"></i> Thu chi </a></li>
                    <li><a><i class="fa fa-usd"></i> Lợi nhuận </a></li>
                    <li><a><i class="fa fa-cogs"></i> Cài đặt </a></li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
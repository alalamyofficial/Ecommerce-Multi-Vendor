<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html">
        <img src="{{asset('admin/assets/images/logo.svg')}}" alt="logo" />
        </a>
        <a class="sidebar-brand brand-logo-mini" href="index.html">
            <img src="{{asset('admin/assets/images/logo-mini.svg')}}" alt="logo" />
        </a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
        <div class="profile-desc">
            <div class="profile-pic">
            <div class="profile-name">
                <div class="d-flex">
                    <h5 class="mb-0 font-weight-normal">{{Auth::user()->name}}</h5>
                    <span class="ml-3 mt-1">(Admin)</span>
                </div>
            </div>
            </div>
        </div>
        </li>
        <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
        <a class="nav-link" href="/redirect">
            <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
        </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" 
                href="#product" aria-expanded="false" 
                aria-controls="product"
            >
                <span class="menu-icon">
                    <i class="mdi mdi-hanger"></i>
                </span>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> 
                        <a class="nav-link" 
                            href="{{url('/products')}}"
                        > 
                        Show 
                        </a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" 
                            href="{{url('create/product')}}"
                        > 
                        Add Product
                        </a>
                    </li>
                </ul>
            </div>
        </li>



        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" 
                href="#category" aria-expanded="false" 
                aria-controls="category"
            >
                <span class="menu-icon">
                    <i class="mdi mdi-sort-variant"></i>
                </span>
                <span class="menu-title">Categories</span>
                    <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> 
                        <a class="nav-link" 
                            href="{{url('/categories')}}"
                        > 
                        Show 
                        </a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" 
                            href="{{url('create/category')}}"
                        > 
                        Add Category
                        </a>
                    </li>
                </ul>
            </div>
        </li>



        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" 
                href="#order" aria-expanded="false" 
                aria-controls="order"
            >
                <span class="menu-icon">
                    <i class="mdi mdi-shopping"></i>
                </span>
                <span class="menu-title">Orders</span>
                    <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="order">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> 
                        <a class="nav-link" 
                            href="{{url('/orders')}}"
                        > 
                        Show 
                        </a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" 
                            href="{{url('create/order')}}"
                        > 
                        Add Order
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item menu-items">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-icon">
                <i class="mdi mdi-account-multiple"></i>
                </span>
                <span class="menu-title">Users</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-icon">
                <i class="mdi mdi-comment"></i>
                </span>
                <span class="menu-title">Comments</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-icon">
                <i class="mdi mdi-cart"></i>
                </span>
                <span class="menu-title">Cart</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-icon">
                <i class="mdi mdi-email"></i>
                </span>
                <span class="menu-title">Mails</span>
            </a>
        </li>

    </ul>
</nav>
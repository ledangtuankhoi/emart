<div class="sidebar" data-color="purple" data-background-color="white"
    data-image="{{ asset('backend/assets/img/sidebar-1.jpg') }}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
            Creative Tim
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item active  ">
                <a class="nav-link" href="{{route('admin')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard </p>
                </a>
            </li>
            <li class="nav-item">
                <div class="show dropend">
                    <a class="nav-link " href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="material-icons">dashboard</i>
                        Banner Management
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item" href="{{route('banner.index')}}">All Benner</a>
                        <a class="dropdown-item" href="{{route('banner.create')}}">Add banner</a>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <div class="show dropend">
                    <a class="nav-link " href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="material-icons">content_paste</i>
                        Category Management
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item" href="{{route('category.index')}}">All Category</a>
                        <a class="dropdown-item" href="{{route('category.create')}}">Add Category</a>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <div class="show dropend">
                    <a class="nav-link " href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="material-icons">loyalty</i>Brand Management
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item" href="{{route('brand.index')}}">All Brand</a>
                        <a class="dropdown-item" href="{{route('brand.create')}}">Add Brand</a>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item ">
                <div class="show dropend">
                    <a class="nav-link " href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="material-icons">inventory_2</i>Product Management
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item" href="{{route('product.index')}}">All Product</a>
                        <a class="dropdown-item" href="{{route('product.create')}}">Add Product</a>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <div class="show dropend">
                    <a class="nav-link " href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="material-icons">groups</i>User Management
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item" href="{{route('user.index')}}">All Users</a>
                        <a class="dropdown-item" href="{{route('user.create')}}">Add User</a>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">library_books</i>
                    <p>Product Management</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">bubble_chart</i>
                    <p>Cart</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">location_ons</i>
                    <p>Post Category</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">notifications</i>
                    <p>Post Tag</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">language</i>
                    <p>Post Management</p>
                </a>
            </li>
            <li class="nav-item  ">
                <a class="nav-link" href="#">
                    <i class="material-icons">unarchive</i>
                    <p>Review Management</p>
                </a>
            </li>
            <li class="nav-item  ">
                <a class="nav-link" href="#">
                    <i class="material-icons">credit_card</i>
                    <p>Coupon Management</p>
                </a>
            </li>
            <li class="nav-item  ">
                <a class="nav-link" href="#">
                    <i class="material-icons">groups</i>
                    <p>User Management</p>
                </a>
            </li>
            <li class="nav-item  ">
                <a class="nav-link" href="#">
                    <i class="material-icons">rate_review</i>
                    <p>Review Management</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">settings</i>
                    <p>Setting</p>
                </a>
            </li>
        </ul>
    </div>
</div>

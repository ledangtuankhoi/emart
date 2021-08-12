<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{\Request::is('user/dashboard')?'active':''}}" id="tab-dashboard-link"  href="{{route('user.dashboard')}}"  >Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{\Request::is('user/order')?'active':''}}" id="tab-orders-link"  href="{{route('user.order')}}"  >Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{\Request::is('user/downloads')?'active':''}}" id="tab-downloads-link"  href="#tab-downloads"  >Downloads</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{\Request::is('user/address')?'active':''}}" id="tab-address-link"  href="{{route('user.address')}}"  >Adresses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{\Request::is('user/account-detail')?'active':''}}" id="tab-account-link"  href="{{route('user.account')}}" >Account Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link   "  onclick="alert('Are sure logout account');" href="{{ route('user.logout') }}" >Sign Out</a>
        </li>
    </ul>
</aside><!-- End .col-lg-3 -->

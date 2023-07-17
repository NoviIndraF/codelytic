 <!--**********************************
    Nav header start
***********************************-->
<div class="nav-header">
    <div class="brand-logo">
        <a class="text-center"  color='white' href=""> <h2 class="text-white">Codelytic</h2></a>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->

<!--**********************************
    Header start
***********************************-->
<div class="header">    
    <div class="header-content clearfix">
        
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-left">
            <div class="input-group icons">
                <div>
                    <h3 class="mb-1 mt-2">Selamat datang, {{ auth()->user()->name }}</h3>
                </div>
            </div>
        </div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="images/user/1.png" height="40" width="40" alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="/dashboard/users" ><i class="icon-user"></i> <span>Profile</span></a>
                                </li>
                                
                                <hr class="my-2">
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>
                                        Keluar</button>
                                    </form>
                                    </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<!--**********************************
    Header end ti-comment-alt
***********************************-->
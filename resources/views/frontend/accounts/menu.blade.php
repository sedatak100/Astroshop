<section id="page-title" data-parallax-image="{{ asset('frontend/images/parallax/profil.jpg') }}">
    <div class="container">
        <div class="page-title">
            <h1>Hesabım</h1>
            <span>Hoşgeldiniz Sayın "{{ auth()->user()->fullname() }}"</span>
        </div>
    </div>
</section>
@include('frontend.common.breadcrumb')
<div class="page-menu menu-lines">
    <div class="container">
        <div class="menu-title">Kişisel Hesap <span>Menüsü</span></div>
        <nav>
            <ul>
                <li id="li1" class="{{ $menu_active == 'account' ? 'active' : '' }}"><a href="{{ route('frontend.account.view') }}">Kişisel Bilgilerim</a></li>
                <li id="li2" class="{{ $menu_active == 'order' ? 'active' : '' }}"><a href="{{ route('frontend.account.order.lists') }}">Siparişlerim</a></li>
                <li id="li2" class="{{ $menu_active == 'ticket' ? 'active' : '' }}"><a href="{{ route('frontend.account.ticket.lists') }}">Destek</a></li>
            </ul>
        </nav>
        <div id="menu-responsive-icon">
            <i class="fa fa-reorder"></i>
        </div>
    </div>
</div>
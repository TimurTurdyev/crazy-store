<nav class="mb-10 mb-md-0">
    <div class="list-group list-group-sm list-group-strong list-group-flush-x">
        <a class="list-group-item list-group-item-action dropright-toggle active" href="{{ route('customer.orders') }}">
            Заказы
        </a>
        <a class="list-group-item list-group-item-action dropright-toggle " href="account-wishlist.html">
            Wishlist
        </a>
        <a class="list-group-item list-group-item-action dropright-toggle " href="account-personal-info.html">
            Информация
        </a>
        <a class="list-group-item list-group-item-action dropright-toggle" onclick="$('#form-logout').submit();">
            Выйти
        </a>
    </div>
    <form id="form-logout" action="{{ route('logout') }}" method="post">
        @csrf
    </form>
</nav>

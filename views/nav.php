<nav>
    <div class="nav-wrapper">
        <a id="logo-nav" href="/" class="brand-logo">Rhudaur</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/TODO">Members</a></li>
            <?php
                if ($isAdmin) {
                    echo '<li><a href="/user/ID">Admin Panel</a></li>';
                }
                if($logged) {
                    echo '<li><a href="/user/ID">TODO USER</a></li>';
                } else {
                    echo '<li><a href="/login">login</a></li>';
                }
            ?>
        </ul>
    </div>
</nav>
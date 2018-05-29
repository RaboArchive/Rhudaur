

<nav>
    <div class="nav-wrapper">
        <a id="logo-nav" href="/" class="brand-logo">Rhudaur</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/?action=register">Members</a></li>
            <?php
                //require_once('model/DAO/User.php');
                /*if (isset($_SESSION['user'])) {
                    $user = (User)$_SESSION['user'];
                    echo '<li><a href="/user/ID">TODO Profile</a></li>';
                    if ($user.isAdmin()) {
                        echo '<li><a href="/user/ID">TODO Admin Panel</a></li>';

                    }
                } else {*/
                    echo '<li><a href="/?action=login">login</a></li>';
                //}
            ?>
        </ul>
    </div>
</nav>
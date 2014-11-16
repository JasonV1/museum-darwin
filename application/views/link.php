<ul>
    <?php
    // check if user is logged in
    if ($this->session->userdata("logged_in")) {
        // get role of logged in user
        $rol = $this->session->userdata["logged_in"]["role_id"];
        // 1 = ADMIN
        if ($rol == 1) {
            echo "<li>
                    <a href='" . base_url() . "admin/welcome_admin'>Home</a>
                  </li>
                 <li>
                    <a href='" . base_url() . "admin/files'>Bestanden</a>
                 </li>
                 <li>
                    <a href='" . base_url() . "admin/users'>Medewerkers</a>
                 </li>
                 <li>
                    <a href='" . base_url() . "user/logout'>Logout</a>
                 </li>";
        }
        if ($rol == 2) {
            echo "<li>
                    <a href='" . base_url() . "manager/welcome_manager'>Home</a>
                  </li>
                 <li>
                    <a href='" . base_url() . "manager/get_visitors'>Bezoekers</a>
                 </li>
                 <li>
                    <a href='" . base_url() . "manager/get_reservations'>Reserveringen</a>
                 </li>
                 <li>
                    <a href='" . base_url() . "manager/weekoverview'>Weekoverzicht</a>
                 </li>
                 <li>
                    <a href='" . base_url() . "user/logout'>Logout</a>
                 </li>";
        }
        if ($rol == 3) {
            echo "<li>
                    <a href='".base_url()."edumed/welcome_edumed'>Home</a>
                  </li>
                 <li>
                    <a href='".base_url()."edumed/view_tours'>Toeren</a>
                 </li>
                 <li>
                    <a href='".base_url()."user/logout'>Logout</a>
                 </li>";
        }
        if ($rol == 4) {
            echo "<li>
                    <a href='".base_url()."salesman/welcome_salesman'>Home</a>
                  </li>
                 <li>
                    <a href='".base_url()."salesman/create_ticket'>Ticket aanmaken</a>
                 </li>
                 <li>
                    <a href='".base_url()."user/logout'>Logout</a>
                 </li>";
        }
    } // menu items for visitors
    else {
        echo "
                <li>
                    <a href='" . base_url() . "'>Home</a>
                </li>
                <li>
                    <a href='" . base_url() . "booking/reservate'>Ticket bestellen</a>
                </li>
                <li>
                     <a href='" . base_url() . "visitor/museum'>Het Museum</a>
                </li>
                <li>
                     <a href='" . base_url() . "visitor/collection'>Collectie & Zalen</a>
                </li>
                <li>
                    <a href='#'>Toeren</a>
                </li>
                <li>
                    <a href='#'>Contact</a>
                </li>";
    }
    ?>
</ul>
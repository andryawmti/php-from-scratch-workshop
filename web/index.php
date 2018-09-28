<?php

use Workshop\DI;
use Workshop\View\Homepage;
use Workshop\View\Layout;

(new Layout(
    "Twitter homepage",
    new Homepage(
        DI::getAccountRepository()->listAccounts()
    )
))();

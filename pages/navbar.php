

<style is="custom-style">
    paper-toolbar.daylight {
        --paper-toolbar-background: <?php echo getTitleColor() ?>;
        --paper-toolbar-title: {
            font-weight: bold;
        };
    }

    paper-drawer-panel {
        --paper-drawer-panel-left-drawer-container: {
            background-color: #eeeeee;
        };

        height: 100%;
    }


    .drawer-menu {
        --paper-menu-background-color: #eeeeee;
        --menu-link-color: #111111;
        --paper-menu-color: #000000;
    }


</style>




<paper-toolbar class="daylight">
    <shibui-dropdown-menu>
        <paper-icon-button icon="menu" slot="trigger" ></paper-icon-button>

        <?php if(CheckLogin()) { ?>
        <a class="primary">
            <iron-image class="avatar" sizing="cover" preload fade src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAQAAAAlb59GAAAFPElEQVR4Ae3bXWgUVxvA8X+ym49G1GiNCUmLtsH2ouCrNpSKGgTBr/hBpDGtwTZolcREUdqLfly2VfyoXpRqg/rW0qKVRpOKClLEKEgktKKvBmNsSlBsKUaj1TTp6+w+9dKb3TlnzpnZ3bC//31gyMzxeSYjgUhLS0tLy6ecBnbRQgc99DNIhAiD9NNDBy3sZB3l5JMyCqhhP12IUlGusY8VjCOJlbCJdiKIhyKcZyPFJJlMlnKSCGKYw3GWkElSyKWRXxGL3aCeHBIqi3XcRnzoFnWESZBFXEd87BoLCFwxR5EA+oEiAlTDfSSg7lFNIEbwHRJwB8jDZ5O4iiSgy5Tio9n0IwnqLjPxyZv8gySwId7AB6uJIAnOodb+ZUWRJChq99LeIoIkSQ5VWDLb+Nl6yGn2sPlJezjNQ+NnbSYWTDI6CSMcYR5hnhZmPi1EjU7IFzE0wujfrfNMJpYptCOeu8QzGDGZMj4jRDwhtiKe+y8GahDPrUfFRsRzVXhUbDDqbkbVNoMnrRBPWgyerRCqwlxAPHYYDyoMTsLJ6JhqcELORVOWwXZ8BF2tiMc6CaNlHeK5eehaiHhuLRpyuW0wZYTRlcUA4rGb5KCsEfHcabw4g3iuDkWZRu8J9+BFE+K562SiZCli0Ga82IIYtAglJ1Puwn5EQQkRJKVuRcGhCFebECTww6MNMaoRV/rLhPlxn80AYtQ5XBQQRQybbz6+aecwRnFRMegouo4hxlUT137EuChT0FFGFDGuibi6EAu1a60tHYiFOokjH7HUVlR9bu2N42hiKkestREV7yHWmkFMDYjFthEinrDqb8t8GN6FWO0CU4mljA7EajvM33KoF6WVhWTxtGwqOEYUsVwzMXUgvvSIMzSx5UlNtDGA+FI7MfUgKVw3MfUjKVwfMQ0iKdwAMUWQFM4Zthc27G/F4X94DP/jvgNJ4drNR6qAMx+pdiIWu08bX7KexfyHEvIIESKPEqawmPXspo0HiMW2G/2NRaHbfEMtL5GBmwxeZhXf8ru/a4v5otnDJ7xKBroyKONTfvNv0cz3vEz8n4PMxEwG5XzPY88L0ijiuIZoN8QXFGPLc+z29CXQVeLah2h2ghewrZRTtl+/rUA0+pta/LKGIUSj5cQ1TmMQvsM0/PQa9+y94obziFIPmIzfpvEIUeqsvY+AagjCKkSpBlwV4xjMZfZdRFx7TCEKjiOuvU1Q3kVca0XJEsS1SQTlFcS1CpRkcgNxqZ6gbEBc6iIDRfUK00YZQXhdYQpZg7IcbinM8CX4bQJ/Ii71ko2GOsS1KzyLn8YrTa6r0RJW+qE/Mxa/FHAJce1/hNC0QHGmLsYPz9OFKDQHD5oV9+UyH46MPxCFDuJJkeIQOkg9Nm1Q3Mf6KMCjao3PtIot3YInEMWWYeCAxjupTWRhIpv3+QtRbC9G8riMKHeDdwjjRZhVWp9//kIuhkq5i2jUyweMR0cRH3MT0egOE7FgFkOIVg6nqGMCbiZSz084iFaDTMeSKhzEQ70c4kMqKaOEkYQJM5ISyqjkIw7Ri3jIoRKLapPmvzKuxLJaHCTBOazEB1UMIQlskEp8Mou7SIK6w3R8VMplJAFdZCI+y+NrJOD2kksgqgK8JftYRoAKOYwE0EEKCNxcOhEfu8IcEiTMWm4iPtTLakIkVA51dCMW62IN2SSFTBZxDAcx7DGtVJBBkimikXMeL8/hLA0UksTGUk0TnUQVh9qrfMVyxpAyRjODOnbQTDvd9DGAg8MAfXTTTjPbqWMGowhAWlpaWtq/y0nTbLJkZL4AAAAASUVORK5CYII=">
            </iron-image>
            <div class="name"><?php echo $user_name ?></div>
<!--            <div class="email">jeonghunn1@gmail.com</div>-->
        </a>
        <?php } ?>
        <a href="home"><?php S('home') ?></a>
<!--     Singed in  -->
        <?php if(CheckLogin()) { ?>
            <a href="logout"><?php S('logout') ?></a>
        <?php }else{ ?>
<!--          Sign out  -->
            <a href="<?php echo getClientUrl(true)?>login"><?php S('sign_in') ?></a>
            <a href="<?php echo getClientUrl(true)?>signup"><?php S('sign_up') ?></a>
        <?php } ?>



        <a href="info"><?php S('info') ?></a>
    </shibui-dropdown-menu>

    <paper-button onclick="location.href='home'" style="margin-left: 0;"><span class="title" style="margin-left: 0;" ><?php S('app_name')?></span></paper-button>
    <span class="flex"></span>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hackathon Scraper</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar is-transparent">
    
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php">
        <img src="logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="150">
        </a>
        <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
        <span></span>
        <span></span>
        <span></span>
        </div>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start">
        </div>

        <div class="navbar-end">
        <div class="navbar-item">
            <div class="field is-grouped">
                <p class="control">
                    <a class="bd-tw-button button" target="_blank" href="https://github.com/Codeinwp/hackathon-scraper">
                    <span class="icon">
                        <i class="fa fa-github"></i>
                    </span>
                    <span>
                        View Source
                    </span>
                    </a>
                </p>
                <p class="control">
                    <a class="button is-primary" href="https://github.com/Codeinwp/hackathon-scraper#hackathon-scraper">
                    <span class="icon">
                        <i class="fa fa-book"></i>
                    </span>
                    <span>Docs</span>
                    </a>
                </p>
                <p class="control">
                    <a class="button is-info" href="#">
                    <span class="icon">
                        <i class="fa fa-slideshare"></i>
                    </span>
                    <span>Presentation</span>
                    </a>
                </p>
            </div>
        </div>
        </div>
    </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

        // Get all "navbar-burger" elements
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {

                // Get the target from the "data-target" attribute
                var target = $el.dataset.target;
                var $target = document.getElementById(target);

                // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                $el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

            });
            });
        }

        });
    </script>
    <section class="hero is-primary">
        <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Theme Scraper
            </h1>
            <h2 class="subtitle">
                An awesome project for the #AllDay Hackathon (by ThemeIsle).
            </h2>
            
            <div class="field has-addons searchbar-middle">
                <div class="control">
                    <input class="input" type="text" placeholder="Enter the link">
                </div>
                <div class="control">
                    <a class="button is-info">
                        Search
                    </a>
                </div>
            </div>

        </div>
        </div>
    </section>
    <section>
        <table class="table is-hoverable is-stripped middle">
            <thead>
                <tr>
                    <th width="250px">Link</th>
                    <th width="150px">Theme Name</th>
                    <th width="150px">Status</th>                
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Link here</td>
                    <td>Theme name here</td>
                    <td>Active?</td>
                </tr>
            </tbody>
        </table>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="content has-text-centered">
                <p>
                    <strong>Theme Scraper</strong> by <a href="http://github.com/rodica-andronache">Rodica</a>,
                                                        <a href="http://github.com/preda-bogdan">Bogdan</a>, 
                                                        <a href="http://github.com/poonam279">Poonam</a>,
                                                        <a href="http://github.com/rohittm">Rohit</a>, and
                                                        <a href="http://github.com/FitzChris">Chris</a>
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
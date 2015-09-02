<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
        <ul class="title-area">
            <li class="name"></li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">


            <!-- Left Nav Section -->
            <ul class="left">
                <li class="has-dropdown">
                    <a class='black-text' href="/MyPortfolio">Portfolio</a>
                    <ul class="dropdown">
                        @foreach($portfolio as $links)
                        <li><a class='black-text' href="/Portfolio/{!! $links->gallery!!}">{!! $links->gallery!!}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="has-dropdown">
                    <a class='black-text' href="/MyProjects">Projects</a>
                    <ul class="dropdown">
                        @foreach($projects as $project)
                        <li><a class='black-text' href="/Projects/{!! $project->gallery!!}">{!! $project->gallery!!}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a class='black-text' href="/Motion">Motion</a></li>
                <li><a class='black-text' href="/Client">Client Links</a></li>
                <li><a class='black-text' href="/FAQ">FAQ</a></li>
                <li><a class='black-text' href="/Contact">Contact Me</a></li>
            </ul>
        </section>
    </nav>
</div>



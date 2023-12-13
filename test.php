<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Source+Sans+Pro:400,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        /*Counts padding as part of the width*/
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        /* Custom Properties*/

        :root {
            --ff-primary: 'Source Sans Pro', sans-serif;
            --ff-secondary: 'Oswald', monospace;

            --fw-reg: 300;
            --fw-bold: 900;

            --clr-light: #fff;
            --clr-dark: #303030;
            --clr-accent: #235175;
            --clr-accent-hover: #3c89c3;
            --clr-subtitle: #ffa64d;

            --fs-h1: 3rem;
            --fs-h2: 2.25rem;
            --fs-h3: 1.25rem;
            --fs-body: 1rem;

            --bs: 0.25em 0.25em 0.75em rgba(0, 0, 0, .25),
                0.125em 0.125em 0.25em rgba(0, 0, 0, .15);
        }

        @media (min-width: 800px) {
            :root {
                --fs-h1: 4.5rem;
                --fs-h2: 3.75rem;
                --fs-h3: 1.5rem;
                --fs-body: 1.125rem;
            }
        }

        /* General styles */

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--clr-light);
            color: var(--clr-dark);
            margin: 0;
            font-family: var(--ff-primary);
            font-size: var(--fs-body);
            line-height: 1.6;
        }

        section {
            padding: 4em 2em;
        }

        img {
            display: block;
            max-width: 100%;
        }

        strong {
            font-weight: var(--fw-bold);
        }

        /*Navigation bar*/

        #navbar {
            position: fixed;
            top: 0px;
            left: 0px;
            background: var(--clr-accent);
            z-index: 10;
            height: 50px;
        }

        nav ul {
            list-style-type: none;
            display: flex;
            justify-content: flex-end;
            position: relative;
            left: 15px;
        }

        #navbar a,
        #project-grid a,
        #show-all {
            color: #FFF;
            font-size: 20px;
            font-weight: 500;
            text-decoration: none;
        }

        #navbar a {
            padding: 12px 40px 13px 40px;
            line-height: 50px;
        }

        #navbar a:hover {
            background: var(--clr-accent-hover);
        }

        /*Welcome section*/
        #welcome-section {
            position: relative;
            padding: 6em 0em;
        }

        #welcome-section img {
            box-shadow: var(--bs);
        }

        #welcome-section h1 {
            font-weight: var(--fw-reg);
            font-size: var(--fs-h1);
            line-height: 1;
            margin: 0;
        }

        #welcome-section h1 strong {
            display: block;
        }

        #welcome-section h2 {
            display: inline-block;
            background: var(--clr-subtitle);
            padding: .25em 1em;
            font-family: var(--ff-secondary);
            margin-bottom: 1em;
            line-height: 1;
            margin: 0;
        }

        @media (min-width: 600px) {
            #welcome-section {
                display: grid;
                width: min-content;
                margin: 0 auto;
                grid-column-gap: 1em;
                grid-template-areas:
                    "img title"
                    "img subtitle";
                grid-template-columns: min-content max-content;
            }

            #welcome-section img {
                grid-area: img;
                min-width: 250px;
                position: relative;
                z-index: 2;
            }

            #welcome-section h2 {
                grid-area: subtitle;
                align-self: start;
                grid-column: -1 / 1;
                grid-row: 2;
                text-align: right;
                position: relative;
                left: -1.5em;
                width: calc(100% + 1.5em);
            }
        }

        /*  My services section  */

        #my-skills {
            background-color: var(--clr-dark);
            background-image: url("https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80");
            background-blend-mode: multiply;
            background-size: cover;
            color: var(--clr-light);
            text-align: justify;
        }

        #my-skills h2 {
            color: var(--clr-subtitle);
            position: relative;
            text-align: center;
            font-size: var(--fs-h2);
        }

        #my-skills h2::after {
            content: '';
            display: block;
            width: 2.5em;
            height: 1px;
            margin: 0.5em auto 1em;
            background: var(--clr-light);
            opacity: 0.25;
        }

        #skills {
            margin-bottom: 3em;
        }

        #skill {
            max-width: 500px;
            margin: 0 auto;
        }

        .skills-list {
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 800px) {
            #skills {
                display: flex;
                max-width: 1000px;
                margin-left: auto;
                margin-right: auto;
            }

            #skill+#skill {
                margin-left: 4em;
            }
        }

        /*About me section*/

        #about {
            max-width: 1000px;
            margin: 0 auto;
        }

        #about h2 {
            font-size: var(--fs-h2);
            font-weight: var(--fw-bold);
        }

        .subtitle {
            background: var(--clr-subtitle);
            padding: .25em 1em;
            font-family: var(--ff-secondary);
            margin-bottom: 1em;
            font-size: var(--fs-h3);
        }

        #about img {
            box-shadow: var(--bs);
        }

        #about-body {
            text-align: justify;
        }

        @media (min-width: 600px) {
            #about {
                display: grid;
                grid-template-columns: 1fr 250px;
                grid-template-areas:
                    "title img"
                    "subtitle img"
                    "text img";
                grid-column-gap: 2em;
            }

            #about h2 {
                grid-area: title;
            }

            .subtitle {
                grid-column: 1 / -1;
                grid-row: 2;
                position: relative;
                left: -1em;
                width: calc(100% + 2em);
                padding-left: 1em;
                padding-right: calc(200px + 4em);
            }

            #about img {
                grid-area: img;
                position: relative;
                z-index: 2;
            }
        }

        /* Projects section*/

        #projects {
            background-color: var(--clr-dark);
            text-align: center;
            color: white;
        }

        #project-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-gap: 3em;
            justify-items: center;
            justify-content: center;
        }

        #project-title {
            display: block;
            font-size: var(--fs-h2);
            font-weight: var(--fw-bold);
            margin-bottom: 1em;
        }

        .project-tile {
            overflow: hidden;
            border: 0.605em var(--clr-accent) solid;
            border-radius: 0.3125em;
            cursor: pointer;
            height: 370px;
        }

        .project-tile img {
            margin-top: -1.6em;
            height: 300px;
            transition: transform 500ms cubic-bezier(.5, 0, .5, 1);
        }

        .project-tile p {
            position: relative;
            z-index: 2;
            padding: 0.5em 0.5em;
            font-weight: var(--fw-reg);
            background: var(--clr-accent);
        }

        .project-tile:hover p {
            background: var(--clr-accent-hover);
        }

        .project-tile:hover {
            border: 0.605em var(--clr-accent-hover) solid;
            border-radius: 0.3125em;
            background: var(--clr-accent-hover);
        }

        .project-tile:hover img {
            transform: scale(1.2);
        }

        #show-all {
            position: relative;
            top: 2em;
            padding: 0.625em;
            background: var(--clr-accent);
            border-radius: 0.3125em;
            display: table;
            margin: 0 auto;
        }

        #show-all:hover {
            background: var(--clr-accent-hover);
        }

        @media (min-width: 1400px) {
            #project-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
                grid-gap: 3em;
                justify-items: center;
                justify-content: center;
            }
        }

        /* Contact section*/

        #contact {
            background: #111;
            color: var(--clr-light);
        }

        #contact-text {
            text-align: center;
            font-size: var(--fs-h2);
            font-weight: var(--fw-bold);
        }

        #contact-flex {
            display: flex;
            justify-content: center;
            margin: 1em 0 0;
            padding: 0;
        }

        #profile-link {
            font-size: var(--fs-h3);
            text-decoration: none;
            margin: 0 .5em;
            color: var(--clr-light);
            transition: transform 250ms cubic-bezier(.5, 0, .5, 1);
        }

        #profile-link:hover {
            transform: translateY(8px);
        }
    </style>
</head>

<!-- Navigation bar -->
<nav id="navbar" class="container-fluid">
    <ul>
        <li><a href="#my-skills">Skills</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
</nav>

<!-- Welcome section -->
<section id="welcome-section">
    <h1>Hello! I am <strong>Luís Barroso</strong></h1>
    <h2>Software developer</h2>
    <img id="my-photo" class="img-responsive" src="https://avatars2.githubusercontent.com/u/58770446?s=400&u=8f47f8125f8892bcfeeac1349e9af9ab30c9b26b&v=4">
</section>

<!-- My skills -->
<section id="my-skills">
    <h2>Skills</h2>
    <div id="skills">
        <div id="skill">
            <h3>Front-End Development</h3>
            <ul class="skills-list">
                <li>HTML</li>
                <li>CSS</li>
                <li>JavaScript</li>
                <li>React</li>
            </ul>
        </div> <!-- / skill -->

        <div id="skill">
            <h3>Back-End Development</h3>
            <ul class="skills-list">
                <li>Node.js</li>
                <li>Express</li>
                <li>MongoDB</li>
                <li>Mongoose</li>
                <li>Chai</li>
                <li>Mocha</li>
            </ul>
        </div> <!-- / skill -->

    </div> <!-- / skills -->
</section>

<!-- About me section -->
<section id="about" class="container-fluid">
    <h2>About Me</h2>
    <p class="subtitle">Software developer living in Gent</p>

    <div id="about-body">
        <p>
            My name is Luís Barroso and I am 24 years old. I'm from Porto, Portugal and I am a Civil Engineer. Currently I am working as a scaffolding calculator for KAEFER in Belgium and live in Ghent.
        </p>
        <p>
            I have always really liked technology and my plan was to study Electroctechnical Engineering in University but unfortunately I didn't manage to get into the course and went on to my second choice: Civil Engineering.
        </p>
        <p>
            After finishing my master's degree I went to Mozambique where I worked for a year as a junior construction manager. After that I came back to Europe where I currently work in Bekgium for about 6 months.
        </p>
        <p>
            Even though I find Civil Engineering quite interesting and enjoyed taking my degree in this field, after having worked for about a year and a half I know that it's not what I want to do with my life.
        </p>
        <p>
            Ever since I made the decision to start learning how to code by myself, I feel like I found what I want to do in my life. I am enjoying a lot working on small projects, trying to find solutions for the problems that I encounter and learning so much in the process.
        </p>
    </div>
    <img src="https://scontent-bru2-1.cdninstagram.com/v/t51.2885-15/sh0.08/e35/s640x640/57286277_1028285234032887_3550591819619277910_n.jpg?_nc_ht=scontent-bru2-1.cdninstagram.com&_nc_cat=103&_nc_ohc=DjhUygUF6koAX8kaZMM&oh=8fda42ecad3fd37f3bc89f482b4798ef&oe=5EE43B4B" alt="A photo of me diving in Mozambique">
</section>

<!-- Projects section -->
<section id="projects" class="container-fluid">
    <h2 id="project-title">Projects</h2>
    <div id="project-grid">

        <div class="project-tile"> <!-- Project -->
            <a target="_blank" id="profile-link" href="https://codepen.io/luisbarroso/full/bGNOmzG">
                <img class="img-responsive" src="https://screenshot.codepen.io/4025030.bGNOmzG.b90fd26e-3350-4b22-92d8-9542a08e2135.png">
                <p>Product Landing Page</p>
            </a>
        </div>

        <div class="project-tile"> <!-- Project -->
            <a target="_blank" id="profile-link" href="https://codepen.io/luisbarroso/full/KKwbdwW">
                <img class="img-responsive" src="https://screenshot.codepen.io/4025030.KKwbdwW.2bfbda4d-3f86-4795-aba3-90f8650c5464.png">
                <p>Survey Form</p>
            </a>
        </div>

        <div class="project-tile"> <!-- Project -->
            <a target="_blank" id="profile-link" href="https://codepen.io/luisbarroso/full/wvaJqxx">
                <img class="img-responsive" src="https://screenshot.codepen.io/4025030.wvaJqxx.c25eb5eb-f225-4d28-9583-c45f36f26bff.png">
                <p>Markdown Previewer</p>
            </a>
        </div>

        <div class="project-tile"> <!-- Project -->
            <a target="_blank" id="profile-link" href="https://codepen.io/luisbarroso/full/poJexYE">
                <img class="img-responsive" src="https://screenshot.codepen.io/4025030.poJexYE.366b3760-df0b-4cbd-8dbb-fe9ffa42443e.png">
                <p>Drum Machine</p>
            </a>
        </div>

        <div class="project-tile"> <!-- Project -->
            <a target="_blank" id="profile-link" href="https://codepen.io/luisbarroso/full/BaNZdYR">
                <img class="img-responsive" src="https://screenshot.codepen.io/4025030.BaNZdYR.31d408c7-cc4b-4b27-80d8-da9e9327ec10.png">
                <p>Javascript Calculator</p>
            </a>
        </div>

        <div class="project-tile"> <!-- Project -->
            <a target="_blank" id="profile-link" href="https://codepen.io/luisbarroso/full/zYGPOLV">
                <img class="img-responsive" src="https://screenshot.codepen.io/4025030.zYGPOLV.d8a0bfc8-f9fa-4603-b8ff-fc12afc59a10.png">
                <p>Pomodoro Clock</p>
            </a>
        </div>
    </div>
    <a target="_blank" id="show-all" href="https://codepen.io/luisbarroso"> Show All &gt;</a>
</section>

<!-- Contacts section -->
<section id="contact" class="container-fluid">
    <p id="contact-text">Want to get in touch with me?</p>
    <div id="contact-flex">
        <a target="_blank" id="profile-link" href="https://github.com/LuisBarroso37"><i class="fab fa-github"></i> Github</a>
        <a target="_blank" id="profile-link" href="https://www.linkedin.com/in/lu%C3%ADs-barroso-44433114a/"><i class="fab fa-linkedin"></i> LinkedIn</a>
        <a target="_blank" id="profile-link" href="https://codepen.io/luisbarroso"><i class="fab fa-codepen"></i> Codepen</a>
        <a target="_blank" id="profile-link" href="https://glitch.com/@LuisBarroso37"><i class="fas fa-server"></i> Glitch</a>
        <a id="profile-link" href="mailto:luismendesbarroso@gmail.com"><i class="fas fa-envelope"></i> Email</a>
    </div>
</section>
![GitHub language count](https://img.shields.io/github/languages/count/troy-jsx/made-men?color=000000)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/troy-jsx/made-men?color=000000)

<h5 align="center" style="padding:0;margin:0;">Troy Evans</h5>
<h5 align="center" style="padding:0;margin:0;">251096</h5>
<h6 align="center">DV200</h6>
</br>
<p align="center">

<p align="center">
  <img src="/readMeImgs/Made%20Men.png" alt="image1">
</p>

  <h3 align="center">Made Men</h3>

  <p align="center">
    A browser-based mafia simulator. Join a mob, complete tasks, vote on family decisions, and fight for territory and survival <br>
   <br />
   <br />
   <a href="https://drive.google.com/file/d/1iLtI2ccw_1nlE2Bp5QnthvuAnqXjEszi/view?usp=sharing">View Demo</a>
</p>

## Table of Contents

* [About the Project](#about-the-project)
  * [Project Description](#project-description)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [How to install](#how-to-install)
* [Features and Functionality](#features-and-functionality)
* [Concept Process](#concept-process)
   * [Ideation](#ideation)
   * [Wireframes](#wireframes)
   * [User-flow](#user-flow)
* [Development Process](#development-process)
   * [Implementation Process](#implementation-process)
        * [Highlights](#highlights)
        * [Challenges](#challenges)
   * [Future Implementation](#future-implementation)
* [Final Outcome](#final-outcome)
    * [Mockups](#mockups)
    * [Video Demonstration](#video-demonstration)
* [Contributing](#contributing)
* [License](#license)
* [Contact](#contact)
* [Acknowledgements](#acknowledgements)

<!--PROJECT DESCRIPTION-->
## About the Project

### Project Description

Made Men is a browser-based mafia simulator. Players sign up, pick an avatar and join one of four rival mobs fighting for territory and survival. The game loop: complete player-made tasks for cash and mob funds, vote on promotions, territory takeovers and perk unlocks, and keep your mob's balance above zero so the daily toll doesn't wipe you out.

### Built With

* [PHP](https://www.php.net/) — frontend and backend logic
* [MySQL](https://www.mysql.com/) — database, accessed via a single shared PDO connection
* [Tailwind CSS v4](https://tailwindcss.com/) — styling, built via the CLI watch command


## Getting Started

The following instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Ensure you have [XAMPP](https://www.apachefriends.org/) (or an equivalent Apache + MySQL + PHP stack) installed and running, along with [Node.js](https://nodejs.org/) for the Tailwind build.

### How to install

1. Clone Repository </br>
Run the following in the command line to clone the project:
   ```sh
   git clone https://github.com/troy-jsx/made-men.git
   ```

2. Install Dependencies </br>
Run the following in the command line to install Tailwind:
   ```sh
   npm install 
   ```

3. Set Up the Database </br>
Import the schema (made_men.sql in the config folder) into MySQL via phpMyAdmin or the CLI, and point `config/db.php` at your local database.

4. Build Tailwind </br>
Run the following in the command line to compile the stylesheet and watch for changes:
   ```sh
   npx tailwindcss -i ./src/input.css -o ./src/output.css --watch
   ```

5. Serve the Project </br>
Move the project folder into your XAMPP `htdocs` directory and start Apache and MySQL using the XAMPP control panel. Navigate to `public/index.php`, which routes pages via a `?page=` query parameter.

## Features and Functionality
### Auth & Onboarding

Signup collects username, email and password only. New players then pick an avatar through a no-JS, CSS `:has()`-based live preview, before landing on mob select. Login routes players automatically based on progress: no avatar sends you to onboarding, an avatar with no mob sends you to mob select, if the user has both they are sent into the game screen.

![image2][image2]

![image12][image12]

![image13][image13]

![image14][image14]

![image15][image15]

### Game Screen & Territory Map

The map shows colour-coded dots per territory, with all relevant data pulled live from the database. A sidebar shows the player's avatar, mob, cash, rank, level and any tasks assigned to them.

![image3][image3]
### Mob Info & Hierarchy

Mob members are grouped by rank (Underboss, Capos, Soldiers, Associates) with click-to-open ID card overlays. A dedicated ledger screen shows mob balance, the daily bribe due, and a survival estimate for after that bribe is paid.

![image16][image17]
![image16][image18]
![image19][image19]
### Tasks

Players ranked Soldier and above can create rank-assigned player-made tasks. Accepting a task pays out immediately to both the player and the mob balance.

![image5][image5]
### Voting & Mob Economy

Soldiers and above vote on promotions, territory takeovers and task-type perk unlocks, resolving instantly once a majority threshold is crossed. Territories generate hourly income and mobs pay a daily toll, a mob that can't afford it, or that loses all its territory, is eliminated and its members are kicked back to mob select.

![image16][image16]
<!-- CONCEPT PROCESS -->
## Concept Process

The `Conceptual Process` is the set of actions, activities and research that was done when starting this project.

### Ideation

![image6][image6]

<!-- DEVELOPMENT PROCESS -->
## Development Process

The `Development Process` covers the technical implementation and functionality built across the frontend and backend.

### Implementation Process

* Routing handled in `public/index.php` via a `$_GET['page']` lookup array mapping page names to view files, defaulting to signup.
* Single shared PDO connection in `config/db.php`, required once so it's available across all included views.
* Folder structure: `config/`, `public/` (`img/`, `index.php`), `src/`, `views/` (`auth/`, `game/`, `partials/`).
* An `runEconomyTick()` function handles hourly territory income, daily tolls, and mob elimination, called once per page load.

#### Highlights

* Picked up PHP and PDO (prepared statements, sessions, `htmlspecialchars`) from scratch over the course of the build, and found it much more simple to work with compared to the MERN stack.
* Built a fully working avatar preview using only CSS `:has()` selectors, no JavaScript required.
* Became much more comfortable using tailwindCSS and learnt better responsive web design skills (though not fully implemented accross the project due to time constraints).

#### Challenges

* A POST-handler ordering bug where task-accept logic ran after the sidebar had already read stale player data.
* Tailwind's JIT compiler failing to scan dynamic class names, worked around with plain inline CSS sibling selectors instead of `peer` utilities.
* Deliberately cut scope mid-build (safehouse/heat mechanic, harassment mechanic, crew-leader tracking, pre-game mob select) to protect the core loop given the time available.

### Future Implementation

* Harassment mechanic between rival mobs (solo/group, cash-steal on a timer).
* Pre-game mob select flow for when a match hasn't started yet.
* Minigames plugged into the task accept/payout flow.
* Capo-led crew tasks with shared rewards.

<!-- MOCKUPS -->
## Final Outcome

### Mockups

![image10][image10]
<br>
![image11][image11]

<!-- VIDEO DEMONSTRATION -->
### Video Demonstration

To see a run through of the application, click below:

[View Demonstration](https://drive.google.com/file/d/1iLtI2ccw_1nlE2Bp5QnthvuAnqXjEszi/view?usp=sharing)

## Contributing

This was built as a solo university project, so contributions aren't currently open, but feel free to fork it and adapt it.

<!-- AUTHORS -->
## Authors

* **Troy** - [troy-jsx](https://github.com/troy-jsx)

<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.

<!-- CONTACT -->
## Contact

* **Troy** - [251096@virtualwindow.co.za](mailto:251096@virtualwindow.co.za)
* **Project Link** - https://github.com/troy-jsx/made-men

<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements

* [Tailwind CSS](https://tailwindcss.com/)
* [dbdiagram.io](https://dbdiagram.io/)


<!-- MARKDOWN LINKS & IMAGES -->
[image2]: /readMeImgs/SignUp.png
[image3]: /readMeImgs/gameScreen.png
[image5]: /readMeImgs/createTask.png
[image6]: /readMeImgs/ideation.png
[image10]: /readMeImgs/mockup1.png
[image11]: /readMeImgs/mockup2.png
[image12]: /readMeImgs/Login.png
[image13]: /readMeImgs/ob1.png
[image14]: /readMeImgs/ob2.png
[image15]: /readMeImgs/mgSelect.png
[image16]: /readMeImgs/vote.png
[image17]: /readMeImgs/overlay.png
[image18]: /readMeImgs/ledger.png
[image19]: /readMeImgs/hoverhannah.png
<?php if (session_status() == PHP_SESSION_NONE) { session_start(); } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" type="image/png" href="img/icon.png" />

    <link
      href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <title>Polo Bank - Birajte najbolje</title>

    <script defer src="js/modal.js"></script>
    <script defer src="js/script.js"></script>
    <script defer src="js/hamburger.js"></script>
  </head>
  <body>
    <header class="header">
      <nav class="nav">
        <img
          src="img/logo.png"
          alt="Polo Bank logotip"
          class="nav_logo"
        />
        <ul class="nav__links">
          <li class="nav__item">
            <a class="nav__link" href="#section--1">O nama</a>
          </li>
          <li class="nav__item">
            <a class="nav__link" href="#section--2">Mogućnosti</a>
          </li>
          <li class="nav__item">
            <a class="nav__link" href="#section--3">Naši korisnici</a>
          </li>
          <li class="nav__item">
            <a class="btn button-modal" data-target="#register"
              >Registrujte se</a
            >
          </li>
          <li class="nav__item">
            <a class="btn button-modal" id="lgnBtn" data-target="#login"
              >Prijavite se</a
            >
          </li>
        </ul>
        <div class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      </nav>
      <div class="header__title">
        <!-- <h1 onclick="alert('HTML alert')"> -->
        <h1>
          Birajte bolju 
          <br />
          <span class="highlight" style="color:#fff;">budućnost.</span>
        </h1>
        <h4>Jednostavnost. Efikasnost. Sigurnost.</h4>
        <button class="btn--text btn--scroll-to">Više o nama &DownArrow;</button>
        <img
          src="img/hero.png"
          class="header__img"
          alt="Minimalist bank items"
        />
      </div>
    </header>

    <section class="section" id="section--1">
      <div class="section__title">
        <h2 class="section__description">Pogodnosti</h2>
        <h3 class="section__header">
          Donosimo Vam potpunu revoluciju.
        </h3>
      </div>

      <div class="features">
        <img
          src="img/digital-lazy.png"
          data-src="img/digital.png"
          alt="Computer"
          class="features__img lazy-img"
        />
        <div class="features__feature">
          <div class="features__icon">
            <svg>
              <use xlink:href="img/icons.svg#icon-monitor"></use>
            </svg>
          </div>
          <h5 class="features__header">Digitalna banka</h5>
          <p>
            Imajte uvid na Vaše kartice, šaljite i primajte novac putem interneta, nikad brže i jednostavnije.
          </p>
        </div>

        <div class="features__feature">
          <div class="features__icon">
            <svg>
              <use xlink:href="img/icons.svg#icon-trending-up"></use>
            </svg>
          </div>
          <h5 class="features__header">Jeftine transakcije</h5>
          <p>
            Nikad niži fee kada su u pitanju transakcije a iste se obrađuju u roku od 5 sekundi!
          </p>
        </div>
        <img
          src="img/grow-lazy.png"
          data-src="img/grow.png"
          alt="Plant"
          class="features__img lazy-img img-center"
        />

        <img
          src="img/card-lazy.png"
          data-src="img/card.png"
          alt="Credit card"
          class="features__img lazy-img"
        />
        <div class="features__feature">
          <div class="features__icon">
            <svg>
              <use xlink:href="img/icons.svg#icon-credit-card"></use>
            </svg>
          </div>
          <h5 class="features__header">Kratak rok isporuke kartice</h5>
          <p>
            Nakon registracije kartica je kod Vas u roku 2 dana i ista je potpuno <b>BESPLATNA</b>.
          </p>
        </div>
      </div>
    </section>

    <section class="section" id="section--2">
      <div class="section__title">
        <h2 class="section__description">Operacije</h2>
        <h3 class="section__header">
          Naša svrha je da zadovoljimo potrebe naših klijenata.
        </h3>
      </div>

      <div class="operations">
        <div class="operations__tab-container">
          <button
            class="btn operations__tab operations__tab--1 operations__tab--active"
            data-tab="1"
          >
            Brze Transakcije
          </button>
          <button class="btn operations__tab operations__tab--2" data-tab="2">
            Više Kartica
          </button>
          <button class="btn operations__tab operations__tab--3" data-tab="3">
            100% Sigurnost
          </button>
        </div>
        <div
          class="operations__content operations__content--1 operations__content--active"
        >
          <div class="operations__icon operations__icon--1">
            <svg>
              <use xlink:href="img/icons.svg#icon-upload"></use>
            </svg>
          </div>
          <h5 class="operations__header">
            Tranfser money to anyone, instantly! No fees, no BS.
          </h5>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip ex ea commodo consequat.
          </p>
        </div>

        <div class="operations__content operations__content--2">
          <div class="operations__icon operations__icon--2">
            <svg>
              <use xlink:href="img/icons.svg#icon-home"></use>
            </svg>
          </div>
          <h5 class="operations__header">
            Buy a home or make your dreams come true, with instant loans.
          </h5>
          <p>
            Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
            cupidatat non proident, sunt in culpa qui officia deserunt mollit
            anim id est laborum.
          </p>
        </div>
        <div class="operations__content operations__content--3">
          <div class="operations__icon operations__icon--3">
            <svg>
              <use xlink:href="img/icons.svg#icon-user-x"></use>
            </svg>
          </div>
          <h5 class="operations__header">
            No longer need your account? No problem! Close it instantly.
          </h5>
          <p>
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
            officia deserunt mollit anim id est laborum. Ut enim ad minim
            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat.
          </p>
        </div>
      </div>
    </section>

    <section class="section" id="section--3">
      <div class="section__title section__title--testimonials">
        <h2 class="section__description">Donesite odluku odmah</h2>
        <h3 class="section__header">
          Hiljade zadovoljnih korisnika Polo Bank usluga širom države.
        </h3>
      </div>

      <div class="slider">
        <div class="slide">
          <div class="testimonial">
            <h5 class="testimonial__header">Best financial decision ever!</h5>
            <blockquote class="testimonial__text">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Accusantium quas quisquam non? Quas voluptate nulla minima
              deleniti optio ullam nesciunt, numquam corporis et asperiores
              laboriosam sunt, praesentium suscipit blanditiis. Necessitatibus
              id alias reiciendis, perferendis facere pariatur dolore veniam
              autem esse non voluptatem saepe provident nihil molestiae.
            </blockquote>
            <address class="testimonial__author">
              <img src="img/user-1.jpg" alt="" class="testimonial__photo" />
              <h6 class="testimonial__name">Aarav Lynn</h6>
              <p class="testimonial__location">San Francisco, USA</p>
            </address>
          </div>
        </div>

        <div class="slide">
          <div class="testimonial">
            <h5 class="testimonial__header">
              The last step to becoming a complete minimalist
            </h5>
            <blockquote class="testimonial__text">
              Quisquam itaque deserunt ullam, quia ea repellendus provident,
              ducimus neque ipsam modi voluptatibus doloremque, corrupti
              laborum. Incidunt numquam perferendis veritatis neque repellendus.
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo
              deserunt exercitationem deleniti.
            </blockquote>
            <address class="testimonial__author">
              <img src="img/user-2.jpg" alt="" class="testimonial__photo" />
              <h6 class="testimonial__name">Miyah Miles</h6>
              <p class="testimonial__location">London, UK</p>
            </address>
          </div>
        </div>

        <div class="slide">
          <div class="testimonial">
            <h5 class="testimonial__header">
              Finally free from old-school banks
            </h5>
            <blockquote class="testimonial__text">
              Debitis, nihil sit minus suscipit magni aperiam vel tenetur
              incidunt commodi architecto numquam omnis nulla autem,
              necessitatibus blanditiis modi similique quidem. Odio aliquam
              culpa dicta beatae quod maiores ipsa minus consequatur error sunt,
              deleniti saepe aliquid quos inventore sequi. Necessitatibus id
              alias reiciendis, perferendis facere.
            </blockquote>
            <address class="testimonial__author">
              <img src="img/user-3.jpg" alt="" class="testimonial__photo" />
              <h6 class="testimonial__name">Francisco Gomes</h6>
              <p class="testimonial__location">Lisbon, Portugal</p>
            </address>
          </div>
        </div>

        <button class="slider__btn slider__btn--left">&larr;</button>
        <button class="slider__btn slider__btn--right">&rarr;</button>
        <div class="dots"></div>
      </div>
    </section>

    <section class="section section--sign-up">
      <div class="section__title">
        <h3 class="section__header">
          Pridružite nam se danas i iskusite benefite koje nudi naša banka!
        </h3>
      </div>
      <button class="btn button-modal" data-target="#register">Otvorite račun ODMAH!</button>
    </section>

    <footer class="footer">
      <img src="img/icon.png" alt="Logo" class="footer__logo" />
      <p class="footer__copyright">
        &copy; Sva prava zadržana od strane autora Almira Hodžića.
      </p>
    </footer>

  <!-- REGISTER -->
    <div class="overlay hidden"></div>
    <div class="modal_window hidden" id="register">
      <button class="btn_close-modal">&times;</button>
      <h2 class="modal__header">
        Otvorite račun <br />
        u manje od <span class="highlight" style="color:#fff;">1 minute!</span>
      </h2>
      <form class="modal__form" action="actions/podaci.php" method="POST">
        <label>Ime i prezime</label>
        <input type="text" name="ime_prezime"/>
        <label>Email</label>
        <input type="email" name="email"/>
        <label>Datum rođenja</label>
        <input type="date" name="datum"/>
        <label>Grad</label>
        <input type="text" name="grad"/>
        <label>Adresa</label>
        <input type="text" name="adresa"/>
        <label for="card-select">Tip kartice</label>
        <select name="cards" id="card-select">
        <option value="">Odaberite tip kartice</option>
        <option value="Master Card">MasterCard</option>
        <option value="Visa">Visa</option>
        </select>
        <label>Šifra</label>
        <input type="password" name="password" />
        <label>PIN</label>
        <input type="password" pattern="[0-9]*" inputmode="numeric" name="pin" minlength="4" maxlength="4"/>
        <?php
          if(!empty($_SESSION['error']) && $_SESSION['error'] == 'Već postoji račun sa takvim e-mailom, pokušajte ponovo.'){
            echo '<p class="incorrect">';
              echo $_SESSION['error'];
            echo '</p>';

            echo '
              <script>
                document.querySelector(".incorrect").style.display = "block";
                document.querySelector("#register").classList.remove("hidden");
                document.querySelector(".overlay").classList.remove("hidden");
              </script>
            ';
            session_destroy();
          }elseif(!empty($_SESSION['year']) && $_SESSION['year'] == 'Morate imati 18 ili više godina da biste otvorili račun!'){
            echo '<p class="incorrect">';
              echo $_SESSION['year'];
            echo '</p>'; 

            echo '
              <script>
                document.querySelector(".incorrect").style.display = "block";
                document.querySelector("#register").classList.remove("hidden");
                document.querySelector(".overlay").classList.remove("hidden");
              </script>
            ';
            session_destroy();
          }elseif(!empty($_SESSION['fields']) && $_SESSION['fields'] == 'Molimo popunite sva polja!'){
            echo '<p class="incorrect">';
              echo $_SESSION['fields'];
            echo '</p>'; 

            echo '
              <script>
                document.querySelector(".incorrect").style.display = "block";
                document.querySelector("#register").classList.remove("hidden");
                document.querySelector(".overlay").classList.remove("hidden");
              </script>
            ';
            session_destroy();
          }
        ?>
        <button class="btn" type="submit">Otvori račun &rarr;</button>
      </form>
    </div>

  <!-- LOGIN --> 
  <div class="modal_window hidden" id="login">
      <button class="btn_close-modal">&times;</button>
      <h2 class="modal__header">
        Ulogujte<span class="highlight" style="color:#fff;"> se.</span>
      </h2>
      <form class="modal__form" action="actions/podaci.php" method="POST">
        <label>Email</label>
        <input type="email" name="email_login"/>
        <label>Šifra</label>
        <input type="password" name="password_login" />
        <?php  
          if(!empty($_SESSION['error']) && $_SESSION['error'] == 'Vaš email ili lozinka nisu validni, pokušajte ponovo.'){
            echo '<p class="incorrect">';
              echo $_SESSION['error'];
            echo '</p>'; 

            echo '
              <script>
                document.querySelector(".incorrect").style.display = "block";
                document.querySelector("#login").classList.remove("hidden");
                document.querySelector(".overlay").classList.remove("hidden");
              </script>
            ';
            session_destroy();
          }
        ?>
        <button class="btn">Ulogujte se &rarr;</button>
      </form>
    </div> 


    <!-- <script src="script.js"></script> -->
  </body>
</html>

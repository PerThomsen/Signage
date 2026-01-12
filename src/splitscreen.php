<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/monacor.css" />
  </head>
  <body>
    <header>
        
    </header>

    <div class="min-vh-100 d-flex align-items-center justify-content-center">


  <!--Main layout-->
  <main class="my-2">
    <div class="container">
      <!--Section: Content -->
      <section class="text-center">

        <div class="row">
          <div class="col-lg-12 mb-4 mx-auto">
            <div class="card border border-primary mon_border_style p-5">
              <p>&nbsp;</p>
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-init data-mdb-ripple-color="light">  
                <img src="img/MI-Logo.png" class="img-fluid" />
              </div>
              <div class="card-body">
                <p>&nbsp</p>
                <div class="box2"><h1 id="real-time-clock"></h1></div>
                <p>&nbsp</p>
                <div class="box1">Dynamisk kalender (kun hvis udfyldt></div>
                <p>&nbsp</p>
                <div class="box3">Besøg af (kun hvis udfyldt></div>
                <p>&nbsp</p>
                <div class="box4">Vi arbejder hjemme i dag (kun hvis aktiv></div>
                <p>&nbsp</p>

                <?php include "slider.php" ?>
                <p>&nbsp;</p>
                <h1 class="card-title">Kontaktinfo:</h1>
                <p class="card-text">
                <h3>Tlf. 44 34 90 00<br /> eller mail@monacor.dk<br />Pakker kan stilles i opgang under trappen</h3>
                </p>
              </div>
            </div>
          </div>
      </div>


      <div class="row">
        <hr class="m-5" />
      </div>

        <div class="row">
          <div class="col-lg-12 mb-4 mx-auto">
            <div class="card border border-danger mon_border_style ">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-init data-mdb-ripple-color="light">
                <img class=".img-fluid. max-width: 300%; height: auto;" src="img/cornered.webp" class="img-fluid" />
              </div>
              <div class="card-body">
                <h5 class="card-title">Kontakt info:</h5>
                <p class="card-text">
                  Mail: info@cornered.dk<br />
                  Tel.: +45 4366 1088<br />
                  Farum Gydevej 65, 3520 Farum, Denmark
                </p>
              </div>
            </div>
          </div>
        </div>

      </section>
      <!--Section: Content-->
    </div>
    </div>

  </main>


    <script>
      //https://dev.to/msnmongare/displaying-real-time-day-date-and-time-in-a-custom-format-using-javascript-5did
      function updateDateTime() {
          const clockElement = document.getElementById('real-time-clock');
          const currentTime = new Date();

          // Define arrays for days of the week and months to format the day and month names.
          const daysOfWeek = ['Søndag', 'Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lørdag'];
          const dayOfWeek = daysOfWeek[currentTime.getDay()];

          const months = ['januar', 'februar', 'marts', 'april', 'maj', 'juni', 'july', 'august', 'september', 'oktober', 'november', 'december'];
          const month = months[currentTime.getMonth()];

          const day = currentTime.getDate();
          const year = currentTime.getFullYear();

          // Calculate and format hours (in 12-hour format), minutes, seconds, and AM/PM.
          let hours = currentTime.getHours();
          //hours = hours % 12 || 12;
          const minutes = currentTime.getMinutes().toString().padStart(2, '0');
          const seconds = currentTime.getSeconds().toString().padStart(2, '0');

          // Construct the date and time string in the desired format.
          const dateTimeString = `${dayOfWeek} ${day}. ${month} ${year} - ${hours}:${minutes}:${seconds}`;
          clockElement.textContent = dateTimeString;
      }

      // Update the date and time every second (1000 milliseconds).
      setInterval(updateDateTime, 1000);

      // Initial update.
      updateDateTime();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>    
  </body>
</html>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Dashboard Studenteß</title>
  <link rel='stylesheet' href='//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'><link rel="stylesheet" href="{{ asset('assets/css/style_dashboardstudente.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' />
  <style>


.fc .fc-toolbar-title { /* Targets the month name */
    color: white; 
}

.fc .fc-daygrid-day-top {  /* Targets the day numbers */
    color: white;

  }
  /* Place this in your style_dashboardstudent.css */ 

/* Targets weekday names (Mon, Tue, Wed, etc ) */
.fc th.fc-daygrid-day-top { 
    color: white; 
}

/* Targets day numbers (1, 2, 3, etc.) */
.fc .fc-daygrid-day-number {
    color: black;
}
.fc .fc-col-header-cell-cushion {
color: white
}
.fc-event { 
    background-color: #3788d8; /* Example: Light blue */
    border-color: #3788d8; 
}


.event-popup {
  position: absolute; /* Allows precise positioning */
  display: none;      /* Hidden by default */
  background-color: #fff; /* White background */
  border: 1px solid #ccc; /* Subtle border */
  box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2); /* Adds a soft shadow */
  padding: 15px;      /* Inner spacing */
  z-index: 1000;      /* Ensures it's on top */
}

/* Style for the title inside the popup */
.event-popup h2 {
  font-size: 18px;
  margin-bottom: 10px;
  color: black;
}
.event-popup p {
  font-size: 14px;
  color: black;
}

  </style>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

  <style>
body {
  --light: hsl(0, 0%, 100%);
  --background: linear-gradient(to right bottom, hsl(236, 50%, 50%), hsl(195, 50%, 50%));
}
.container_due {
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 10px;
  padding-right: 10px;
  color: black;
}

.fc-col-header-cell{
  background-color: rgb(55 80 209)   !important; 
}



.responsive-table {
  li {
    border-radius: 3px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center; /* Aggiungi questa riga per centrare verticalmente il contenuto */
    margin-bottom: 25px;
  }
  .table-header {
    background-color: #95A5A6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    text-align: center; /* Aggiungi questa riga per centrare il testo nell'intestazione */
  }
  .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
  }
  .col-1,
  .col-2,
  .col-3,
  .col-4 {
    display: flex;
    justify-content: center; /* Aggiungi questa riga per centrare orizzontalmente il contenuto */
    align-items: center; /* Aggiungi questa riga per centrare verticalmente il contenuto */
    flex-basis: 25%;
  }

  .col-1 {
    flex-basis: 10%;
  }
  .col-2 {
    flex-basis: 40%;
  }
  .col-3 {
    flex-basis: 25%;
  }
  .col-4 {
    flex-basis: 25%;
  }
  /* Basic styling - adjust as desired */
.chat-container {
    width: 400px;
    height: 400px;
    border: 1px solid #ccc;
}

.chat-history {
    height: 300px;
    overflow-y: auto;
    padding: 10px;
}

.message {
    margin-bottom: 10px;
    padding: 8px;
    border-radius: 5px;
}

.user-message {
    background-color: #dfe6e9; /* Light blue */
    text-align: left;
}

.bot-message {
    background-color: #e8f5e9; /* Light green */
    text-align: right;  
}

/* Styling for code blocks */


}

/* defaults */
/* =============================================== */


    </style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="container_first">
  @if (session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
@endif
  <div class="drawer">
    <center>
      <img src="{{  asset('assets/img/logo.jpg')}}" width="50px" height="50px" alt="" style="padding-top: 1.5em;" class="icon">
    </center>
    <div class="menu">
      <a data-menu="dashboard" href="#" class="active"><i class="icon ion-home"></i></a>
      <a data-menu="users" href="#"><i class="icon ion-person-stalker"></i></a>
      <a data-menu="marks" href="#"><i class="icon ion-sad-outline"></i></a>
      <a data-dialog="logout" href="#"><i class="icon ion-log-out"></i></a>
      <a data-menu="compiti" href="#"><ion-icon name="calendar-number-outline"></ion-icon></a>
      <a data-menu="chat" href="#"><ion-icon name="chatbubbles-outline"></ion-icon></a>
      <a data-menu="about" href="#"><i class="icon ion-information-circled"></i></a>
    </div>
    <span class="credits">{{ $studente->NOME }} {{ $studente->COGNOME }}
    <br>
    {{ $classe[0]->NOME }}
    </span>
  </div>
  <div class="content">
    <div class="page active" data-page="dashboard">
      <div class="header">
        <div class="title">
          <h2>Sezione per lo studente</h2>
        </div>
      </div>
      <div class="grid">
        <div class="card">
          <div class="head">
            <span class="icon">
              <i class="icon ion-sad-outline"></i>
            </span>
            <span class="stat">
              VOTI
            </span>
          </div>
          <div class="body">
            <h2>Sezione con la lista dei voti</h2>
            <p>
              In questa sezione troverai la media dei tuoi voti e la lista dei tuoi voti. Inoltre troverai un grafico con la media dei tuoi voti.
            </p>
          </div>
          <div class="footer">
            <div class="user">
              <div class="user-icon">
                <img src="{{  asset('assets/img/grading-in-education-computer-icons-test-student-png-favpng-DCv96JXC4Ccvb0FgzGUFcQ89L.jpg')}}" width="50px" height="50px" alt="" style="border-radius: 50%;">
              </div>
              <span class="username">
                <div class="menu">
                  <a data-menu="marks" href="#" style="color: white">Clicca qui</a>
                </div>
              </span>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="head">
            <span class="icon">
              <i class="fa fa-calendar"></i>
            </span>
            <span class="stat">
              COMPITI
            </span>
          </div>
          <div class="body">
            <h2>Lista dei compiti con Calendar</h2>
            <p>
              In questa sezione troverai la lista dei compiti da svolgere con un calendario.
            </p>
          </div>
          <div class="footer">
            <div class="user">
              <div class="user-icon">
                <img src="{{  asset('assets/img/png-transparent-notebook-blue-adobe-illustrator-notebook-miscellaneous-text-rectangle.png')}}" width="50px" height="50px" alt="" style="border-radius: 50%;">
              </div>
              <span class="username">
                <div class="menu">
                  <a data-menu="compiti" href="#" style="color: white">Clicca qui</a>
                </div>
              </span>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="head">
            <span class="icon">
              <i class="fa fa-address-book"></i>
            </span>
            <span class="stat">
              CONTATTI
            </span>
          </div>
          <div class="body">
            <h2>Contatti dei professori</h2>
            <p>
              Hai bisogno di contattare un professore? Clicca qui per vedere la lista dei professori della tua classe.
            </p>
          </div>
          <div class="footer">
            <div class="user">
              <div class="user-icon">
                <img src="{{  asset('assets/img/Google_Contacts_logo.png')}}" width="50px" height="50px" alt="" style="border-radius: 50%;">
              </div>
              <span class="username">
                <div class="menu">
                  <a data-menu="users" href="#" style="color: white">Clicca qui</a>
                </div>
                  </span>
            </div>
          </div>
        </div>
        <div class="card-verticle">
          <div class="card-small">
            <span class="title">
              Media di {{ $studente->NOME }}
            </span>
            <h2 class="text">{{ round($mediaVoti,2) }}</h2>
            <div class="graph">
              <div class="bar" data-day="sunday">
                <div class="bar-content"></div>
              </div>
              <div class="bar" data-day="monday">
                <div class="bar-content"></div>
              </div>
              <div class="bar" data-day="tuesday">
                <div class="bar-content"></div>
              </div>
              <div class="bar" data-day="wednesday">
                <div class="bar-content"></div>
              </div>
              <div class="bar" data-day="thursday">
                <div class="bar-content"></div>
              </div>
              <div class="bar" data-day="friday">
                <div class="bar-content"></div>
              </div>
              <div class="bar" data-day="saturday">
                <div class="bar-content"></div>
              </div>
            </div>
          </div>
          <div class="card-small" >
            <span class="title">
              Dati di {{ $studente->NOME }}
            </span>
            <div class="icon" style="font-size: 60px; color: #4CAF50; display: flex; justify-content: center; align-items: center;margin-bottom:60px; cursor: pointer;" id="downloadIcon">
              <ion-icon name="person-outline"></ion-icon>
          </div>
          </div>
        </div>
      </div>
      <div class="stats">
      </div>
    </div>





    <!--Contatti Professori INIZIO-->






    <div class="page noflex" data-page="users">
      <div class="header">
        <div class="title">
          <h2>Professori Della {{ $classe[0]->NOME }}</h2>
        </div>
      </div>
      <div class="container_due">
        <ul class="responsive-table">            
          <li class="table-header">
            <div class="col col-1">N.</div>
            <div class="col col-3">Nome</div>
            <div class="col col-3">Cognome</div>
            <div class="col col-3">Materia</div>
            <div class="col col-2">Email</div>
            <div class="col col-4">Telefono</div>
            <div class="col col-1">Contatta</div>
          </li>
          @foreach($professori as $professore)
          <li class="table-row">
            <div class="col col-1" data-label="Job Id">{{ $professore->ID }}</div>
            <div class="col col-3" data-label="Customer Name">{{ $professore->NOME }}</div>
            <div class="col col-3" data-label="Amount">{{ $professore->COGNOME }}</div>
            <div class="col col-3" data-label="Amount">{{ $professore->SPECIALIZZAZIONE }}</div>
            <div class="col col-2" data-label="Amount">{{ $professore->EMAIL }}</div>
            <div class="col col-4" data-label="Payment Status">{{ $professore->TELEFONO }}</div>
            <!-- style="background-color: #4CAF50; color: white; border: none; border-radius: 5px; padding: 10px 20px;  text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;"  -->
            <div class="col col-1" data-label="Payment Status"><a href="{{ route('send.mail_teacher', ['id' => $professore->ID] ) }}" style="background-color: #4CAF50; color: white; border: none; border-radius: 5px; padding: 10px 20px;  text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;">Contatta</a></div>
                   </li>
          @endforeach
        </ul>
      </div>
 <!-- Modal -->
    </div>



<!--Contatti Professori FINE-->



<!--Voti INIZIO-->
<div class="page noflex" data-page="marks">
      <div class="header">
        <div class="title">
          <h2>Voti di {{ $studente->NOME }}: Tabella</h2>
        </div>
      </div>
      <div class="container_due">
        <div class="container-table100">
          <div class="wrap-table100">
          <div class="table100">
          <table>
          <thead>
          <tr class="table100-head">
          <th class="column1">Data</th>
          <th class="column2">Materia</th>
          <th class="column3">Commento</th>
          <th class="column4">Voto</th>
          <th class="column5">Tipo</th>
          <th class="column6">Docente</th>
          </tr>
          </thead>
          <tbody>
            @foreach($voti as $voto)
            @php
                $voto_date = \Carbon\Carbon::createFromFormat('Y-m-d', $voto->DATA);
                $today = \Carbon\Carbon::today();
                $diff_days = $voto_date->diffInDays($today);
        
                // Verifica se il voto è disponibile
                $can_see_vote = $diff_days >= 2;
                $time_remaining = $can_see_vote ? '' : $today->diffInDays($voto_date->addDays(2), false) . ' giorno/i';
            @endphp
        
            <tr>
                <td class="column1">{{ $voto->DATA }}</td>
                <td class="column2">{{ $voto->MATERIA }}</td>
                <td class="column3">
                    @if ($can_see_vote)
                        {{ $voto->DESCRIZIONE }}
                    @else
                        Voto visibile tra: {{ $time_remaining }}
                    @endif
                </td>
                <td class="column4">
                    @if ($can_see_vote)
                        <span style="color: {{ $voto->VALUTAZIONE >= 6 ? 'green' : 'red' }}">{{ $voto->VALUTAZIONE }}</span>
                    @else
                        Voto non disponibile
                    @endif
                </td>
                <td class="column5">{{ $voto->TIPO }}</td>
                <td class="column6">{{ $voto->PROF }} {{ $voto->COGNOME }}</td>
            </tr>
        @endforeach
        

        
        
          </tbody>
          </table>

          </div>
          </div>
          </div>
      </div>
      <div class="header">
        <div class="title">
          <h2>Media Voti: Grafico</h2>
        </div>
      </div>
      <div class="container_due">
      <div style="width: 800px; height: 400px;">
        <canvas id="bar-chart"></canvas>
    </div>
      </div>
 <!-- Modal -->
    </div>
<!--Voti FINE-->







    <div class="page noflex" data-page="compiti">
      <div class="header">
        <div class="title">
          <h2>Compiti da svolgere</h2>
        </div>
      </div>
      <div class="container_due" id="calendar-container">
      </div>
    </div>






    <div class="page noflex" data-page="chat">
      <div class="header">
          <div class="title">
              <h2>Chat</h2>
          </div>
      </div>
      <div class="--dark-theme" id="chat">
        <div class="chat__conversation-board">

          <!-- AI PRIMO MESS -->
          <div class="chat__conversation-board__message-container">
            <div class="chat__conversation-board__message__person">
              <div class="chat__conversation-board__message__person__avatar"><img src="https://futureoflife.org/wp-content/uploads/2015/11/artificial_intelligence_benefits_risk.jpg" alt="Monika Figi"/></div><span class="chat__conversation-board__message__person__nickname">Monika Figi</span>
            </div>
            <div class="chat__conversation-board__message__context">
              <div class="chat__conversation-board__message__bubble"> <span>Ciao sono Levap, ti aiuterò con i tuoi compiti</span></div>
            </div>
            <div class="chat__conversation-board__message__options">
              <button class="btn-icon chat__conversation-board__message__option-button option-item emoji-button">
                <svg class="feather feather-smile sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="12" r="10"></circle>
                  <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                  <line x1="9" y1="9" x2="9.01" y2="9"></line>
                  <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
              </button>
              <button class="btn-icon chat__conversation-board__message__option-button option-item more-button">
                <svg class="feather feather-more-horizontal sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="12" r="1"></circle>
                  <circle cx="19" cy="12" r="1"></circle>
                  <circle cx="5" cy="12" r="1"></circle>
                </svg>
              </button>
            </div>
          </div>


          <!-- UTENTE PRIMO MESS -->
          {{-- <div class="chat__conversation-board__message-container reversed">
            <div class="chat__conversation-board__message__person">
              <div class="chat__conversation-board__message__person__avatar"><img src="https://randomuser.me/api/portraits/men/9.jpg" alt="Dennis Mikle"/></div><span class="chat__conversation-board__message__person__nickname">Dennis Mikle</span>
            </div>
            <div class="chat__conversation-board__message__context">
              <div class="chat__conversation-board__message__bubble"> <span>Winamp's still an essential.</span></div>
            </div>
            <div class="chat__conversation-board__message__options">
              <button class="btn-icon chat__conversation-board__message__option-button option-item emoji-button">
                <svg class="feather feather-smile sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="12" r="10"></circle>
                  <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                  <line x1="9" y1="9" x2="9.01" y2="9"></line>
                  <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
              </button>
              <button class="btn-icon chat__conversation-board__message__option-button option-item more-button">
                <svg class="feather feather-more-horizontal sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="12" r="1"></circle>
                  <circle cx="19" cy="12" r="1"></circle>
                  <circle cx="5" cy="12" r="1"></circle>
                </svg>
              </button>
            </div>
          </div> --}}
        </div>
        <div class="chat__conversation-panel">
          <div class="chat__conversation-panel__container">
            <div id="input-container">
              <input type="text" id="user-input" placeholder="Scrivi il tuo messaggio..." class="chat__conversation-panel__input panel-item">
              <button id="send-button" class="chat__conversation-panel__send-button panel-item">Invia</button>
            </div>
          </div>
        </div>
        
      {{-- <div class="container_due" >
        <div id="chat-container">
          <!-- Messages will be appended here dynamically using JavaScript -->
      </div> --}}
      
         
        
      </div>
      </div>

  











    <div class="page noflex" data-page="about">
      <div class="header">
        <div class="title">
          <h2>About</h2>
        </div>
      </div>
      <div class="info-container">
        <div class="info">
          <a href="http://uplusion23.net/" target="_blank">Developer</a>
          <span>pavelux00</span>
        </div>
        <div class="info">
          <a href="#" target="_blank">Versione di Laravel usata</a>
          <span>10.43.0</span>
        </div>
      </div>
    </div>
  </div>
  <div class="sidebar">

  </div>
 <div class="dialog">
    <div class="dialog-block">
      <h2>Sei sicuro di voler uscire?</h2>
      <div class="controls">
        <a href="{{ route('logout.student')}}" class="button">Esci</a>
        <a data-dialog-action="cancel" href="#" class="button">Indietro</a>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar-container');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'it',
          initialView: 'dayGridMonth',
          events: [ 
              {
                  title: 'Saggio di Storia',
                  start: '2024-02-16',
                  end: '2024-02-16',
                  description: 'Scrivere un saggio di 5 pagine sull\'Impero Romano.'
              },
              {
                  title: 'Compiti di Matematica',
                  start: '2024-02-20',
                  end: '2024-02-20',
                  description: 'Risolvere i problemi del Capitolo 5.'
              },
              {
                  title: 'Presentazione di Scienze',
                  start: '2024-02-28',
                  description: 'Preparare una presentazione sull\'ecosistema.'
              }
          ],
          eventClick: function(info) {
            info.jsEvent.stopPropagation(); // Add this line
            const event = info.event;

// Create the popup element
const popup = document.createElement('div'); 
popup.classList.add('event-popup'); // Assign the CSS class
popup.innerHTML = `
  <h2>${event.title}</h2> 
  <p>${event.extendedProps.description}</p> 
`;
        
// Position the popup correctly
popup.style.left = `${info.jsEvent.pageX + 10}px`; 
popup.style.top = `${info.jsEvent.pageY + 10}px`;
popup.style.display = 'block';  
// Add the popup to the DOM
document.body.appendChild(popup); 

              function handleClickOutside(event) {
                  if (!popup.contains(event.target)) { 
                      popup.remove(); 
                      document.removeEventListener('click', handleClickOutside);
                  }
              }
              document.addEventListener('click', handleClickOutside); 
          }
      });
      calendar.render();
  });
</script>
  
<script>
  // Dichiara array per le etichette e i dati del grafico
  var labels = [];
  var data = [];

  // Calcola la media dei voti solo per i voti disponibili
  @foreach($voti as $voto)
      @php
          $voto_date = \Carbon\Carbon::createFromFormat('Y-m-d', $voto->DATA);
          $today = \Carbon\Carbon::today();
          $diff_days = $voto_date->diffInDays($today);

          // Verifica se il voto è disponibile
          $can_see_vote = $diff_days >= 2;
      @endphp

      @if ($can_see_vote)
          labels.push("{{ $voto->MATERIA }}");
          data.push({{ $voto->VALUTAZIONE }});
      @endif
  @endforeach

  // Calcola la media dei voti
  var sum = data.reduce((a, b) => a + b, 0);
  var avg = sum / data.length;

  // Imposta il colore della colonna in base alla media dei voti
  var backgroundColor = avg >= 6 ? 'rgba(75, 192, 192, 0.2)' : 'rgba(255, 99, 132, 0.2)';
  var borderColor = avg >= 6 ? 'rgba(75, 192, 192, 1)' : 'rgba(255, 99, 132, 1)';

  // Crea il grafico utilizzando Chart.js
  var ctx = document.getElementById('bar-chart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
              label: 'Media Voti',
              data: data,
              backgroundColor: backgroundColor,
              borderColor: borderColor,
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script><script  src="{{ asset('assets/js/script_dashboardstudente.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@fullcalendar/core/locales/it.js"></script>
<script>
  document.getElementById('downloadIcon').addEventListener('click', function() {
      fetch('/generate-pdf') // Adjust the route as needed
          .then(response => response.blob())
          .then(blob => {
              // Create a temporary link to download the file
              const url = window.URL.createObjectURL(new Blob([blob]));
              const link = document.createElement('a');
              link.href = url;
              link.setAttribute('download', 'user_data.pdf'); 
              document.body.appendChild(link);
              link.click();
              link.parentNode.removeChild(link); 
          });
  });
</script>
<script src="{{ asset('assets/js/app.js') }}"></script>





</body>
</html>

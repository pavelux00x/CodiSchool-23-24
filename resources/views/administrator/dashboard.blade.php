<html>
<head>
    <style>
        .selectpicker option
        {
                border: none;
                background-color: white;
                outline: none;
                -webkit-appearance: none;
                -moz-appearance : none;
                color: #14B1B2;
                font-weight: bold;
                font-size: 30px;
                margin: 0;
                padding-left: 0;
                margin-top: -20px;
                background: none;
            }
        select.selectpicker
        {
                border: none;
                background-color: white;
                outline: none;
                -webkit-appearance: none;
                -moz-appearance : none;
                color: #14B1B2;
                font-weight: bold;
                font-size: 30px;
                margin: 0;
                padding-left: 0;
                margin-top: -20px;
                background: none;
            }</style>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>  

Ciao
{{ $admin->username }}

<a href="{{ route('logout.admin') }}">Logout</a>



Studenti:
<html>
  <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  </head>

  
<div class="container">
    <div class="row-fluid">
        
        <br>
        <div class="box">
        <select class="selectpicker des" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
    @foreach($studenti as $student)
            <option value="{{ $student->ID }}">{{ $student->NOME }} {{ $student->COGNOME }}</option>
    @endforeach
        </select>
            </div>
     
    </div>
</div>
<div id="marks"></div>


<script>
    $(document).ready(function() {
        $('.selectpicker').change(function() {
            var studentId = $(this).val();
            $.ajax({
                url: '/api/students/' + studentId,
                method: 'GET',
                success: function(response) {
       
                    console.log(response);
                    var marks = response;
                    if(marks.length == 0){
                        $('#marks').html('Nessun voto trovato');
                        return;
                    }
                    var html = '<table class="table table-bordered"><thead><tr><th>VALUTAZIONE</th><th>DATA</th><th>TIPO</th><th>DESCRIZIONE</th></tr></thead><tbody>';
                    for (var i = 0; i < marks.length; i++) {
                        html += '<tr><td>' + marks[i].VALUTAZIONE + '</td><td>' + marks[i].DATA + '</td><td>' + marks[i].TIPO + '</td><td>' + marks[i].DESCRIZIONE + '</td></tr>';
                    }
                    html += '</tbody></table>';
                    $('#marks').html(html);


                },
                error: function(error) {
                    // Handle the error here
                    console.log(error);
                }
            });
        });
    });
</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
</html>
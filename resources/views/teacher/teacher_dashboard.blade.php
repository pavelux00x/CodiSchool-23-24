<html>
Ciao {{ $teacher->cod_login }} {{ $teacher->COGNOME }}!
Prima di inziare a lavorare, seleziona una classe:
<form action="{{ route('teacher.dashboard_class') }}" method="POST">
    @csrf
    <select name="classe" required>
        <option value="" disabled selected >Seleziona una classe</option>
        @foreach ($classe as $class)
            <option value="{{ $class->NOME }}">{{ $class->NOME }}</option>
        @endforeach
    </select>
    <button type="submit" name="bottone">Seleziona</button>
</form>
<a href="{{ route('logout.teacher') }}">Logout</a>

{{-- <br>
Studenti iscritti al corso:
<ul>
    @foreach ($students as $student)
        <li>{{ $student->NOME }} {{ $student->COGNOME }}</li>
    @endforeach
</ul>
<br>
Voti assegnati:
<ul>
    @foreach ($marks as $grade)
        <li>{{ $grade->VALUTAZIONE }} a {{ $grade->NOME }} {{ $grade->COGNOME }} {{ $grade->DATA }} {{ $grade->TIPO }}</li>
    @endforeach
</ul>
<br>
Inserisci un voto:
<form action="{{ route('insert.mark') }}" method="POST">
    @csrf
    <select name="student" required>
        <option value="" disabled selected >Seleziona uno studente</option>
        @foreach ($students as $student)
            <option value="{{ $student->ID }}">{{ $student->NOME }} {{ $student->COGNOME }}</option>
        @endforeach
    </select>
    <input type="number" name="mark" placeholder="Voto" required min="0" max="10" required>
    <select name="tipo" required>
        <option value="" disabled selected >Seleziona un tipo di valutazione</option>
        <option value="scritto">Scritto</option>
        <option value="orale">Orale</option>
    </select>
    <button type="submit">Inserisci</button>
</form>
<br>
Assegna un compito:
<form action="{{ route('insert.homework') }}" method="POST">
@csrf
<select name="classe" required>
    <option value="" disabled selected >Seleziona una classe</option>
    @foreach ($classe as $class)
        <option value="{{ $class->ID }}">{{ $class->NOME }}</option>
    @endforeach
</select>
    <input type="text" name="materia" required placeholder="Materia">
    <input type="text" name="compito" placeholder="Compito" required>
    <button type="submit">Assegna</button>
</form>

<a href="{{ route('logout.teacher') }}">Logout</a> --}}
</html>

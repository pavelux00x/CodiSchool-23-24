Ciao
Studenti:

@foreach ($students as $student)
    {{ $student->NOME }} {{ $student->COGNOME }}
@endforeach

Voti:
<ul>
@foreach ($marks as $grade)
    <li>{{ $grade->VALUTAZIONE }} a {{ $grade->NOME }} {{ $grade->COGNOME }} {{ $grade->DATA }} {{ $grade->TIPO }}</li>
@endforeach
</ul>

Classe:
{{ $classe }}

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
    <input type="hidden" name="classe" value="{{ $classe }}">
    <select name="tipo" required>
        <option value="" disabled selected >Seleziona un tipo di valutazione</option>
        <option value="scritto">Scritto</option>
        <option value="orale">Orale</option>
    </select>
    <button type="submit">Inserisci</button>
</form>

Inserisci un compito:
<form action="{{ route('insert.homework') }}" method="POST">
    @csrf
    <select name="materia" required>
        <option value="" disabled selected >Seleziona una materia</option>
        @foreach ($materie as $subject)
            <option value="{{ $subject->NOME }}">{{ $subject->NOME }}</option>
        @endforeach
    <input type="text" name="compito" placeholder="Compito" required>
    <input type="hidden" name="classe" value="{{ $classe }}">
    <button type="submit">Inserisci</button>
</form>





Logout:
<form action="{{ route('logout.teacher') }}" method="GET">
    @csrf
    <button type="submit">Logout</button>
</form>
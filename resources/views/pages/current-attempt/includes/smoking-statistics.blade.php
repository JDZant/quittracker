<div class="card-header text-center">
    <h5>Smoking statistics</h5>
</div>
<div class="card-body">
    <table class="table table-striped table-bordered">
        <tbody>
        <tr>
            <td>Cigarettes not smoked since</td>
            <td>{{ $cigarettesNotSmokedSince }}</td>
        </tr>
        <tr>
            <td>Nicotine not inhaled since</td>
            <td>{{ $nicotineNotInhaledSince }} (mg)</td>
        </tr>
        <tr>
            <td>Tar not inhaled since</td>
            <td>{{ $tarNotInhaledSince }} (mg)</td>
        </tr>
        <tr>
            <td>Packets not bought since</td>
            <td>{{ $packetsNotBoughtSince }}</td>
        </tr>
        <tr>
            <td>Money not spent on cigarettes</td>
            <td>{{ $moneyNotSpentOnCigarettesSince }} (€)</td>
        </tr>
        </tbody>
    </table>
</div>

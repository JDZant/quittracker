<!-- Smoking Profile -->
<div class="card-header text-center">
    <h5>Smoking profile</h5>
</div>
<div class="card-body">
    <table class="table table-striped table-bordered">
        <tbody>
        <tr>
            <td>Cigarettes Per day</td>
            <td>{{ $activeAttempt->smokingData->cigarettes_per_day }}</td>
        </tr>
        <tr>
            <td>Nicotine per cigarrette (mg)</td>
            <td>{{ $activeAttempt->smokingData->nicotine_per_cigarette }}</td>
        </tr>
        <tr>
            <td>Tar per cigarrette (mg)</td>
            <td>{{ $activeAttempt->smokingData->tar_per_cigarette }}</td>
        </tr>
        <tr>
            <td>Cigarette per pack</td>
            <td>{{ $activeAttempt->smokingData->cigarettes_per_pack }}</td>
        </tr>
        <tr>
            <td>Cost per pack (€)</td>
            <td>{{ $activeAttempt->smokingData->cost_per_pack }}</td>
        </tr>
        </tbody>
    </table>
</div>



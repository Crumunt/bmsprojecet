<!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $building_data->building_name }}</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<style>
    #map {
        height: 300px;
        width: 100%;
    }
</style>

<body>

    <div class="container">
        <h1 class="p-2 text-uppercase">Building Report</h1>
        <table class="table table-primary" style="width: 100%; border-collapse: collapse;">
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px; border: 1px solid black; text-align: left;">Building Name: </th>
                <td style="padding: 8px; border: 1px solid black;">{{ $building_data->building_name }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px; border: 1px solid black; text-align: left;">Contractor Name: </th>
                <td style="padding: 8px; border: 1px solid black;">{{ $building_data->contractor_name }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px; border: 1px solid black; text-align: left;">Building Location: </th>
                <td style="padding: 8px; border: 1px solid black;" id="building_location">
                    {{ $building_data->building_location }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px; border: 1px solid black; text-align: left;">Allocated Budget: </th>
                <td style="padding: 8px; border: 1px solid black;">{{ $building_data->budget }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px; border: 1px solid black; text-align: left;">Starting Date: </th>
                <td style="padding: 8px; border: 1px solid black;">{{ $building_data->starting_date }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px; border: 1px solid black; text-align: left;">Ending Date: </th>
                <td style="padding: 8px; border: 1px solid black;">{{ $building_data->end_date }}</td>
            </tr>
        </table>

        <h1>Task Report</h1>
        <table class="table table-primary" style="width: 100%; border-collapse: collapse; margin-bottom: 2rem;">
            @foreach ($building_data['tasks'] as $task)
                <tr style="background-color: #f2f2f2;">
                    {{-- <th style="padding: 8px; border: 1px solid black; text-align: left;">Task: </th> --}}
                    <td style="padding: 8px; border: 1px solid black;">{{ $task->task_name }}</td>
                    <th style="padding: 8px; border: 1px solid black; text-align: left;">Target: </th>
                    <td style="padding: 8px; border: 1px solid black;">{{ $task->task_percentage }}</td>
                    <th style="padding: 8px; border: 1px solid black; text-align: left;">Percentage Completed: </th>
                    <td style="padding: 8px; border: 1px solid black;">{{ $task->percentage_completed }}</td>
                </tr>
            @endforeach
        </table>
        <span style="font-weight: bold">Completion Rate: {{$building_data->completion_rate}}</span>

    </div>

</body>

</html>

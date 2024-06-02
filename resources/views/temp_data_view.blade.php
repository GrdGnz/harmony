<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Table Data</title>
</head>
<body>
    <h1>Temporary Table Data</h1>

    @if ($data->isEmpty())
        <p>No data found.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>SF_NO</th>
                    <th>DOC_ID</th>
                    <th>ITEM_NO</th>
                    <th>AL_CODE</th>
                    <th>FLIGHT_NUM</th>
                    <th>DEPT_CITY</th>
                    <th>DEPT_DATE</th>
                    <th>DEPT_TIME</th>
                    <th>ARVL_CITY</th>
                    <th>ARVL_DATE</th>
                    <th>ARVL_TIME</th>
                    <th>SERVICE_CLASS</th>
                    <th>STATUS</th>
                    <th>SEG_CURR_CODE</th>
                    <th>SEG_CURR_RATE</th>
                    <th>SEG_AMOUNT</th>
                    <th>MILEAGE</th>
                    <th>STOP_OVER_1</th>
                    <th>STOP_OVER_2</th>
                    <th>STOP_OVER_3</th>
                    <th>MEAL_CODE_1</th>
                    <th>MEAL_CODE_2</th>
                    <th>MEAL_CODE_3</th>
                    <th>SEAT_CODE_1</th>
                    <th>SEAT_CODE_2</th>
                    <th>SEAT_CODE_3</th>
                    <th>EQUIPMENT</th>
                    <th>ORIGIN</th>
                    <th>FARE_BASIS</th>
                    <th>UPDATE_SOURCE</th>
                    <!-- Add headers for other columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $row->SF_NO }}</td>
                        <td>{{ $row->DOC_ID }}</td>
                        <td>{{ $row->ITEM_NO }}</td>
                        <td>{{ $row->AL_CODE }}</td>
                        <td>{{ $row->FLIGHT_NUM }}</td>
                        <td>{{ $row->DEPT_CITY }}</td>
                        <td>{{ $row->DEPT_DATE }}</td>
                        <td>{{ $row->DEPT_TIME }}</td>
                        <td>{{ $row->ARVL_CITY }}</td>
                        <td>{{ $row->ARVL_DATE }}</td>
                        <td>{{ $row->ARVL_TIME }}</td>
                        <td>{{ $row->SERVICE_CLASS }}</td>
                        <td>{{ $row->STATUS }}</td>
                        <td>{{ $row->SEG_CURR_CODE }}</td>
                        <td>{{ $row->SEG_CURR_RATE }}</td>
                        <td>{{ $row->SEG_AMOUNT }}</td>
                        <td>{{ $row->MILEAGE }}</td>
                        <td>{{ $row->STOP_OVER_1 }}</td>
                        <td>{{ $row->STOP_OVER_2 }}</td>
                        <td>{{ $row->STOP_OVER_3 }}</td>
                        <td>{{ $row->MEAL_CODE_1 }}</td>
                        <td>{{ $row->MEAL_CODE_2 }}</td>
                        <td>{{ $row->MEAL_CODE_3 }}</td>
                        <td>{{ $row->SEAT_CODE_1 }}</td>
                        <td>{{ $row->SEAT_CODE_2 }}</td>
                        <td>{{ $row->SEAT_CODE_3 }}</td>
                        <td>{{ $row->EQUIPMENT }}</td>
                        <td>{{ $row->ORIGIN }}</td>
                        <td>{{ $row->FARE_BASIS }}</td>
                        <td>{{ $row->UPDATE_SOURCE }}</td>
                        <!-- Add cells for other columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>

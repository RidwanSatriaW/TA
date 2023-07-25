<!DOCTYPE html>
<html>
<head>
    <title>Laporan Visitor</title>
    <style>
        /* Gaya CSS khusus untuk laporan */
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .highlight-feedback {
            border: 2px solid yellow;
        }

        .highlight-first-scan {
            border: 2px solid orange;
        }
        @page {
            size: landscape;
        }
        @media print {
            body {
                transform: rotate(90deg);
                transform-origin: left top;
                width: 100vh;
                position: absolute;
                overflow-x: hidden;
                top: 0;
                left: 0;
            }
        }
    </style>
</head>
<body>
    <h1>Laporan Data Visitor</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email/Mobile Number</th>
                <th>Address</th>
                <th>Enter Time</th>
                <th>Out Time</th>
                <th class="highlight-first-scan">First Scan</th>
                <th class="highlight-feedback">Feedback</th>
                <th>Meet Person</th>
                <th>Necessity</th>
                <th>Enter By</th>
              </tr>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{$data->visitors->visitor_name}}</td>
                <td>
                    <div style="display: block;">{{$data->visitors->visitor_email}}</div>
                    <div style="display: block;">{{$data->visitors->visitor_mobile_no}}</div>
                </td>
                <td>{{$data->visitors->visitor_address}}</td>
                <td>{{$data->visitor_enter_time}}</td>
                <td>{{$data->visitor_out_time}}</td>
                <td class="highlight-first-scan">{{$data->first_emotion}}</td>
                <td class="highlight-feedback">{{$data->feedback}}</td>
                <td>{{ $data->availables->employees->employee_name }} ( {{ $data->availables->employees->departments->department_name }} )</td>
                <td>{{ $data->availables->necessities->keperluan_name }}</td>
                <td>{{$data->users->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
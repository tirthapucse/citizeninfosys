<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .print-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        .print-container h2 {
            text-align: center;
            color: #333;
        }
        .print-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .print-container table, .print-container th, .print-container td {
            border: 1px solid #000;
        }
        .print-container th, .print-container td {
            padding: 10px;
            text-align: left;
        }
        .print-container th {
            background-color: #f2f2f2;
        }
        .print-button {
            text-align: center;
            margin-top: 20px;
        }
        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
        .print-button button:hover {
            background-color: #0056b3;
        }
        .map-link {
            margin-top: 20px;
        }
        .map-link a {
            color: #007bff;
            text-decoration: none;
        }
        .map-link a:hover {
            text-decoration: underline;
        }
        .map-preview {
            margin-top: 20px;
        }
        .map-preview iframe {
            width: 100%;
            height: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="print-container">
        <h2>User Details</h2>
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $user->full_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ ucfirst($type) }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->user->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $user->phone ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>National ID</th>
                <td>{{ $user->national_id ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Passport Number</th>
                <td>{{ $user->passport_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>{{ $user->gender ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $user->address ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $user->city ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Profession</th>
                <td>{{ $user->profession ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Marital Status</th>
                <td>{{ $user->marital_status ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Religion</th>
                <td>{{ $user->religion ?? 'N/A' }}</td>
            </tr>
            @if($type === 'tenant')
                <tr>
                    <th>User Type</th>
                    <td>{{ $user->user_type ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Current Property</th>
                    <td>
                        @if($user->rent && $user->rent->property)
                            {{ $user->rent->property->building_name ?? 'N/A' }}, 
                            {{ $user->rent->property->building_address ?? 'N/A' }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @elseif($type === 'homeowner')
                <tr>
                    <th>Properties Owned</th>
                    <td>
                        @if($user->properties && $user->properties->count() > 0)
                            <ul>
                                @foreach($user->properties as $property)
                                    <li>
                                        {{ $property->building_name ?? 'N/A' }}, 
                                        {{ $property->building_address ?? 'N/A' }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endif
        </table>

        <!-- Google Map Link Section -->
        @if($type === 'tenant' && $user->rent && $user->rent->property && $user->rent->property->google_map_link)
            <div class="map-link">
                <h3>Property Location</h3>
                <table>
                    <tr>
                        <th>Google Map Link</th>
                        <td>
                            <a href="{{ $user->rent->property->google_map_link }}" target="_blank">
                                {{ $user->rent->property->google_map_link }}
                            </a>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Map Preview -->
            <div class="map-preview">
                <h3>Map Preview</h3>
                <iframe
                    src="https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q={{ urlencode($user->rent->property->google_map_link) }}"
                    allowfullscreen>
                </iframe>
            </div>
        @elseif($type === 'homeowner' && $user->properties && $user->properties->count() > 0)
            <div class="map-link">
                <h3>Properties Location</h3>
                <table>
                    @foreach($user->properties as $property)
                        @if($property->google_map_link)
                            <tr>
                                <th>{{ $property->building_name ?? 'N/A' }}</th>
                                <td>
                                    <a href="{{ $property->google_map_link }}" target="_blank">
                                        {{ $property->google_map_link }}
                                    </a>
                                </td>
                            </tr>

                            <!-- Map Preview for Each Property -->
                            <div class="map-preview">
                                <h4>Map Preview for {{ $property->building_name ?? 'N/A' }}</h4>
                                <iframe
                                    src="https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q={{ urlencode($property->google_map_link) }}"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        @endif
                    @endforeach
                </table>
            </div>
        @endif

        <div class="print-button">
            <button onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>
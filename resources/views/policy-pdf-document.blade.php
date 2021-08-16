<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Example 1</title>
            <link rel="stylesheet" href="style.css" media="all" />
        </head>
        <body>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th class="service">Company Details</th>
                            <th class="desc">Policy Name</th>
                            <th>Policy Type Name</th>
                            <th>Policy Number</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td >{{$pdf_data['company_details']}}</td>
                        <td >{{$pdf_data['policy_name']}}</td>
                        <td >{{$pdf_data['policy_type_name']}}</td>
                        <td >{{$pdf_data['policy_number']}}</td>
                        <td >{{$pdf_data['start_date']}}</td>
                        <td >{{$pdf_data['end_date']}}</td>
                        <td >{{$pdf_data['payment_method']}}</td>
                    </tr>
                    
                    </tbody>
                </table>
            </div>
        </body>
</html>
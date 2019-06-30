<!DOCTYPE html>
<html >
    <head>
        <style>
.invoice-title {
    margin-bottom: 0;
    text-transform: uppercase;
    color: #ced4da;
    font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
    font-weight: 700;
}
            body {
                margin: 0;
                font-family: "Roboto", "Helvetica Neue","aealarabiya", Arial, sans-serif;
                font-size: 12px;
                font-weight: 400;
                color: #fffff;
                text-align: left;
            }
            a{
                color: #1b84e7;
                text-decoration: none;

            }
            .pd-30 {
                padding: 30px;
            }
            .center{
                text-align:center;
            }


            b, strong {
                font-weight: bolder;
            }
            div {
                display: block;
            }
            .slim-logo {
                margin-bottom: 10px;
                width:200px;
            }


            .card-profile-name {
                color: #1b84e7;
                font-weight: 700;
                font-size: 16px;
                margin-top:0px;
            }

            .card-profile-position {
                font-size: 12px;
                color: #495057;
            }
        .tx-bold{
            font-weight: 900;
            color: #343a40;
            font-size: 12px;
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
            .media-body .row {
                display: flex;
                flex-wrap: wrap;
                margin-right: -15px;
                margin-left: -15px;
            }
            .section-label-sm{
                color: #1b84e7;
                font-weight: 700;
                font-size: 12px;   
            }
            .tx-danger {
                color: #dc3545;
            }
            .mg-t-20 {
                margin-top: 20px;
            }
            .card-latest-activity .card-body {
                padding: 25px;
            }
            .slim-card-title {
                font-weight: 700;
                font-size: 13px;
                color: #1b84e7;
                letter-spacing: 1px;
                font-weight: bolder;
            }

            table {
                font-family: "Trebuchet MS","aealarabiya", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            .dataTable th{
                font-weight: 700;
                font-size: 10px;
                text-transform: uppercase;
                background-color: gray;
                color: #FFFFFF;
                letter-spacing: 0.5px;
                padding: 20px !important;
                line-height: 10px;
                border-bottom: 1px solid gray;
            }
         

            .card-profile img {
                width: 120px;
                border-radius: 100%;
            }

            .tx-14 {
                font-size: 12px;
            }
            .tx-gray-700 {
                color: #495057;
            }
            .inline {
                display: inline-block;

            }
            .slim-footer {
                margin-top: 50px;
                padding: 0;
            }
            .slim-footer .container {
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 13px;
            }
            .slim-footer .container p {
                margin-bottom: 0;
            }
            .slim-footer .container p:last-child {
                margin-top: 5px;
            }
            .timeline-item {
                display: flex;
                align-items: flex-start;
                justify-content: flex-start;
            }
            .timeline-time {
                display: inline-block;
                flex-shrink: 0;
                text-align: ledt;
                padding-top: 0;
                padding-left: 25px;
                width: 100px;

            }
            
            .timeline-body p {
                margin-top: 0;
            }
            .timeline-body {
                padding-left: 25px;
                padding-bottom: 30px;
                position: relative;
            }
            .timeline-date {
                font-weight: 900;
                color: #343a40;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 0;
            }
            .timeline-type {
                font-weight: 900;
                color: #343a40;
                font-size: 10px;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 0;
            }

            .timeline-title {
                font-weight: 900;
                margin-bottom: 0;
                color: #343a40;
            }
            .timeline-author {
                margin-bottom: 10px;
                font-size: 12px;
                margin-top: 5px !important;
            }
            .invoice-header {
            display: flex;
            justify-content: space-between;
            flex-direction: row-reverse;
        }

            img {
                vertical-align: middle;
                border-style: none;
            }
            .img-fluid {
                max-width: 50%;
                height: auto;
            }
            .billed-to  {
               
                font-weight: 900;
                color: #343a40;
                font-size: 12px;
                margin-bottom: 0;
        
        }
        </style>
    </head>
    <body>
        

        <!-- section-wrapper -->
        @yield('content')
        <!-- section-wrapper -->

        <!-- slim-footer -->
        @include('partials.footer')
    </body>

</html>



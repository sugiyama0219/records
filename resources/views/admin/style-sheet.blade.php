<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<meta name="csrf-token" content="{{ csrf_token() }}"> 

<style>
    body {
        padding-top: 100px;
    }
    th,td {
        text-align: center;
    }
    .custom-bg {
        background-color: #f8f9fa; /* 任意のカラーコード */
    }
    .custom-btn {
        width: 400px;
        height: 100px;
        font-size: 2.0rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #0d6efd; /* Bootstrapのprimary色 */
        color: white;
        text-decoration: none;
        border-radius: 0.375rem; /* Bootstrapのroundedの例 */
    }
    .card {
        width: 1000px;
    }
    
</style>
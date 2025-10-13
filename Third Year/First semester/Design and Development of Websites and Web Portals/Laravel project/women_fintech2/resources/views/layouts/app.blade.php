<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Women in FinTech')</title>

    <style>
        /* Fundal general */
        body {
            background-color: #f4f0f7; /* Mov deschis */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header */
        header {
            background-color: #6a1b9a; /* Mov închis */
            color: white;
            padding: 20px 0;
            text-align: center;
            border-bottom: 3px solid #4e107b;
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        nav a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            color: white;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease;
        }

        nav .btn-primary {
            background-color: #4e107b;
        }

        nav .btn-primary:hover {
            background-color: #7b2cbf;
        }

        nav .btn-success {
            background-color: #28a745;
        }

        nav .btn-success:hover {
            background-color: #218838;
        }

        /* Titlu aliniat și stilizat */
        main h2 {
            text-align: center;
            font-size: 2rem;
            color: #6a1b9a;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Tabele */
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 80%; /* Lățimea maximă a tabelului */
            margin: 0 auto; /* Centrează tabelul */
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 100px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table td, table th {
            padding: 15px 20px;
            text-align: center; /* Centrare conținut */
        }

        table th {
            background-color: #6a1b9a;
            color: #ffffff;
            text-transform: uppercase;
        }

        table tr:hover {
            background-color: #f2e6ff; /* Fundal mov deschis la hover */
        }

        table td .btn {
            display: inline-block;
            margin: 5px; /* Spațiu între butoane */
        }

        /* Formular */
        form {
            max-width: 600px; /* Lățimea maximă a formularului */
            margin: 30px auto; /* Centrează formularul */
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 100px;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #6a1b9a;
        }

        form input, form textarea, form select, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        form button {
            background-color: #6a1b9a;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #7b2cbf;
        }

        /* Paginare */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 60px; /* Mai mult spațiu între paginare și footer */
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a, .pagination span {
            display: block;
            padding: 10px 15px;
            color: #6a1b9a;
            background: #ffffff;
            border: 1px solid #6a1b9a;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 100px;
        }

        .pagination a:hover, .pagination span:hover {
            background: #6a1b9a;
            color: #ffffff;
        }

        /* Butoane */
        .btn {
            border-radius: 5px;
            padding: 10px 15px;
            text-transform: uppercase;
            font-weight: bold;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 10px 20px; /* Dimensiune buton ajustată */
            font-size: 0.9rem;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        /* Footer */
        footer {
            background: #6a1b9a;
            color: white;
            text-align: center;
            padding: 10px 20px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            font-size: 0.9rem;
        }
        /* Titlu */
        h2 {
            font-size: 2rem;
            text-align: center;
            color: #6a1b9a;
            margin-top: 20px;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        /* Buton "Add Success Story" */
        a.btn-add-story {
            display: inline-block;
            margin: 0 auto 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        a.btn-add-story:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        /* Carduri pentru povești */
        .success-story-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 100px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-align: left;
        }

        .success-story-card h3 {
            font-size: 1.5rem;
            color: #6a1b9a;
            margin-bottom: 10px;
        }

        .success-story-card p {
            font-size: 1rem;
            color: #333333;
            line-height: 1.6;
        }
        .delete-form {
            display: inline-block;
            margin-top: 10px;
        }

        .btn-danger {
            background-color: #d9534f;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }


    </style>
</head>
<body>
<header>
    <h1>Women in FinTech Platform</h1>
    <nav>
        <a href="{{ route('members.index') }}" class="btn btn-primary">Members</a>
        <a href="{{ route('members.create') }}" class="btn btn-success">Add Member</a>
        <a href="{{ route('events.index') }}" class="btn btn-primary">Events</a>

    </nav>
</header>

<main>
    <!-- Această secțiune marchează conținutul principal al paginii -->
    <h2>
        <!-- Yield 'title' este o secțiune definită dinamic în alte view-uri -->
        <!-- Dacă secțiunea 'title' nu este definită, se folosește valoarea implicită 'Members' -->
        @yield('title', 'Members')
    </h2>
    <div class="container">
        <!-- Yield 'content' este o secțiune care conține conținutul principal specific fiecărui view -->
        <!-- Acest conținut va fi definit în view-urile care extind acest layout -->
        @yield('content')
    </div>
</main>


<footer>
    <p>&copy; 2024 Women in FinTech. All Rights Reserved.</p>
</footer>
</body>
</html>

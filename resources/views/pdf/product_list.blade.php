<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Factures</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        @media only screen and (max-width: 600px) {
            table {
                border: 0;
            }
            table thead {
                display: none;
            }
            table tbody td {
                display: block;
                padding: 8px;
                border-bottom: 1px solid #ddd;
            }
            table tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
            }
        }
    </style>
</head>
<body>
    <h1>Liste des Factures</h1>
<table border="1">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Titre</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Prix Total</th>
            <th>Date</th>
            <th>Description</th>
            <th>État</th> <!-- Nouvelle colonne pour l'état -->
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->quantite }}</td>
                <td>{{ $product->price_uni }}</td>
                <td>{{ $product->price_total }}</td>
                <td>{{ $product->date_de_facture }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->etat }}</td> <!-- Affichage de l'état -->
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>

<?php
// Process ticket orders from tickets.html form

// Helper function to sanitize output
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $games = $_POST['games'] ?? [];

    if ($name === '' || $email === '') {
        die("<p class='alert alert-danger m-4'>Please provide both your name and email. <a href='tickets.html'>Go back</a></p>");
    }

    if (empty($games)) {
        die("<p class='alert alert-warning m-4'>No games selected. Please <a href='tickets.html'>choose at least one game</a>.</p>");
    }

    $grand_total = 0;
    $order_rows = '';

    foreach ($games as $game) {
        $qty_key = $game . '_qty';
        $price_key = $game . '_price';

        $qty = intval($_POST[$qty_key] ?? 0);
        $price = floatval($_POST[$price_key] ?? 0);

        if ($qty > 0 && $price > 0) {
            $subtotal = $qty * $price;
            $grand_total += $subtotal;

            // Friendly game name
            $game_name = ucwords(str_replace('_', ' ', $game));

            $order_rows .= "<tr>
                <td>" . h($game_name) . "</td>
                <td>$qty</td>
                <td>$" . number_format($price, 2) . "</td>
                <td>$" . number_format($subtotal, 2) . "</td>
            </tr>";
        }
    }

    // If no quantities > 0, prompt user
    if ($grand_total == 0) {
        die("<p class='alert alert-warning m-4'>You selected games but did not specify ticket quantities greater than zero. <a href='tickets.html'>Go back</a>.</p>");
    }
} else {
    // If accessed directly without POST
    die("<p class='alert alert-danger m-4'>Invalid request method. Please submit the form. <a href='tickets.html'>Back to Tickets</a></p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lake Ukickee Soccer - Order Summary</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="tickets.css" rel="stylesheet" />
</head>
<body>

  <!-- Top image with overlay text -->
  <div class="top-image-container">
    <img src="images/bleacher.png" alt="Bleacher Seating" />
    <div class="overlay-text">Lake Ukickee Soccer</div>
  </div>

  <!-- Navbar -->
  <div class="navbar-center">
    <div id="navbar-container" class="w-100"></div>
  </div>

  <main class="container my-4">
    <h2>Order Summary</h2>
    <p><strong>Name:</strong> <?= h($name) ?></p>
    <p><strong>Email:</strong> <?= h($email) ?></p>

    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th>Game</th>
            <th>Quantity</th>
            <th>Price per Ticket</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?= $order_rows ?>
          <tr>
            <td colspan="3" class="text-end fw-bold">Grand Total</td>
            <td class="fw-bold">$<?= number_format($grand_total, 2) ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <p class="mt-4">
      <strong>Thank you, <?= h($name) ?>, for purchasing Lake Ukickee Soccer tickets!  </strong> Above please find a summary of your order. Tickets will be held at the box office until one hour before game time!  A reminder will be sent to you at email address <?= h($email) ?> one week in advance of the game.
    </p>
    <p>
      <a href="tickets.html" class="btn btn-primary">Back to Ticket Purchase</a>
    </p>
  </main>

  <!-- Footer -->
  <footer class="text-center py-3">
    Copyright 2025 Lake Ukickee Soccer
  </footer>

  <!-- Bootstrap JS and Navbar loader -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="nav-module.js"></script>
  <script>
    loadNavbar("tickets");
  </script>
</body>
</html>

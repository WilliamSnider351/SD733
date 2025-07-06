// nav-module.js
document.addEventListener("DOMContentLoaded", function () {
  const navbarHTML = `
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand d-lg-none" href="#">Menu</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="photos.html">Photos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="rules.html">Rules</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tickets.html">Tickets</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="findus.html">Find Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="schedule.html">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sponsors.html">Sponsors</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  `;

  const container = document.getElementById("navbar-container");
  if (container) {
    container.innerHTML = navbarHTML;
  }
});

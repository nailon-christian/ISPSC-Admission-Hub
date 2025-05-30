<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Enrollment Dashboard</title>
  <link rel="stylesheet" href="styles.css" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
  <!-- Fixed Top Header -->
  <header class="top-header">
    <div class="logo">📚 Enrollment Portal</div>
    <div class="header-right">
      <div class="welcome">Hi, <?php echo $_SESSION['username']; ?>!</div>
      <div class="profile">
        <img src="https://i.pravatar.cc/40" alt="Profile" />
        <span class="username"></span>
      </div>
      <button class="icon-btn" title="Settings">
        <i class="fas fa-cog"></i>
      </button>
    </div>
  </header>

  <div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar">
      <ul>
        <li class="sidebar-item active" data-section="requirements">Requirements</li>
        <li class="sidebar-item" data-section="schedule">Schedule</li>
        <li class="sidebar-item" data-section="announcements">Announcements</li>
        <li class="sidebar-item" data-section="stats">Enrollment Stats</li>
      </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Admission Requirements -->
      <section id="requirements" class="content-section active-section">
        <h2>📋 Admission Requirements</h2>
        <ul class="requirements-list">
          <li>✅ Form 138 (Report Card)</li>
          <li>✅ PSA Birth Certificate</li>
          <li>✅ Certificate of Good Moral Character</li>
          <li>✅ 2x2 Recent ID Pictures (2 pcs)</li>
          <li>✅ Barangay Clearance</li>
          <li>✅ Honorable Dismissal (if transferee)</li>
          <li>✅ Medical Certificate</li>
        </ul>
      </section>

      <!-- Schedule -->
      <section id="schedule" class="content-section">
        <h2>📆 Schedule</h2>
        <table>
          <tbody>
            <tr><td>📅 Start of Admission</td><td>June 1, 2025</td></tr>
            <tr><td>📅 Deadline for Submission</td><td>July 15, 2025</td></tr>
            <tr><td>📅 Interview Schedule</td><td>July 20–25, 2025</td></tr>
            <tr><td>📅 Release of Results</td><td>August 1, 2025</td></tr>
          </tbody>
        </table>
      </section>

      <!-- Announcements -->
      <section id="announcements" class="content-section">
        <h2>📢 Announcements</h2>
        <p>Please check back regularly for updates regarding enrollment and orientation schedules.</p>
      </section>

      <!-- ✅ UPDATED Enrollment Stats with Database -->
      <section id="stats" class="content-section">
        <h2>📊 Enrollment Statistics</h2>
        <?php
        $sql = "SELECT * FROM stats LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total = $row['total_enrolled'];
            $new = $row['new_students'];
            $transferees = $row['transferees'];
            $returnees = $row['returning_students'];
        } else {
            $total = $new = $transferees = $returnees = 0;
        }
        ?>
        <canvas id="enrollmentChart" width="200" height="100"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
          const ctx = document.getElementById('enrollmentChart').getContext('2d');
          const enrollmentChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ['Total Enrollees', 'New Students', 'Transferees', 'Returning Students'],
              datasets: [{
                label: 'Number of Students',
                data: [
                  <?php echo $total; ?>,
                  <?php echo $new; ?>,
                  <?php echo $transferees; ?>,
                  <?php echo $returnees; ?>
                ],
                backgroundColor: [
                  'rgba(75, 192, 192, 0.6)',
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 206, 86, 0.6)',
                  'rgba(255, 99, 132, 0.6)'
                ],
                borderColor: [
                  'rgba(75, 192, 192, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        </script>
      </section>

    </main>
  </div>

  <script>
    const sidebarItems = document.querySelectorAll(".sidebar-item");
    const sections = document.querySelectorAll(".content-section");

    sidebarItems.forEach(item => {
      item.addEventListener("click", () => {
        sidebarItems.forEach(i => i.classList.remove("active"));
        sections.forEach(s => s.classList.remove("active-section"));

        item.classList.add("active");
        const sectionId = item.getAttribute("data-section");
        document.getElementById(sectionId).classList.add("active-section");
      });
    });
  </script>
</body>
</html>

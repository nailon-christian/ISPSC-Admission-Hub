// Show current year in footer
document.getElementById("year").textContent = new Date().getFullYear();

// Total requirements count
const totalReqEl = document.getElementById("totalRequirements");
totalReqEl.textContent = requirementsItems.length;

// Days until deadline for summary card
function updateDaysUntilDeadline() {
  const now = new Date().getTime();
  const distance = deadline - now;
  if (distance < 0) {
    document.getElementById("daysUntilDeadline").textContent = "0";
  } else {
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    document.getElementById("daysUntilDeadline").textContent = days;
  }
}
updateDaysUntilDeadline();
setInterval(updateDaysUntilDeadline, 3600000); // update every hour

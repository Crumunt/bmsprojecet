 // Function to toggle dropdown
 function toggleDropdown(dropdownId) {
    var dropdown = document.getElementById(dropdownId);
    console.log(dropdown)
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}

// Function to search tasks
function searchTasks() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchBar");
    filter = input.value.toUpperCase();
    table = document.getElementById("tasksTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Column number
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

/* para sa prog, schedule */
let schedules = [];

// Schedule functionality
function addSchedule() {
    const scheduleInput = document.getElementById('schedule-input');
    const scheduleList = document.getElementById('schedule-list');
    const scheduleText = scheduleInput.value.trim();

    if (scheduleText === '') {
        alert('Please enter a schedule!');
        return;
    }

    if (schedules.length >= 5) {
        alert('You can only add up to 5 schedules.');
        return;
    }

    schedules.push(scheduleText);
    renderSchedules();
    scheduleInput.value = ''; // Clear input field
}

function renderSchedules() {
    const scheduleList = document.getElementById('schedule-list');
    scheduleList.innerHTML = ''; // Clear the list before rendering

    schedules.forEach((schedule, index) => {
        const li = document.createElement('li');
        li.innerHTML = `${schedule} <button onclick="deleteSchedule(${index})">🗑</button>`;
        scheduleList.appendChild(li);
    });
}

function deleteSchedule(index) {
    schedules.splice(index, 1); // Remove specific schedule
    renderSchedules(); // Re-render the list
}



// Circular progress for each subject
document.querySelectorAll('.circle').forEach(circle => {
    const percent = circle.getAttribute('data-percent');
    circle.style.setProperty('--percent', percent);
});

function filterTasks() {
    const filterValue = document.getElementById("status-filter").value;
    const tasks = document.querySelectorAll("#taskBody tr");

    tasks.forEach(task => {
        const status = task.querySelector("td:nth-child(3)").classList.contains('done') ? 'done' : 'in-progress';

        if (filterValue === 'all' || filterValue === status) {
            task.style.display = ""; // Show task
        } else {
            task.style.display = "none"; // Hide task
        }
    });
}
//sorting ng item lists
function sortTasks(order) {
    const tasksTable = document.getElementById("tasksTable");
    const tbody = tasksTable.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    rows.sort((a, b) => {
        const dateA = new Date(a.querySelector("td:first-child").innerText);
        const dateB = new Date(b.querySelector("td:first-child").innerText);

        if (order === 'recent') {
            return dateB - dateA; // Sort recent dates first
        } else {
            return dateA - dateB; // Sort old dates first
        }
    });

    // Append sorted rows back to the tbody
    rows.forEach(row => tbody.appendChild(row));
}

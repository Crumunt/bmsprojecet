$(document).ready(function () {
    let building_name;
    if ($('#building_name').val()) {
        building_name = $('#building_name').val();
    }

    $('.addTaskButton').click(function (e) {
        e.preventDefault();
        let task_id = $(this).attr('id');

        const task_name = $(`#${task_id}_input`).val();
        const task_target = $(`#${task_id}_target`).val();
        const task_body = `
                    <tr class="task project_task">
                        <td>${task_name}</td>
                        <td>${task_target}</td>
                        <td>
                            <button class="btn btn-danger btn-lg removeTaskButton"><i class="uil uil-trash"></i></button>
                        </td>
                    </tr>
                `

        // get tbody with associated id using data-target attribute of button
        $(`tbody#${task_id}_tasks`).append(task_body)

        // resets add form upon clicking add
        $(`#${task_id}_input`).val('')
        $(`#${task_id}_target`).val('')
    })

    $('.tasks-table').on('click', 'button.removeTaskButton', function (e) {
        e.preventDefault();
        let task_row = $(this).closest('tr.task')

        task_row.remove();
    })


    let isMapInitalized = false;
    let map, lat, lng;

    $('#modalToggle').on('show.bs.modal', function () {

        console.log('location modal has been shown')
        console.log(isMapInitalized)
        if (!isMapInitalized) {
            map = L.map('map')
            map.setView([15.734, 120.930], 15);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            isMapInitalized = true;

            setTimeout(() => {
                map.invalidateSize();
            }, 200);
        }

        let marker;
        map.on('click', function (e) {
            if (marker) {
                map.removeLayer(marker);
            }

            lat = e.latlng.lat;
            lng = e.latlng.lng;

            console.log(lat, lng);

            marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup(
                `You selected this location: ${lat.toFixed(4)}, ${lng.toFixed(4)}`)
                .openPopup();

            $('#building_location').val(`${lat.toFixed(4)}, ${lng.toFixed(4)}`);
        })

    })

})

$('#buildingForm').submit(function () {
    // console.log($('#building_name').val());
    let building_name = $('#building_name').val();

    $('#project_row').append(`
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p class="card-title">${building_name}</p>
                    <div class="btn-group d-flex justify-content-evenly gap-2">
                        <button class="btn btn-primary">View</button>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
                `)
})

let currentStep;

$("#modalToggle [aria-label='Close']").click(function () {
    resetForm(currentStep)
    $("#modalToggle").modal('hide')
})

function resetForm(currentStep) {
    $('#buildingForm').trigger('reset')
    $('.tasks-table tbody').empty();
    if (currentStep >= 1) {
        showCurrentStep();
    }
}

$('.formControlButton').click(function (e) {
    let incrementor;
    const attr = $(this).attr('data-next')

    if (attr !== undefined && attr !== false) {
        incrementor = 1
    } else {
        incrementor = -1
    }

    currentStep += incrementor;

    showCurrentStep();
})

function showCurrentStep() {
    const multiStepForm = $('#buildingForm').get(0)
    const formSteps = [...multiStepForm.querySelectorAll('[data-step]')]
    const nextButton = document.querySelector('[data-next]') ?? null;
    const prevButton = document.querySelector('[data-previous]') ?? null;
    const submitButton = document.querySelector('button[type="submit"]')

    formSteps.forEach((step, index) => {
        step.classList.toggle('d-none');
    })

    prevButton.classList.toggle('d-none')
    nextButton.classList.toggle('d-none')
    submitButton.classList.toggle('d-none')
}

$('#addBuilding').click(function () {
    const building_name = $('#building_name').val();
    const tasks = $('.project_task').length;
    console.log(building_name)
    const project_body = `
             <div class = 'project-card'>
                <div class="project-header">
                    <span class="icon pink-icon"><i class="uil uil-constructor"></i></span>
                    <div class="avatars">
                        <img src="assets/images/avatar1.jpg" alt="User 1">
                        <img src="assets/images/avatar1.jpg" alt="User 2">
                        <img src="assets/images/avatar1.jpg" alt="User 3">
                    </div>
                    <div class="dropdown">
                        <span class="three-dots" onclick="toggleDropdown('dropdown-one')">&#8942;</span>
                        <div class="dropdown-content" id="dropdown-one">
                            <a href="#">View More</a>
                            <a href="#">Update</a>
                            <a href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <h2>${building_name}</h2>
                <p>${tasks} Tasks</p>
                <p class="progress-text">0% Completed</p>

                <div class="progress-container">
                    <div class="progress-bar" style="width: 0%;"></div>
                </div>
            </div>
        `

    resetForm(1);
    $('#project_row').append(project_body);
    $('#modalToggle').modal('hide');
})

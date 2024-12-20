

// $(document).ready(function () {
let building_name;
if ($('#building_name').val()) {
    building_name = $('#building_name').val();
}

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
        document.getElementById('building_location').dispatchEvent(new Event('input'))
    })


})

let isUpdateMapInitialized = false;
let updateMap = null;

$('#updateModal').on('show.bs.modal', function () {
    console.log('update modal has been shown')
    console.log(isUpdateMapInitialized)
    // if (!isUpdateMapInitialized) {
    setTimeout(() => {
        let building_location = $('#update_building_location').val()
        let latlng = building_location.split(',')

        let marker;

        if (!isUpdateMapInitialized) {
            updateMap = L.map('updateMap')

            isUpdateMapInitialized = true;
        }
        updateMap.setView([15.734, 120.930], 15);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(updateMap);


        marker = L.marker([latlng[0], latlng[1]]).addTo(updateMap)

        // setTimeout(() => {
        updateMap.invalidateSize();
        // }, 800);

        updateMap.on('click', function (e) {
            if (marker) {
                updateMap.removeLayer(marker);
            }

            let lat = e.latlng.lat;
            let lng = e.latlng.lng;

            console.log(lat, lng);

            marker = L.marker([lat, lng]).addTo(updateMap);
            marker.bindPopup(
                `You selected this location: ${lat.toFixed(4)}, ${lng.toFixed(4)}`)
                .openPopup();

            $('#update_building_location').val(`${lat.toFixed(4)}, ${lng.toFixed(4)}`);
            document.getElementById('update_building_location').dispatchEvent(new Event(
                'input'))
        })
    }, 500);
    // }

    $('#updateModal').on('hidden.bs.modal', function () {
        if (isUpdateMapInitialized) {
            updateMap.remove();
            isUpdateMapInitialized = false;
        }
    })
})


$('.updateControlButton').click(function (e) {
    console.log('this is happening')

    const updateButton = document.querySelector('button#updateBuilding')

    $('.update_common_info').toggleClass('d-none')
    $('.update_building_tasks').toggleClass('d-none')

    $('.updateControlButton').toggleClass('d-none')
    updateButton.classList.toggle('d-none')
})

// })

function bindModel(index) {
    clearTimeout($(`#taskCompleted${index}`).data('timeout'));

    let timeout = setTimeout(() => {
        document.getElementById(`taskCompleted${index}`).dispatchEvent(new Event('input'))
    }, 500);

    $(`taskCompleted${index}`).data('timeout', timeout)
}


function addTask(button, event) {
    event.preventDefault();

    let task_id = button.getAttribute('id');

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

    console.log(task_id)

    // resets add form upon clicking add
    $(`#${task_id}_input`).val('')
    $(`#${task_id}_target`).val('')
}

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
    console.log('happening is this')
    const submitButton = document.querySelector('button#addBuilding')

    $('.common_info').toggleClass('d-none')
    $('.building_tasks').toggleClass('d-none')

    $('.formControlButton').toggleClass('d-none')
    submitButton.classList.toggle('d-none')
})


function showCurrentStep() {

}

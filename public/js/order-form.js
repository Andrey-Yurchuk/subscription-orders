// Получаем текущую дату + 1 день
function getCurrentDate() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate() + 1).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

// Устанавливаем минимальную дату для всех полей ввода типа "date"
document.addEventListener('DOMContentLoaded', function() {
    const currentDate = getCurrentDate();
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        input.min = currentDate;
    });
});

// Добавляем новый интервал дат
document.getElementById('add-date-range').addEventListener('click', function() {
    const container = document.getElementById('date-ranges');
    const index = container.children.length;
    const currentDate = getCurrentDate();

    const div = document.createElement('div');
    div.className = 'date-range';
    div.innerHTML = `
            <label>Интервал дат:</label>
            <input type="date" name="date_ranges[${index}][start]" required min="${currentDate}" onchange="setEndDateMin(this)">
            <input type="date" name="date_ranges[${index}][end]" required min="${currentDate}">
            <button type="button" class="remove-interval" onclick="removeInterval(this)">Удалить интервал</button>
        `;
    container.appendChild(div);

    updateRemoveButtons();
});

// Удаляем интервал
function removeInterval(button) {
    const container = document.getElementById('date-ranges');
    if (container.children.length > 1) {
        button.parentElement.remove();
    }
    updateRemoveButtons();
}

// Устанавливаем минимальную дату для поля "до"
function setEndDateMin(startInput) {
    const div = startInput.parentElement;
    const endInput = div.querySelector('input[name*="end"]');
    endInput.min = startInput.value;
}

// Обновляем видимость кнопок "Удалить интервал"
function updateRemoveButtons() {
    const container = document.getElementById('date-ranges');
    const removeButtons = container.querySelectorAll('.remove-interval');

    if (container.children.length > 1) {
        removeButtons.forEach(button => button.style.display = 'inline-block');
    } else {
        removeButtons.forEach(button => button.style.display = 'none');
    }
}

updateRemoveButtons();

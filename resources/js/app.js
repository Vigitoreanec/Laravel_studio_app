import './bootstrap';

let button = document.querySelectorAll('.changeMeeting');
button.forEach((elem) => {
    elem.addEventListener('click', () => {
        let id = elem.getAttribute('data-id');
        axios.post('/master/meetings/${id}/update/meeting')
            .then(response => {
                document.getElementById('statusMeeting').textContent = response.data.status;
                alert('Статус успешно изменен!');
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при изменении.');
            });
    })
})